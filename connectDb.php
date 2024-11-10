<?php
    $host     = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'ics_db';
    
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if($conn->connect_error){
        die("Cannot connect to the database. Error: " . $conn->connect_error);
    }
?>
