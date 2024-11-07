<?php
session_start();
include "../connectDb.php";

// Step 1: Load all subjects into an associative array for quick lookup
$subjectMap = [];
$subjectQuery = "SELECT subject_name, subject_id FROM subject";
$subjectResult = $conn->query($subjectQuery);

if ($subjectResult) {
    while ($row = $subjectResult->fetch_assoc()) {
        $subjectMap[$row['subject_name']] = $row['subject_id'];
    }
}

// Step 2: Check if a file has been uploaded
if (isset($_FILES['upload_grade']) && $_FILES['upload_grade']['error'] == 0) {
    $fileName = $_FILES['upload_grade']['tmp_name'];
    $teacher_user_id = $_SESSION['user_id']; // Assuming this session variable is set to the logged-in teacher's user_id

    // Verify if the teacher_user_id exists in the account table
    $checkTeacher = "SELECT account_id FROM account WHERE user_id = ?";
    $checkStmt = $conn->prepare($checkTeacher);
    $checkStmt->bind_param("s", $teacher_user_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    // Proceed if the teacher_user_id is valid
    if ($checkResult->num_rows > 0) {
        $account_row = $checkResult->fetch_assoc();
        $account_id = $account_row['account_id'];

        // Check if the teacher exists in the teacher table
        $checkTeacherId = "SELECT teacher_id FROM teacher WHERE account_id = ?";
        $checkTeacherIdStmt = $conn->prepare($checkTeacherId);
        $checkTeacherIdStmt->bind_param("i", $account_id);
        $checkTeacherIdStmt->execute();
        $checkTeacherIdStmt->bind_result($teacher_id);
        $checkTeacherIdStmt->fetch();
        $checkTeacherIdStmt->close();

        if (!$teacher_id) {
            echo "Error: Teacher ID for account ID {$account_id} does not exist.<br>";
            exit;
        }

        if (($handle = fopen($fileName, "r")) !== false) {
            fgetcsv($handle); // Skip the header row
        
            // Prepare the SQL statement for inserting or updating grades
            $sql = "INSERT INTO grade (student_id, subject_id, teacher_id, academic_year, first_quarter, second_quarter, third_quarter, fourth_quarter) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE first_quarter = VALUES(first_quarter), second_quarter = VALUES(second_quarter), 
                    third_quarter = VALUES(third_quarter), fourth_quarter = VALUES(fourth_quarter)";
            $stmt = $conn->prepare($sql);
        
            $uploadSuccess = false;
        
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($data) < 5) {
                    echo "Warning: CSV row has insufficient columns. Skipping row.<br>";
                    continue;
                }

                $student_lrn = intval($data[0]); // Get LRN instead of student_id
                $first_quarter = floatval($data[1]);
                $second_quarter = floatval($data[2]);
                $third_quarter = floatval($data[3]);
                $fourth_quarter = floatval($data[4]);
        
                // Check if the student exists using LRN
                $studentCheckQuery = "SELECT student_id FROM student WHERE lrn = ?";
                $studentCheckStmt = $conn->prepare($studentCheckQuery);
                $studentCheckStmt->bind_param("i", $student_lrn);
                $studentCheckStmt->execute();
                $studentCheckStmt->bind_result($student_id);
                $studentCheckStmt->fetch();
                $studentCheckStmt->close();
        
                if (!$student_id) {
                    echo "Student LRN $student_lrn does not exist. Skipping insertion.<br>";
                    continue; // Skip to the next iteration if no student is found
                }
        
                // Get the subject_id directly from the teacher table
                $subjectQuery = "SELECT subject_id FROM teacher WHERE teacher_id = ?";
                $subjectStmt = $conn->prepare($subjectQuery);
                $subjectStmt->bind_param("i", $teacher_id);
                $subjectStmt->execute();
                $subjectStmt->bind_result($subject_id);
                $subjectStmt->fetch();
                $subjectStmt->close();
        
                if (!$subject_id) {
                    echo "No subject assigned to the teacher with ID $teacher_id.<br>";
                    continue; // Skip to the next iteration if no subject is found
                }
        
                // Bind parameters and execute the statement
                $academic_year = date("Y");
                $stmt->bind_param("iiisdddd", $student_id, $subject_id, $teacher_id, $academic_year, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter);
        
                if ($stmt->execute()) {
                    $uploadSuccess = true;
                } else {
                    echo "Error inserting grade for LRN $student_lrn: " . $stmt->error . "<br>";
                }
            }
        
            $stmt->close();
            fclose($handle);
        
            
            if ($uploadSuccess) {
                $_SESSION['success_message'] = "Grades uploaded successfully!";
                header("Location: ../pages/teacherDashboard.php");
                exit;
            } else {
                echo "No grades were uploaded.";
            }
        } else {
            echo "Error opening the file.";
        }
    } else {
        echo "Invalid teacher ID: $teacher_user_id. Please ensure the teacher is registered in the system.";
    }
    $checkStmt->close();
    $conn->close();
} else {
    echo "No file uploaded or there was an error with the file upload.";
}
?>
