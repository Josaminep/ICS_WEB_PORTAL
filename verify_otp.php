<?php
// Include database connection file
include('connectDb.php');
$email = $_GET['email'];

// Handle OTP verification form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp_entered = $_POST['otp'];

    // Verify the OTP
    $query = "SELECT * FROM otp_verifications WHERE email = ? AND otp_code = ? AND is_verified = 0";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $otp_entered);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // OTP is correct, mark it as verified
        $updateQuery = "UPDATE otp_verifications SET is_verified = 1 WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("s", $email);
        $updateStmt->execute();

        echo "OTP verified successfully. You can now reset your password.";
        // Redirect to password reset page
        header("Location: reset_password.php?email=$email");
        exit();
    } else {
        echo "Invalid OTP or OTP expired.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Verify OTP</h2>
    <form action="" method="POST">
        <label for="otp">Enter OTP:</label><br>
        <input type="text" id="otp" name="otp" required><br><br>
        <input type="submit" value="Verify OTP">
    </form>
</body>
</html>
