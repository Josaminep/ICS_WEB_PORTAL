<?php
// Include database connection file
include('connectDb.php');
$email = $_GET['email'];

// Handle password reset form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];

    // Update password in the database (hash it for security)
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update user's password (You may need a table for users like 'users' or 'parent')
    $updateQuery = "UPDATE parent SET password = ? WHERE email = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ss", $hashed_password, $email);
    $updateStmt->execute();

    echo "Password reset successfully.";
    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="" method="POST">
        <label for="new_password">Enter New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
