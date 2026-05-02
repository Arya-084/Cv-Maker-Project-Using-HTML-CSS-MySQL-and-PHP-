<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['resume_id'] && $post['position'] && $post['company'] && $post['started'] && $post['ended'] && $post['job_desc']){
     $resumeid = array_shift($post);
    $post2=$post; 
    unset($post['slug']);
   $columns='';
   $values='';
   foreach($post as $index=>$value){
      $value=$db->real_escape_string($value);
      $columns.=$index.',';
      $values.="'$value',";
   }
$columns.='resume_id';
$values.=$resumeid;
 

   try{
      $query = "INSERT INTO experiences";
      $query.="($columns)";
      $query.="VALUES($values)";

   $db->query($query);
   $fn->setAlert('Experience added !');
   $fn->redirect('../updatecv.php?resume='.$post2['slug']); 
   }catch(Exception $error){
    $fn->setError($error->getMessage()); 
    $fn->redirect('../updatecv.php?resume='.$post2['slug']); 
   }
}else{
   $fn->setError('please fill the form.');
   $fn->redirect('../updatecv.php?resume='.$post2['slug']); 
}
}else{
   $fn->redirect('../updatecv.php?resume='.$post2['slug']); 
}