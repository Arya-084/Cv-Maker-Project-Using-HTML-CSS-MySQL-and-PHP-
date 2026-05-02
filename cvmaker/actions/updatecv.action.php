<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['id'] && $post['slug'] && $post['full_name'] && $post['email_id'] && $post['mobile_no'] && $post['hobbies'] && $post['role'] && $post['languages'] && $post['address'] && $post['objective']){
    
   $columns='';
   $values='';
   $post2 = $post;
   unset($post2['id']);
   unset($post2['slug']);
   foreach($post2 as $index=>$value){
      $value=$db->real_escape_string($value);
      $columns.=$index."='$value',";
   }
$columns.='updated_at='.time();
 

   try{
      $query = "UPDATE resumes SET ";
      $query.="$columns ";
      $query.="WHERE id={$post['id']} AND slug='{$post['slug']}'";
     

   $db->query($query);
   $fn->setAlert('CV Updated !');
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