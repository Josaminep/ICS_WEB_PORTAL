<?php
// Set headers for CORS and content type
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Start session for user authentication (if necessary)
session_start();

// Include database connection
include "../../connectDb.php";  // Make sure the path is correct

// Retrieve the user ID from session (assuming it's set after login)
$userid = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : null;

// Retrieve the action from either GET or POST
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

// Define action for handling file upload
if ($action === 'uploadCert') {

        $studentId = mysqli_real_escape_string($conn, $_POST['student']);
        $subjectId = mysqli_real_escape_string($conn, $_POST['section']);
        
        // Handle file upload
        $uploadDir = '../../img/ecertificates/';
        $file = $_FILES['ecert_file'];
        $originalFileName = basename($file['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        
        // Generate a unique file name to avoid duplicates
        $newFileName = uniqid('ecert_') . '.' . $fileExtension;
        $filePath = $uploadDir . $newFileName;

        // Validate file type and size (optional but recommended)
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($file['type'], $allowedTypes) && $file['size'] < 5000000) {  // 5MB limit
            // Move the file to the upload directory
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                // Insert data into the database (save the file name, student, and subject info)
                $query = "
                    INSERT INTO e_cert (subject_id, student_id, e_cert)
                    VALUES ('$subjectId', '$studentId', '$newFileName')
                ";

                if (mysqli_query($conn, $query)) {
                    // Success response
                    $response['success'] = true;
                    $response['message'] = 'E-certificate uploaded and saved successfully!';
                } else {
                    // Database insertion failed
                    $response['success'] = false;
                    $response['message'] = 'Failed to save e-certificate in the database.';
                }
            } else {
                // Failed to upload file
                $response['success'] = false;
                $response['message'] = 'Failed to upload e-certificate file.';
            }
        } else {
            // Invalid file type or size
            $response['success'] = false;
            $response['message'] = 'Invalid file type or file size exceeds the limit.';
        }
} else {
    // Default case if the action is not recognized
    $response['success'] = false;
    $response['message'] = 'Action not recognized';
}

// Output the JSON response
echo json_encode($response);

// Close database connection
mysqli_close($conn);
?>
