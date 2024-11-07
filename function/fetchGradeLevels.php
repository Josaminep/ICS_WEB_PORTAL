<?php
// fetch_grade_levels.php
include "../connectDb.php";

// Prepare the SQL statement
$sql = "SELECT grade_level_id, grade_level FROM grade_level";
$result = $conn->query($sql);

// Fetch the grade levels
$grade_levels = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grade_levels[] = $row;
    }
}

// Return the grade levels as JSON
echo json_encode($grade_levels);

// Close the connection
$conn->close();
?>
