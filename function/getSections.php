<?php
// Fetch sections from the database
function getSections() {
    $conn = new mysqli('localhost', 'username', 'password', 'database'); // replace with your DB credentials
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `section`";
    $result = $conn->query($sql);
    
    $sections = [];
    while ($row = $result->fetch_assoc()) {
        $sections[] = $row;
    }

    $conn->close();
    return $sections;
}
?>
