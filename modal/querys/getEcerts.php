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

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

// Check if the user is authenticated
if (!$userid) {
    $response['message'] = 'User not authenticated';
    echo json_encode($response);
    exit();
}

// Handle file upload
if (isset($_FILES['ecert_file']) && $_FILES['ecert_file']['error'] == 0) {
    $uploadDir = '../../uploads/';  // Change upload directory to 'uploads/'
    $file = $_FILES['ecert_file'];
    $originalFileName = basename($file['name']);
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $fileMimeType = $file['type']; // Get the MIME type of the uploaded file

    // Debugging: Log the file MIME type and extension
    error_log("Uploaded file type: " . $fileMimeType);
    error_log("Uploaded file extension: " . $fileExtension);

    // Define the allowed file types
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

    // Check if the file is an image or a document
    if (in_array($fileMimeType, $allowedTypes)) {
        if ($file['size'] <= 5 * 1024 * 1024) {  // Check file size
            // Sanitize the file name to avoid security risks
            $safeFileName = uniqid('ecert_', true) . '.' . $fileExtension;
            $filePath = $uploadDir . $safeFileName;

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                // Store the file path in the database
                $query = "INSERT INTO e_cert (file_path, student_id) VALUES ('$filePath', '$userid')";
                if (mysqli_query($conn, $query)) {
                    $response['success'] = true;
                    $response['message'] = 'File uploaded and saved in database!';
                    $response['data'] = ['file_path' => $filePath];
                } else {
                    $response['message'] = 'Error saving file path to database: ' . mysqli_error($conn);
                }
            } else {
                $response['message'] = 'Failed to upload file.';
            }
        } else {
            $response['message'] = 'File size exceeds limit of 5MB.';
        }
    } else {
        $response['message'] = 'Invalid file type. Only JPEG, PNG, and PDF are allowed.';
    }
} else {
    $response['message'] = 'No file uploaded or error with the file.';
}

// Fetch e-certificates from database to display
$query = "SELECT e_cert_id, student_id, e_cert FROM e_cert";
$result = mysqli_query($conn, $query);

if ($result) {
    $ecertData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (count($ecertData) > 0) {
        $response['success'] = true;
        $response['data'] = $ecertData;
    } else {
        $response['success'] = true;
        $response['message'] = 'No e-certificates found for the current user.';
    }
} else {
    $response['message'] = 'Error fetching e-certificates: ' . mysqli_error($conn);
}

echo json_encode($response);

// Close database connection
mysqli_close($conn);
?>
