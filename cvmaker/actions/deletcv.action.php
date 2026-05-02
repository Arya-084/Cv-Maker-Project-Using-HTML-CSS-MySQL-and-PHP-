<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_GET){
$post=$_GET;

if($post['id']){
 $authid = $fn->Auth()['id'];    
 

   try{
      $query = "DELETE resumes,experties,educations,experiences,certification FROM resumes ";
      $query.="LEFT JOIN experties ON resumes.id=experties.resume_id ";   
      $query.="LEFT JOIN educations ON resumes.id=educations.resume_id ";
      $query.="LEFT JOIN experiences ON resumes.id=experiences.resume_id ";
      $query.="LEFT JOIN certification ON resumes.id=certification.resume_id ";  
      $query.="WHERE resumes.id={$post['id']} AND resumes.user_id=$authid";

   $db->query($query);
   $fn->setAlert('CV Deleted !');
   $fn->redirect('../downloads.php'); 
   }catch(Exception $error){
    $fn->setError($error->getMessage()); 
    $fn->redirect('../downloads.php'); 
   }
}else{
   $fn->setError('please fill the form.');
   $fn->redirect('../downloads.php'); 
}
}else{
   $fn->redirect('../downloads.php'); 
}