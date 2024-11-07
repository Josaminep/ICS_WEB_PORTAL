<?php
session_start();
include "../connectDb.php";

// Get the grade level id from the AJAX request
$grade_level_id = isset($_POST['grade_level_id']) ? (int)$_POST['grade_level_id'] : 0;

$user_id = $_SESSION['user_id'];

// Prepare the SQL statement to fetch sections based on teacher_id and grade_level_id
$sql = "SELECT sec.section_id, sec.section_name 
        FROM teacher_section ts
        LEFT JOIN section sec ON ts.section_id = sec.section_id
        LEFT JOIN grade_level gl ON sec.grade_level_id = gl.grade_level_id
        WHERE ts.teacher_id = RIGHT(?, 4)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);  // Bind teacher_id and grade_level_id
$stmt->execute();
$result = $stmt->get_result();

// Fetch the sections
$sections = array();
while ($row = $result->fetch_assoc()) {
    $sections[] = $row;
}

// Return the sections as JSON
echo json_encode($sections);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
