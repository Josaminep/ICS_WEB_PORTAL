<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <?php include "partials/head.php" ?>
    <link rel="stylesheet" href="css/loginStyle.css">
    <script src="js/eyeToggle.js"></script>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg" style="width: 50rem; height: 40rem; border-radius: 20px;">
            <div class="card-header text-center text-white position-relative">
                <div class="z-2 rounded-top-4 overlay position-absolute top-50 start-50 translate-middle" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
                <img src="img/schoolBanner.jpg" alt="Background" class="card-img-top bg-header img-fluid rounded-top-4">
                <img src="img/icsLogo.png" alt="Logo" class="z-3 position-absolute top-50 start-50 translate-middle" style="width: 20%;">
            </div>

            <div class="rounded-bottom-4 card-body form-body text-white">
                
                <h1 class="text-center mb-4">LOGIN</h1>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="height: 40px; margin: 0 185px;">
                        <?php echo $_SESSION['error_message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.7rem;"></button>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
                
                <form action="function/loginAccount.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="userId" class="form-label">User ID</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="userId" name="user_id" placeholder="Enter User ID">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="rounded-end-2 form-control" id="password" placeholder="Enter Password" name="user_password" style="padding-right: 30px;">
                            <i class="position-absolute top-50 end-0 translate-middle-y bi bi-eye-slash" style="color: black; padding-right: 8px;" id="togglePasswordIcon" onclick="togglePassword()"></i>
                        </div>
                        <small class="form-text text-light">* Password is case sensitive</small>
                        <a href="forgot_pass.php" class="text-light d-block mt-2">Forgot Password?</a>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning rounded-5"><i class="bi bi-box-arrow-in-right"></i> Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
