<?php
// fetch_grade_levels.php
include "../connectDb.php";

// Get the grade level id from the AJAX request
$grade_level_id = isset($_POST['grade_level_id']) ? (int)$_POST['grade_level_id'] : 0;

// Prepare the SQL statement
$sql = "SELECT section_id, section_name FROM section WHERE grade_level_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $grade_level_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the sections
$sections = array();
while ($row = $result->fetch_assoc()) {
    $sections[] = $row;
}

// Return the sections as JSON
echo json_encode($sections);

// Close the connection
$stmt->close();
$conn->close();
?>