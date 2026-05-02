<?php
require '../classes/database.class.php';
require '../classes/function.class.php'; 
$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug' AND user_id=".$fn->Auth()['id'].") ");
$resume = $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('downloads.php');
}
$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id'].") ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=".$resume['id'].") ");
$edus = $edus->fetch_all(1);

$certificates = $db->query("SELECT * FROM certification WHERE (resume_id=".$resume['id'].") ");
$certificates = $certificates->fetch_all(1);

$skills = $db->query("SELECT * FROM experties WHERE (resume_id=".$resume['id'].") ");
$skills = $skills->fetch_all(1);

  $columns='';
   $values='';
   unset($resume['id']);
   unset($resume['slug']);
   unset($resume['updated_at']);
   $resume['resume_title'].='Clone';

   foreach($resume as $index=>$value){
      $value=$db->real_escape_string($value);
     $columns.=$index.',';
      $values.="'$value',";
   }
    $authid = $fn->Auth()['id'];
   $columns.='slug,updated_at';
   $values.="'".$fn->randomstring()."',".time();
 

   try{
      $query = "INSERT INTO resumes";
      $query.="($columns)";
      $query.="VALUES($values)";

   $db->query($query);

   $new_resume_id=$db->insert_id;
   foreach($exps as $exp){
      foreach($exp as $index=>$value){
         $exp[$index]=$db->real_escape_string($value);
      }
      $query2 = 'INSERT INTO experiences(resume_id,position,company,job_desc,started,ended)';
      $query2 .= "VALUES ($new_resume_id,'{$exp['position']}','{$exp['company']}','{$exp['job_desc']}','{$exp['started']}','{$exp['ended']}')";
      $db->query($query2);
   }
      foreach($edus as $exp){
         foreach($exp as $index=>$value){
         $exp[$index]=$db->real_escape_string($value);
      }
      $query3 = 'INSERT INTO educations(resume_id,course,institute,started,ended)';
      $query3 .= "VALUES ($new_resume_id,'{$exp['course']}','{$exp['institute']}','{$exp['started']}','{$exp['ended']}')";
      $db->query($query3);
   }
    foreach($certificates as $exp){
      foreach($exp as $index=>$value){
         $exp[$index]=$db->real_escape_string($value);
      }
      $query4 = 'INSERT INTO certification(resume_id,course,description,ended)';
      $query4 .= "VALUES ($new_resume_id,'{$exp['course']}','{$exp['description']}','{$exp['ended']}')";
      $db->query($query4);
   }
   foreach($skills as $exp){
      foreach($exp as $index=>$value){
         $exp[$index]=$db->real_escape_string($value);
      }
      $query5 = 'INSERT INTO experties(resume_id,skill)';
      $query5 .= "VALUES ($new_resume_id,'{$exp['skill']}')";
      $db->query($query5);
   }
   $fn->setAlert('Clone Created !');
   $fn->redirect('../downloads.php'); 
   }catch(Exception $error){
    $fn->setError($error->getMessage()); 
    $fn->redirect('../downloads.php');
   }
?>