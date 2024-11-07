<?php
include "../connectDb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $announcement_id = $_POST['announcement_id'];
    
    // Escape the title first
    $announcement_title = $conn->real_escape_string($_POST['announcement_title']);
    
    // Handle the announcement text: first, strip slashes, then escape
    $announcement_text = stripslashes($_POST['announcement_text']); // Remove backslashes
    $announcement_text = $conn->real_escape_string($announcement_text); // Escape the text

    // Prepare the SQL update statement
    $query = "UPDATE announcements SET title = ?, announcement_text = ? WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $announcement_title, $announcement_text, $announcement_id);

    // Execute the statement and redirect
    if ($stmt->execute()) {
        header("Location: ../pages/guidanceDashboard.php");
        exit; // Always good to exit after a redirect
    } else {
        echo "Error: " . $stmt->error; // Display error for debugging
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
