<?php
include '../connectDb.php'; // Modify this with your database connection file

// Function to fetch grades based on student ID
function fetchGrades($conn, $studentId)
{
    $query = "
        SELECT g.first_quarter, g.second_quarter, g.third_quarter, g.fourth_quarter, 
               s.subject_name, 
               CONCAT(t.first_name, ' ', t.last_name) AS teacher_name
        FROM grade g
        JOIN subject s ON g.subject_id = s.subject_id
        JOIN teacher t ON g.teacher_id = t.teacher_id
        WHERE g.student_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

$studentId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$grades = [];
if ($studentId) {
    $query = "
        SELECT student_id
        FROM student
        WHERE student.lrn = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentRecord = $row['student_id'];
    } else
        return false;

    $grades = fetchGrades($conn, $studentRecord);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades - ICS Parent Portal</title>
    <link rel="stylesheet" href="../css/classScheduleModal.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="gradesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">GRADES</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Table -->
                    <table class="table table-bordered rounded">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>First</th>
                                <th>Second</th>
                                <th>Third</th>
                                <th>Fourth</th>
                                <th>Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($grades): ?>
                                <?php while ($row = $grades->fetch_assoc()): ?>
                                    <tr>
                                        <th><?php echo htmlspecialchars($row['subject_name']); ?></th>
                                        <td><?php echo htmlspecialchars($row['first_quarter']); ?></td>
                                        <td><?php echo htmlspecialchars($row['second_quarter']); ?></td>
                                        <td><?php echo htmlspecialchars($row['third_quarter']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fourth_quarter']); ?></td>
                                        <td><?php echo htmlspecialchars($row['teacher_name']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No grades available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>