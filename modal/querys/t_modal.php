<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
session_start();
include "../../connectDb.php";
$userid = $_SESSION['account_id'];
$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

switch ($action) {
    case 'getSectionsWithSameGradeLevel':
        if (isset($_GET['grade_level'])) {
            $gradeLevel = mysqli_real_escape_string($conn, $_GET['grade_level']);
            $query = "
                SELECT section_name
                FROM section
                WHERE grade_level_id = '$gradeLevel'
                ORDER BY section_name
            ";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $sections = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $sections[] = $row['section_name'];
                }
                $response['success'] = true;
                $response['message'] = 'Sections with the same grade level fetched successfully';
                $response['data'] = $sections;
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to fetch sections with the same grade level';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Grade level parameter is missing';
        }
        break;
    case 'getSections':
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "
            SELECT sec.section_name, sec.grade_level_id
            FROM section sec
            JOIN teacher_section ts ON sec.section_id = ts.section_id
            JOIN teacher t ON ts.teacher_id = t.teacher_id
            JOIN account a ON t.account_id = a.account_id
            WHERE a.account_id = '$userid'
            ORDER BY sec.section_name
        ";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $sections = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $sections[] = $row['section_name'];
            }
            $response['success'] = true;
            $response['message'] = 'Sections fetched successfully';
            $response['data'] = $sections;
        } else {
            $response['message'] = 'Failed to fetch sections or no sections assigned';
        }
        break;

    case 'getStudents':
        if (isset($_GET['section'])) {
            $section = mysqli_real_escape_string($conn, $_GET['section']);
            $query = "
                SELECT s.student_id, CONCAT(s.first_name, ' ', s.last_name) AS full_name, sec.section_name
                FROM student s
                LEFT JOIN section sec ON s.section_id = sec.section_id
                WHERE sec.section_name = '$section'
                ORDER BY full_name
            ";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $students = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $students[] = [
                        'id' => $row['student_id'],
                        'name' => $row['full_name'],
                        'section' => $row['section_name']
                    ];
                }
                if (count($students) > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Students fetched successfully';
                    $response['data'] = $students;
                } else {
                    $response['success'] = false;
                    $response['message'] = 'No students found in this section';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to fetch students or database error';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Section parameter is missing';
        }
        break;

        case 'updateStatus':
            if (isset($_POST['student'], $_POST['status'], $_POST['tsection'], $_POST['new_section'])) {
                $studentId = mysqli_real_escape_string($conn, $_POST['student']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $newSection = mysqli_real_escape_string($conn, $_POST['new_section']);
                $currentSection = mysqli_real_escape_string($conn, $_POST['tsection']);
                
                // Fetch student details
                $query = "
                    SELECT lrn, first_name, last_name, date_of_birth, parent_id, section_id FROM student WHERE student_id = '$studentId'
                ";
                $result = mysqli_query($conn, $query);
                $student = mysqli_fetch_assoc($result);
        
                if ($student) {
                    // Archive student data before updating
                    $archiveQuery = "
                        INSERT INTO student_archives (lrn, first_name, last_name, date_of_birth, current_status, parent_id, section_id)
                        VALUES ('{$student['lrn']}', '{$student['first_name']}', '{$student['last_name']}', '{$student['date_of_birth']}', '$status', '{$student['parent_id']}', '{$student['section_id']}')
                    ";
                    if (mysqli_query($conn, $archiveQuery)) {
                        $response['success'] = true;
                        $response['message'] = 'Student data archived and status updated successfully.';
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Failed to update student status.';
                    }

                } else {
                    $response['success'] = false;
                    $response['message'] = 'Student not found.';
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Required fields are missing.';
            }
            break;
        
        
    case 'getAllSections':
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM section ORDER BY section_name";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $sections = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $sections[] = $row['section_name'];
            }
            $response['success'] = true;
            $response['message'] = 'Sections fetched successfully';
            $response['data'] = $sections;
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to fetch sections or no sections available';
        }
        break;
    case 'getRetainedInfo':
        if (isset($_GET['student'])) {
            $studentId = mysqli_real_escape_string($conn, $_GET['student']);
            $query = "
                SELECT s.section_id, s.section_name, s.grade_level_id
                FROM student st
                JOIN section s ON st.section_id = s.section_id
                WHERE st.student_id = '$studentId'
            ";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $response['success'] = true;
                $response['data'] = [
                    'section' => $row['section_name'],
                    'year_level' => $row['grade_level_id']
                ];
            } else {
                $response['message'] = 'Failed to fetch retained information';
            }
        } else {
            $response['message'] = 'Student ID is missing';
        }
        break;
    default:
        $response['success'] = false;
        $response['message'] = 'Action not recognized';
        break;
}

echo json_encode($response);
mysqli_close($conn);
?>
