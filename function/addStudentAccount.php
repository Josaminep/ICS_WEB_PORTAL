<?php
session_start();
include "../connectDb.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input to prevent SQL injection
    $lrn = $conn->real_escape_string($_POST['student_lrn']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);
    $student_id = $conn->real_escape_string($_POST['student_id_lrn']);

    // Validate if the passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header("Location: ../pages/guidanceDashboard.php");
    }

    // Validate if the LRN is exactly 12 digits
    if (!preg_match('/^\d{12}$/', $lrn)) {
        $_SESSION['error_message'] = "Invalid LRN. LRN must be exactly 12 digits.";
        header("Location: ../pages/guidanceDashboard.php");
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Begin transaction to ensure data integrity
    $conn->begin_transaction();

    try {
        // Update the student's LRN in the student table
        $update_lrn_sql = "UPDATE student SET lrn = $lrn WHERE student_id = $student_id";

        if ($conn->query($update_lrn_sql) !== TRUE) {
            throw new Exception("Error updating student LRN: " . $conn->error);
        }

        // Insert the LRN and hashed password into the student_credential table
        $insert_credential_sql = "INSERT INTO student_credential (lrn, student_password, role_id) VALUES ($lrn, '$hashedPassword', 1)";

        if ($conn->query($insert_credential_sql) !== TRUE) {
            throw new Exception("Error inserting into student_credential: " . $conn->error);
        }

        // If everything is successful, commit the transaction
        $conn->commit();

        // Set a success message and redirect
        $_SESSION['success_message'] = "Student account successfully created!";
        header("Location: ../pages/guidanceDashboard.php");
    } catch (Exception $e) {
        // If there is an error, rollback the transaction
        $conn->rollback();

        // Set an error message and redirect back to the form
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ../pages/guidanceDashboard.php");
    }

} else {
    // If accessed without POST request, redirect back
    $_SESSION['error_message'] = "Invalid request method.";
    header("Location: ../pages/guidanceDashboard.php");
}

// Close the connection
$conn->close();
?>
