<?php
include "../connectDb.php";

if (isset($_POST['announcement_id'])) {
    $announcementId = $_POST['announcement_id'];

    // Delete the announcement from the database
    $query = "DELETE FROM announcements WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $announcementId);

    if ($stmt->execute()) {
        echo "Announcement deleted successfully";
    } else {
        echo "Error deleting announcement";
    }

    $stmt->close();
    $conn->close();
}
?>
