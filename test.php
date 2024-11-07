<?php
// Database connection
$host = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'ics_db';

$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch all students
function fetchStudents($conn) {
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["student_id"] . " - Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
        }
    } else {
        echo "No students found";
    }
}

// Function to insert a new student
function insertStudent($conn, $studentData) {
    $sql = "INSERT INTO student (student_id, lrn, first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id, role_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssssiiiii", 
        $studentData['student_id'], 
        $studentData['lrn'], 
        $studentData['first_name'], 
        $studentData['middle_name'], 
        $studentData['last_name'], 
        $studentData['sex'], 
        $studentData['date_of_birth'], 
        $studentData['current_status'], 
        $studentData['academic_year'], 
        $studentData['parent_id'], 
        $studentData['grade_level_id'], 
        $studentData['section_id'], 
        $studentData['role_id']
    );

    if ($stmt->execute()) {
        echo "New student added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Function to update an existing student
function updateStudent($conn, $studentData) {
    $sql = "UPDATE student SET lrn=?, first_name=?, middle_name=?, last_name=?, sex=?, date_of_birth=?, current_status=?, academic_year=?, parent_id=?, grade_level_id=?, section_id=?, role_id=? WHERE student_id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssiiiiii", 
        $studentData['lrn'], 
        $studentData['first_name'], 
        $studentData['middle_name'], 
        $studentData['last_name'], 
        $studentData['sex'], 
        $studentData['date_of_birth'], 
        $studentData['current_status'], 
        $studentData['academic_year'], 
        $studentData['parent_id'], 
        $studentData['grade_level_id'], 
        $studentData['section_id'], 
        $studentData['role_id'], 
        $studentData['student_id']
    );

    if ($stmt->execute()) {
        echo "Student updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Function to delete a student
function deleteStudent($conn, $student_id) {
    $sql = "DELETE FROM student WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        echo "Student deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Example usage
// Fetch all students
echo "<h3>All Students:</h3>";
fetchStudents($conn);

// Insert a new student
$newStudentData = [
    'student_id' => 1042,
    'lrn' => 100000000042,
    'first_name' => 'Juan',
    'middle_name' => 'Santos',
    'last_name' => 'Garcia',
    'sex' => 'male',
    'date_of_birth' => '2014-12-15',
    'current_status' => 'enrolled',
    'academic_year' => '2024-2025',
    'parent_id' => 2042,
    'grade_level_id' => 5,
    'section_id' => 14,
    'role_id' => 1
];
insertStudent($conn, $newStudentData);

// Update a student
$updatedStudentData = [
    'student_id' => 1042,
    'lrn' => 100000000042,
    'first_name' => 'Juanito',
    'middle_name' => 'Santos',
    'last_name' => 'Garcia',
    'sex' => 'male',
    'date_of_birth' => '2014-12-15',
    'current_status' => 'enrolled',
    'academic_year' => '2024-2025',
    'parent_id' => 2042,
    'grade_level_id' => 5,
    'section_id' => 14,
    'role_id' => 1
];
updateStudent($conn, $updatedStudentData);

// Delete a student by ID
deleteStudent($conn, 1042);

// Close connection
$conn->close();
?>
