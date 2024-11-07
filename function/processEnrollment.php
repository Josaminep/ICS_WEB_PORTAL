<?php

// Start the session
session_start();

// Database connection
include "../connectDb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $year = (int)date("Y");
    $academic_year = date("Y") . "-" . ($year + 1);
    // Sanitize input
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $middle_name = $conn->real_escape_string($_POST['middle_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $sex = $conn->real_escape_string($_POST['sex']);
    $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
    $address = $conn->real_escape_string($_POST['address']);
    $parent_first_name = $conn->real_escape_string($_POST['parent_first_name']);
    $parent_last_name = $conn->real_escape_string($_POST['parent_last_name']);
    $parent_email = $conn->real_escape_string($_POST['parent_email']);
    $parent_contact = $conn->real_escape_string($_POST['parent_contact']);
    $civil_status = $conn->real_escape_string($_POST['civil_status']);
    $grade_level = $conn->real_escape_string($_POST['grade_level']);
    $section = $conn->real_escape_string($_POST['section']);

    // Handle file uploads
    $upload_dir = '../uploads/'; // Ensure this directory exists and is writable
    $student_picture = $upload_dir . basename($_FILES['student_picture']['name']);
    $psa_birth_certificate = $upload_dir . basename($_FILES['psa_birth_certificate']['name']);
    $progress_report_card = $upload_dir . basename($_FILES['progress_report_card']['name']);
    $medical_assessment = $upload_dir . basename($_FILES['medical_assessment']['name']);

    // Insert into parent table
    $parent_sql = "INSERT INTO parent (first_name, last_name, email, phone_number, address, role_id) VALUES ('$parent_first_name', '$parent_last_name', '$parent_email', $parent_contact, '$address', 2)";
    if ($conn->query($parent_sql) === TRUE) {
        $parent_id = $conn->insert_id; // Get the last inserted parent ID

        // Insert into student table
        $student_sql = "INSERT INTO student (first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id, role_id) VALUES ('$first_name', '$middle_name', '$last_name', '$sex', '$date_of_birth', 'enrolled', '$academic_year', $parent_id, $grade_level, $section, 1)";
        if ($conn->query($student_sql) === TRUE) {
            $student_id = $conn->insert_id; // Get the last inserted student ID

            // Insert into student_file table
            $student_file_sql = "INSERT INTO student_file (student_picture, psa_birth_certificate, progress_report_card, medical_assessment, student_id) VALUES ('$student_picture', '$psa_birth_certificate', '$progress_report_card', '$medical_assessment', $student_id)";
            if ($conn->query($student_file_sql) === TRUE) {
                echo "<script>
                window.location.href = '../pages/guidanceDashboard.php';
                </script>";
            } else {
                echo "Error inserting student file record: " . $conn->error;
            }
        } else {
            echo "Error inserting student record: " . $conn->error;
        }
    } else {
        echo "Error inserting parent record: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
