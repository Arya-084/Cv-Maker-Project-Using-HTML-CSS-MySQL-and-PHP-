<?php

require '../classes/database.class.php';
require '../classes/function.class.php'; 

if($_POST){
$post=$_POST;

if($post['resume_id'] && $post['font']){
    
 
$font=$db->real_escape_string($post['font']);
 

   
      $query = "UPDATE resumes SET ";
      $query.="font='$font' ";
      $query.="WHERE id={$post['resume_id']}";
     

   $db->query($query);
   
}
}