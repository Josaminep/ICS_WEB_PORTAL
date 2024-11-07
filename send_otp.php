<?php
session_start();

// Database connection
$host     = 'localhost:3306';
$username = 'root';
$password = '';
$dbname   = 'ics_db';
    
$conn = new mysqli($host, $username, $password, $dbname);
if (!$conn) {
    die("Cannot connect to the database." . $conn->error);
}

// Check if the form is submitted
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email exists in your user database (parent table in this case)
    $sql = "SELECT parent_id FROM parent WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email exists, generate OTP and store in otp_verifications table
        $otp_code = rand(100000, 999999); // Generate a random 6-digit OTP
        $expires_at = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP expires in 15 minutes

        // Insert OTP into the otp_verifications table
        $stmt = $conn->prepare("INSERT INTO otp_verifications (user_id, otp_code, email, expires_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $otp_code, $email, $expires_at);

        // Get parent_id from parent table
        $stmt->execute();
        $stmt->close();

        // Send the OTP to the email address
        mail($email, "Your OTP for Password Reset", "Your OTP is: $otp_code. It will expire in 15 minutes.");

        // Set success message and redirect to OTP verification page
        $_SESSION['message'] = "OTP sent to your email address.";
        header('Location: verify_otp.php');
        exit;
    } else {
        // Email not found in the database
        $_SESSION['message'] = "Email address not found.";
        header('Location: forgot_password.php');
        exit;
    }
}
?>
