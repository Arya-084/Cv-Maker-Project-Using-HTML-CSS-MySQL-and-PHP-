<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['full_name'] && $post['email_id'] && $post['password']){
   $full_name=$db->real_escape_string($post['full_name']);
   $email_id=$db->real_escape_string($post['email_id']);
   $password=md5($db->real_escape_string($post['password']));
   $result= $db->query("SELECT COUNT(*) as user FROM users WHERE (email_id='$email_id')");

   $result = $result->fetch_assoc();

if($result['user']){
  $fn->setError($email_id.' is already registered'); 
  $fn->redirect('../Register.php'); 
   die();
} 

   try{
   $db->query("INSERT INTO users(full_name,email_id,password) VALUES('$full_name','$email_id','$password')");
   $fn->setAlert('You are registered successfully');
   $fn->redirect('../Login.php'); 
   }catch(Exception $error){
    $fn->setError($error->getMessage()); 
    $fn->redirect('../Register.php');
   }
}else{
   $fn->setError('please fill the form.');
   $fn->redirect('../Register.php'); 
}
}else{
    $fn->redirect('../Register.php');
}
?> 