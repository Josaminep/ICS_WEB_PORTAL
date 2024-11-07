<?php
require '../vendor/autoload.php'; // Adjust the path to your autoload.php

use PhpOffice\PhpSpreadsheet\IOFactory;

function uploadSchedule($file) {
    // Database connection parameters
    $host     = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'ics_db';

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get the selected section ID from the form
        $section_id = $_POST['section']; // Assuming this is passed in the form

        // Step 1: Archive existing schedules
        $archiveStmt = $pdo->prepare("INSERT INTO class_schedule_archive (class_time, subject_name, weekday, section_id) SELECT class_time, subject_name, weekday, section_id FROM class_schedule WHERE section_id = ?");
        $archiveStmt->execute([$section_id]);

        // Step 2: Delete existing schedules for the section
        $deleteStmt = $pdo->prepare("DELETE FROM class_schedule WHERE section_id = ?");
        $deleteStmt->execute([$section_id]);

        // Step 3: Load the Excel file
        $spreadsheet = IOFactory::load($file['tmp_name']);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true); // Load data as an associative array

        // Prepare the SQL statement for new schedule insertion
        $insertStmt = $pdo->prepare("INSERT INTO class_schedule (class_time, subject_name, weekday, section_id) VALUES (?, ?, ?, ?)");

        // Define weekdays as keys
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Loop through the rows of the spreadsheet starting from the second row (data starts here)
        foreach ($rows as $rowIndex => $row) {
            if ($rowIndex == 1) continue; // Skip header row

            $time = $row['A']; // Assuming 'Time' is in column A

            // Loop through each weekday column (columns B to F)
            foreach ($weekdays as $i => $weekday) {
                $subject_name = $row[chr(66 + $i)]; // 'B' is 66 in ASCII, then increment for each weekday

                // Insert into the database if there's a subject name
                if (!empty($subject_name)) {
                    $insertStmt->execute([$time, $subject_name, $weekday, $section_id]);
                }
            }
        }

        // Optional: Display success message
        echo "Schedule uploaded successfully. Existing schedules archived.";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload-schedule'])) {
    uploadSchedule($_FILES['upload-schedule']);
}
?>
