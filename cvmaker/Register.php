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
    <title>PrimeCV | Register</title>
    <link rel="icon" href="images/logo_img.png">
    <link rel="stylesheet" href="cssfile/Register.css">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <div class="illustration">
                <!-- Placeholder for illustration -->
                <img src="images/register_img.png"
                    alt="Person thinking">
            </div>
        </div>
        <div class="right-section">
            <h1>
                Sign Up
            </h1>
            <p>Please enter your details below to create a new account</p>
            <form method="post" action="actions/register.action.php">
                <input type="text" placeholder="Enter your name" name="full_name" required>
                <input type="email" placeholder="Enter your email" name="email_id" required>
                <input type="password" placeholder="Enter your password" name="password" required>
                <button type="submit">Sign In</button>
            </form>
            <a href="Login.php" class="forgot-link">Log In?</a>
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