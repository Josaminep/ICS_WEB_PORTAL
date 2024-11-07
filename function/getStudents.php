<?php
include "../connectDb.php";

$sectionId = $_GET['section_id'];
$sql = "SELECT student_id, first_name, last_name FROM student WHERE section_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sectionId);
$stmt->execute();
$result = $stmt->get_result();
$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
echo json_encode($students);
$conn->close();
?>
