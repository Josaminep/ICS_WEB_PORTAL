<?php
// Include database connection file
include('connectDb.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Check if email exists in the database
    $query = "SELECT * FROM otp_verifications WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Generate OTP code
        $otp_code = rand(100000, 999999);  // Generate a 6-digit OTP
        
        // Fetch user details
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        // Update OTP code in the database
        $updateQuery = "UPDATE otp_verifications SET otp_code = ?, is_verified = 0 WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ss", $otp_code, $email);
        $updateStmt->execute();
        
        // Send OTP via email (you need to configure an email server or use a service like PHPMailer)
        // Mail the OTP code to the user
        $subject = "Your OTP Code for Password Reset";
        $message = "Your OTP code is: $otp_code";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "OTP has been sent to your email. Please check your inbox.";
            // Redirect to verify OTP page
            header("Location: verify_otp.php?email=$email");
            exit();
        } else {
            echo "Failed to send OTP. Please try again.";
        }
    } else {
        echo "No account found with this email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form action="" method="POST">
        <label for="email">Enter your email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Send OTP">
    </form>
</body>
</html>
