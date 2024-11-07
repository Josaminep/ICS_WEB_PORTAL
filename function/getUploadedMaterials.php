<?php
include '../connectDb.php'; // Adjust this as needed for your setup

// Fetch sections with uploaded materials
function getUploadedMaterials() {
    global $dbConn; // Ensure you have a database connection variable

    $query = "SELECT sm.school_materials, sm.subject_id, sm.section_id, sec.section_name 
        FROM school_materials sm 
        JOIN section sec 
        ON sm.section_id = sec.section_id
        ORDER BY sec.section_name";

    $result = mysqli_query($dbConn, $query);

    if (mysqli_num_rows($result) > 0) {
        $materials = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $materials[] = $row;
        }
        return $materials;
    } else {
        return [];
    }
}

// Handle file deletion
if (isset($_POST['delete_file'])) {
    $filePath = $_POST['file_path'];
    
    // Deleting from the server
    if (file_exists($filePath)) {
        unlink($filePath);
        
        // Optionally, delete from the database
        $query = "DELETE FROM school_materials WHERE school_materials = '$filePath'";
        mysqli_query($dbConn, $query);
    }
}

// Handle file download
if (isset($_GET['download'])) {
    $filePath = $_GET['file'];
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        readfile($filePath);
        exit;
    }
}
?>
