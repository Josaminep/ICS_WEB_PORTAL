<?php
session_start();
include "../connectDb.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    $full_name = $conn->real_escape_string($_SESSION['full_name']);
    $rank_name = $conn->real_escape_string($_SESSION['rank_name']);
    // Sanitize input to prevent SQL injection
    $announcement_title = $conn->real_escape_string($_POST['announcement_title']);
    $announcement_text = $conn->real_escape_string($_POST['announcement_text']);

    $upload_dir = './announcement/'; // Ensure this directory exists and is writable
    $announcement_file = $upload_dir . basename($_FILES['announcement_file']['name']);

    // Begin transaction to ensure data integrity
    $conn->begin_transaction();

    try {

        $insert_announcement_sql = "INSERT INTO announcements (title, announcement_text, announcement_file, full_name, rank_name) 
                                    VALUES ('$announcement_title', '$announcement_text', '$announcement_file', '$full_name', '$rank_name')";

        if ($conn->query($insert_announcement_sql) !== TRUE) {
            throw new Exception("Error inserting into announcements: " . $conn->error);
        }

        $conn->commit();
        $_SESSION['swal_message'] = [
            'type' => 'success',
            'title' => 'Announcement uploaded!',
        ];
    } catch (Exception $e) {
        // If there is an error, rollback the transaction
        $conn->rollback();

        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => $e->getMessage(),
        ];
    }

    header("Location: ../pages/guidanceDashboard.php");
} 


// Close the connection
$conn->close();
?>
