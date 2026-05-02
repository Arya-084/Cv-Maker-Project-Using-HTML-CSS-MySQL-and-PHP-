<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_GET){
$post=$_GET;

if($post['id'] && $post['resume_id']){
     
 

   try{
      $query = "DELETE FROM educations WHERE id={$post['id']} AND resume_id={$post['resume_id']}";
     

   $db->query($query);
   $fn->setAlert('Education Deleted !');
   $fn->redirect('../updatecv.php?resume='.$post['slug']); 
   }catch(Exception $error){
    $fn->setError($error->getMessage()); 
    $fn->redirect('../updatecv.php?resume='.$post['slug']); 
   }
}else{
   $fn->setError('please fill the form.');
   $fn->redirect('../updatecv.php?resume='.$post['slug']); 
}
}else{
   $fn->redirect('../updatecv.php?resume='.$post['slug']); 
}