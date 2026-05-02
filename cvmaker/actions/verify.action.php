<?php
require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['otp']){

    $otp=$post['otp'];

if($fn->getSession('otp')==$otp){
      $fn->setAlert('Email is verified !');
      $fn->redirect('../ResetPass.php');
}else{
     $fn->setError('Incorrect OTP entered !');
   $fn->redirect('../Verify.php'); 
}

  
}else{
   $fn->setError('please enter 6 digit code sended to your email id');
   $fn->redirect('../Verify.php'); 
}
}else{
    $fn->redirect('../Verify.php');
}
?> 