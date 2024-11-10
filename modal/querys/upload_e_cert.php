<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['ecert_file'])) {
    $uploadDir = 'uploads/';
    $fileName = basename($_FILES['ecert_file']['name']);
    $targetFilePath = $uploadDir . $fileName;

    // Move uploaded file to the server directory
    if (move_uploaded_file($_FILES['ecert_file']['tmp_name'], $targetFilePath)) {
        echo json_encode(['status' => 'success', 'file_path' => $targetFilePath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
    }
}
?>
