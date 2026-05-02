<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['full_name'] && $post['email_id'] && $post['mobile_no'] && $post['hobbies'] && $post['role'] && $post['languages'] && $post['address'] && $post['objective']){
    
   $columns='';
   $values='';
   foreach($post as $index=>$value){
      $value=$db->real_escape_string($value);
      $columns.=$index.',';
      $values.="'$value',";
   }
    $authid = $fn->Auth()['id'];
   $columns.='slug,updated_at,user_id';
   $values.="'".$fn->randomstring()."',".time().",".$authid;
 

   try{
      $query = "INSERT INTO resumes";
      $query.="($columns)";
      $query.="VALUES($values)";

   $db->query($query);
   $fn->setAlert('CV added !');
   $fn->redirect('../downloads.php'); 
   }catch(Exception $error){
    $fn->setError($error->getMessage()); 
    $fn->redirect('../Register.php');
   }
}else{
   $fn->setError('please fill the form.');
   $fn->redirect('../form_submission.php'); 
}
}else{
    $fn->redirect('../form_submission.php');
}