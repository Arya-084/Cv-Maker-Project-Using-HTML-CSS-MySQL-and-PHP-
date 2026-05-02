<?php
require 'classes/database.class.php';
require './classes/function.class.php'; 
$fn->AuthPage();
$user = $db->query("SELECT full_name,email_id,password FROM users WHERE id='".$fn->Auth()['id']."'");
$user = $user->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PrimeCV | My Profile</title>
    <link rel="stylesheet" href="cssfile/Myprofile.css" />
    <link rel="icon" href="images/logo_img.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <nav class="main-nav">
        <a href="landing_page-2.php">
        <li class="logo"><img src="images/Logo2.png" alt="company logo" width="120"></li>
        </a>
        <ul>
            <li><a href="Myprofile.php">My Profile</a></li>
            <li><a href="downloads.php">Downloads</a></li>
        </ul>
    </nav><br><br>
<div class="container">
        <div class="left-section">
            <div class="illustration">
                <!-- Placeholder for illustration -->
                <img src="images/Profile_img.png"
                    alt="Person working">
            </div>
        </div>
        <div class="right-section">
            <h1>
                <i class="bi bi-person-circle"></i>
                My Profile                      
            </h1>
            <p></p>
            <form action="actions/update-profile.action.php" method="post">
                <label><b>Full Name</b></label>
                <input type="text" placeholder="Arya Roy" name="full_name" class="form-control"value="<?=@$user['full_name']?>" required>
                <label><b>Email</b></label>
                <input type="email" placeholder="xyz@gmail.com" name="email_id" class="form-control"value="<?=@$user['email_id']?>" required>
                <label><b>Password</b></label>
                <input type="text" name="password" class="form-control"><br>
                <button type="submit">Update Profile</button>
            </form>
            <a href="landing_page-2.php" class="back-btn">
                <i class="fa fa-arrow-left"></i>
                Back to Home</a>
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