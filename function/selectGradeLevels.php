<?php
session_start();
include "../connectDb.php";

$user_id = $_SESSION['user_id'];

// Prepare the SQL statement to fetch grade levels based on sections handled by the teacher
$sql = "SELECT DISTINCT gl.grade_level
        FROM teacher_section ts
        LEFT JOIN section sec ON ts.section_id = sec.section_id
        LEFT JOIN grade_level gl ON sec.grade_level_id = gl.grade_level_id
        WHERE ts.teacher_id = RIGHT(?, 4)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the grade levels
$grade_levels = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grade_levels[] = $row;
    }
}

// Return the grade levels as JSON
echo json_encode($grade_levels);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
