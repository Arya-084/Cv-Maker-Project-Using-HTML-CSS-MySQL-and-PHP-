<?php
require './classes/function.class.php'; 
$fn->NonAuthPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>PrimeCV | Login</title>
    <link rel="icon" href="images/logo_img.png">
    <link rel="stylesheet" href="cssfile/Login.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="illustration">
                <img src="images/login_img.png" alt="Person thinking">
            </div>
        </div>
        <div class="right-section">
            <h1>Log In</h1>
            <p>
                Please enter your credentials below
            </p>
            <form method="post" action="actions/login.action.php">
                <input type="email" placeholder="Enter your email" name="email_id" required>
                <input type="password" placeholder="Enter your password" name="password" required>
                <button type="submit">Log In</button>
            </form>
            <a href="ForgotPass.php" class="forgot-link">Forgot Password?</a>
            <a href="Register.php" class="forgot-link">Register</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>

$(function(){
<?php
$fn->error();
$fn->alert();
?>
})

</script>
</body>
</html>