<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
session_start();
include "../../connectDb.php";
$userid = $_SESSION['account_id']; // Get the account_id from session
$action = isset($_GET['action']) ? $_GET['action'] : ''; // Get action from URL

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

// Handle different actions
switch ($action) {
    case 'getSections':
        // Escape the user_id to prevent SQL injection
        $userid = mysqli_real_escape_string($conn, $userid);

        // SQL query to get sections for the teacher
        $query = "
            SELECT sec.section_name
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
        // Check if the section parameter is provided
        if (isset($_GET['section'])) {
            $section = mysqli_real_escape_string($conn, $_GET['section']); // Escape the section name to prevent SQL injection

            // Query to fetch students for the selected section
            $query = "
                SELECT s.student_id, CONCAT(s.first_name, ' ', s.last_name) AS full_name, sec.section_name
                FROM student s
                LEFT JOIN section sec ON s.section_id = sec.section_id
                WHERE sec.section_name = '$section'
                ORDER BY full_name
            ";

            // Execute the query
            $result = mysqli_query($conn, $query);

            if ($result) {
                $students = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    // Collect student data including their section name
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
            // Ensure the required POST data is available
            if (isset($_POST['student'], $_POST['status'], $_POST['tsection'], $_POST['new_section'])) {
                $studentId = mysqli_real_escape_string($conn, $_POST['student']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $newSection = mysqli_real_escape_string($conn, $_POST['new_section']);
                $currentSection = mysqli_real_escape_string($conn, $_POST['tsection']);
    
                // Prepare the SQL update query based on the status
                if ($status == 'enrolled' || $status == 'passed') {
                    // Update student status and section if 'enrolled' or 'passed'
                    $query = "
                        UPDATE student
                        SET status = '$status', section_id = (SELECT section_id FROM section WHERE section_name = '$newSection')
                        WHERE student_id = '$studentId'
                    ";
                } else {
                    // For 'retained' or 'dropout', just update the status
                    $query = "
                        UPDATE student
                        SET status = '$status'
                        WHERE student_id = '$studentId'
                    ";
                }
    
                // Execute the query
                if (mysqli_query($conn, $query)) {
                    $response['success'] = true;
                    $response['message'] = 'Student status updated successfully.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Failed to update status: ' . mysqli_error($conn);
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Required fields are missing.';
            }
            break;
    case 'getAllSections':
        // Escape the user_id to prevent SQL injection
        $userid = mysqli_real_escape_string($conn, $userid);
    
        // SQL query to get all sections
        $query = "SELECT section_name FROM section ORDER BY section_name";
    
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            $sections = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Collect section names in the sections array
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
    default:
        $response['success'] = false;
        $response['message'] = 'Action not recognized';
        break;
}

echo json_encode($response);
mysqli_close($conn);

?>
