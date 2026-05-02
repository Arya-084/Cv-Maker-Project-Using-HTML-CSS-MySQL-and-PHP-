<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../classes/database.class.php';
require '../classes/function.class.php'; 

require '../Pacekges/PHPMailer/src/Exception.php';
require '../Pacekges/PHPMailer/src/PHPMailer.php';
require '../Pacekges/PHPMailer/src/SMTP.php';

if($_POST){
$post=$_POST;

if($post['email_id']){
   $email_id=$db->real_escape_string($post['email_id']);
   $result= $db->query("SELECT id,full_name FROM users WHERE (email_id='$email_id')");

   $result = $result->fetch_assoc();

if($result){
$otp = rand(100000,999999);
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aryaroy085@gmail.com';                     //SMTP username
    $mail->Password   = 'sowhhdcpzgxymprs';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('aryaroy085@gmail.com', 'Prime CV');
    $mail->addAddress($email_id);     //Add a recipient

   


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forgot Password ?';
    $mail->Body    = 'Your 6 Digit Verification Code : <b>'.$otp.'</b>';

    $mail->send();

    $fn->setSession('otp',$otp);
    $fn->setSession('email',$email_id);
    $fn->redirect('../Verify.php'); 
    

} catch (Exception $e) {
    $fn->setError($mail->ErrorInfo); 
    $fn->redirect('../ForgotPass.php'); 
}

}else{
    $fn->setError($email_id.' is not registered. '); 
    $fn->redirect('../ForgotPass.php'); 
}

  
}else{
   $fn->setError('please enter email id.');
   $fn->redirect('../ForgotPass.php'); 
}

}else{
    $fn->redirect('../ForgotPass.php');
}
?> 