<?php
require './classes/function.class.php'; 
$fn->NonAuthPage();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeCV | Verification</title>
    <link rel="stylesheet" href="cssfile/Verify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./images/logo_img.png">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="./images/verify_img.png" alt="Person thinking" class="illustration">
        </div>
        <div class="right-section">
            <h1>
                A 6 digit code sended to <strong><?=$fn->getSession('email')==''?$fn->redirect('ForgotPass.php'):$fn->getSession('email')?></strong>
            </h1>
            <p>Please enter the 6 digit OTP below</p><br>
            <form method="post" action='actions/verify.action.php'>
                <input type="number" placeholder="Enter the 6 digit code" name="otp" required><br><br>
                <button type="submit" class="submit-btn" >Verify email</button>
            </form><br>
            <a href="Login.php" class="back-btn">
                <i class="fa fa-arrow-left"></i>
                Back to Login </a>
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