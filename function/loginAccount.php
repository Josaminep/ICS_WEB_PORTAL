<?php
session_start();
include '../connectDb.php'; // Modify with your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $userId = $_POST['user_id'];
    $password = $_POST['user_password'];

    // Sanitize input
    $userId = mysqli_real_escape_string($conn, $userId);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the user exists
    $query = "SELECT * FROM account WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $row['user_password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['logged_in'] = true;

            // Redirect based on role_id
            switch ($row['role_id']) {
                case 1:
                    header("Location: ../pages/parentDashboard.php");
                    break;
                case 3:
                    header("Location: ../pages/teacherDashboard.php");
                    break;
                case 4:
                    header("Location: ../pages/guidanceDashboard.php");
                    break;
                case 5:
                    header("Location: ../pages/principalDashboard.php");
                    break;
                case 6:
                    header("Location: ../pages/pdoDashboard.php");
                    break;
                default:
                    // Redirect to a generic error page if the role is unknown
                    header("Location: ../index");
                    break;
            }
            exit();
        } else {
            // Invalid password
            $_SESSION['error_message'] = "Invalid password.";
        }
    } else {
        // Invalid user ID
        $_SESSION['error_message'] = "User ID not found.";
    }

    // Redirect back to login page with error message
    header("Location: ../index");
    exit();
}
