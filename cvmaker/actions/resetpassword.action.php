<?php
require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['password']){

    $password=md5($db->real_escape_string($post['password']));
    $email = $fn->getSession('email');

    $db->query("UPDATE users SET password='$password' WHERE email_id='$email'");
       $fn->setAlert('Password updated, please login again to move forward');
       $fn->redirect('../Login.php'); 

  
}else{
   $fn->setError('please enter your new password');
   $fn->redirect('../ResetPass.php'); 
}
}else{
    $fn->redirect('../ResetPass.php');
}
?> 