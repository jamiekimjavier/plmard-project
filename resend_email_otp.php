
<?php

//resend_email_otp.php

include('database_connection.php');

$message = '';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendors/phpmailer/phpmailer/src/PHPMailer.php';
require './vendors/phpmailer/phpmailer/src/Exception.php';
require './vendors/phpmailer/phpmailer/src/SMTP.php';
require 'class.phpmailer.php';

if(isset($_SESSION["user_id"]))
{
 header("location:dashboard.php");
}

if(isset($_POST["resend"]))
{
 if(empty($_POST["user_email"]))
 {
  $message = '<div class="alert alert-danger">Email Address is required</div>';
 }
 else
 {
  $data = array(
   ':user_email' => trim($_POST["user_email"])
  );

  $query = "
  SELECT * FROM register_user 
  WHERE user_email = :user_email
  ";

  $statement = $connect->prepare($query);

  $statement->execute($data);

  if($statement->rowCount() > 0)
  {
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
    if($row["user_email_status"] == 'verified')
    {
     $message = '<div class="alert alert-info">Email Address already verified, you can login into system</div>';
    }
    else
    {
        
     $mail = new PHPMailer;
     $mail->IsSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->Port = '587';
     $mail->SMTPAuth = true;
     $mail->Username = 'plmard.official@gmail.com';
     $mail->Password = 'yjwb gscp caug iqge';
     $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_SMTPS';
     $mail->From = 'plmard.official@gmail.com';
     $mail->FromName = 'PLMARD';
     $mail->AddAddress($row["user_email"]);
     $mail->WordWrap = 50;
     $mail->IsHTML(true);
     $mail->Subject = 'Verification code to Verify Your Email Address';
     $message_body = '
     <p>In order to verify your email address, please enter this verification code when prompted: <b>'.$row["user_otp"].'</b>.</p>
     <p>Sincerely,</p>
     <p>PLMARD Team</p>
     ';
     $mail->Body = $message_body;

     if($mail->Send())
     {
      echo '<script>alert("Please Check Your Email for Verification Code")</script>';
      echo '<script>window.location.replace("email_verify.php?code='.$row["user_activation_code"].'");</script>';
     }
     else
     {

     }
    }
   }
  }
  else
  {
   $message = '<div class="alert alert-danger">Email Address not found in our record</div>';
  }
 }
}

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Resend Email Verification OTP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://code.jquery.com/jquery.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Resend Email Verification OTP</h3>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Resend Email Verification OTP</h3>
    </div>
    <div class="panel-body">
     <?php echo $message; ?>
     <form method="post">
      <div class="form-group">
       <label>Enter Your Email</label>
       <input type="email" name="user_email" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" name="resend" class="btn btn-success" value="Send" />
      </div>
     </form>
    </div>
   </div>
  </div>
  <br />
  <br />
 </body>
</html>