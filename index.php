<?php

//index.php

//error_reporting(E_ALL);

include('database_connection.php');

session_start();

if(isset($_SESSION["user_id"]))
{
 header("location:dashboard.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendors/phpmailer/phpmailer/src/PHPMailer.php';
require './vendors/phpmailer/phpmailer/src/Exception.php';
require './vendors/phpmailer/phpmailer/src/SMTP.php';
require 'class.phpmailer.php';

$connect = new PDO("mysql:host=localhost; dbname=project", "root", "");

$message = '';
$error_user_name = '';
$error_user_email = '';
$error_user_password = '';
$error_lrn = '';
$user_name = '';
$user_email = '';
$user_password = '';
$lrn = '';

if(isset($_POST["register"]))
{

if(empty($_POST["lrn"]))
{
 $error_lrn = "<label class='text-danger'>Enter LRN</label>";
}
else
{
$lrn = trim($_POST["lrn"]);
$lrn = htmlentities($lrn);
}

 if(empty($_POST["user_name"]))
 {
  $error_user_name = "<label class='text-danger'>Enter Name</label>";
 }
 else
 {
  $user_name = trim($_POST["user_name"]);
  $user_name = htmlentities($user_name);
 }

 if(empty($_POST["user_email"]))
 {
  $error_user_email = '<label class="text-danger">Enter Email Address</label>';
 }
 else
 {
  $user_email = trim($_POST["user_email"]);
  if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
  {
   $error_user_email = '<label class="text-danger">Enter Valid Email Address</label>';
  }
 }

 if(empty($_POST["user_password"]))
 {
  $error_user_password = '<label class="text-danger">Enter Password</label>';
 }
 else
 {
  $user_password = trim($_POST["user_password"]);
  $user_password = password_hash($user_password, PASSWORD_DEFAULT);
 }

 if($error_user_name == '' && $error_user_email == '' && $error_user_password == '' && $error_lrn == '')
 {
$agree_to_terms = isset($_POST["agree_to_terms"]) ? 1 : 0; // Add this line

  $user_activation_code = md5(rand());

  $user_otp = rand(100000, 999999);

  $data = array(
    ':user_email'  => $user_email,
    ':lrn'  => $lrn,
   ':user_name'  => $user_name,
   ':agree_to_terms' => $agree_to_terms,
   ':user_password' => $user_password,
   ':user_activation_code' => $user_activation_code,
   ':user_email_status'=> 'not verified',
   ':user_otp'   => $user_otp,
   ':agree_to_terms' => $agree_to_terms 
  );

  $query = "
  INSERT INTO register_user 
  (user_name, lrn, user_email, user_password, user_activation_code, user_email_status, user_otp, agree_to_terms) 
  SELECT * FROM (SELECT :user_name, :lrn, :user_email, :user_password, :user_activation_code, :user_email_status, :user_otp, :agree_to_terms) AS tmp
  WHERE NOT EXISTS (
      SELECT user_email FROM register_user WHERE user_email = :user_email
  ) LIMIT 1
  ";

  $statement = $connect->prepare($query);

  $statement->execute($data);

  if($connect->lastInsertId() == 0)
  {
   $message = '<label class="text-danger">Email Already Registered</label>';
  } 
  else
  {
 
   $statement = $connect->prepare($query);

   $statement->execute();

   $mail = new PHPMailer;
   $mail->IsSMTP();
   $mail->SMTPAuth = true;
   $mail->Host = 'smtp.gmail.com';
   $mail->Port = '587';
   $mail->Username = 'plmard.official@gmail.com';
   $mail->Password = 'yjwb gscp caug iqge';
   $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_SMTPS';
   $mail->From = 'plmard.official@gmail.com';
   $mail->FromName = 'PLMARD';
   $mail->AddAddress($user_email);
   $mail->WordWrap = 50;
   $mail->IsHTML(true);
   $mail->Subject = 'PLMARD Email Verification Code';

   $message_body = '
   <p>In order to verify your email address, please enter this verification code when prompted: <b>'.$user_otp.'</b>.</p>
   <p>Sincerely,</p>
   <p>PLMARD Team</p>
   ';
   $mail->Body = $message_body;

   if($mail->Send())
   {
    echo '<script>alert("Please Check Your Email for Verification Code")</script>';

    header('location:email_verify.php?code='.$user_activation_code);
   }
   else
   {
    $message = $mail->ErrorInfo;
   }
  }

 }
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://code.jquery.com/jquery.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 </head>
 <?php
    include('header.php');
  ?>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Registration</h3>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Registration</h3>
    </div>
    <div class="panel-body">
     <?php echo $message; ?>
     <form method="post">
      <div class="form-group">
       <label>Enter Your Name</label>
       <input type="text" name="user_name" class="form-control" />
       <?php echo $error_user_name; ?>
      </div>
      <div class="form-group">
       <label>Enter Your Email</label>
       <input type="text" name="user_email" class="form-control" />
       <?php echo $error_user_email; ?>
      </div>
      <div class="form-group">
       <label>Enter Your LRN</label>
       <input type="text" name="lrn" class="form-control" />
       <?php echo $error_lrn; ?>
      </div>
      <div class="form-group">
       <label>Enter Your Password</label>
       <input type="password" name="user_password" class="form-control" id="user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and one lowercase letter, and at least 8 or more characters" required />
       <div id="passwordStrength"></div>
       <?php echo $error_user_password; ?>
      </div>
      <div class="form-group">
      <input type="checkbox" name="agree_to_terms" id="agree_to_terms" required /> I agree to the <a href="terms_and_conditions.html" target="_blank">Terms and Conditions</a>
       <input type="submit" name="register" class="btn btn-success" value="Click to Register" />&nbsp;&nbsp;&nbsp;
       <a href="resend_email_otp.php" class="btn btn-default">Resend OTP</a>
       &nbsp;&nbsp;&nbsp;
       <a href="role_selection.php">Login</a>
      </div>
     </form>
    </div>
   </div>
  </div>
  
  <script>
  // Validate password strength
  function validatePassword() {
    var password = document.getElementById("user_password").value;
    var passwordStrength = document.getElementById("passwordStrength");

    // Validate minimum length
    if (password.length < 8) {
      passwordStrength.style.color = "red";
      passwordStrength.innerHTML = "Too short";
      return false;
    }

    // Validate at least one number
    if (!password.match(/\d/)) {
      passwordStrength.style.color = "red";
      passwordStrength.innerHTML = "No number found";
      return false;
    }

    // Validate at least one uppercase letter
    if (!password.match(/[A-Z]/)) {
      passwordStrength.style.color = "red";
      passwordStrength.innerHTML = "No uppercase found";
      return false;
    }

    // Validate at least one lowercase letter
    if (!password.match(/[a-z]/)) {
      passwordStrength.style.color = "red";
      passwordStrength.innerHTML = "No lowercase found";
      return false;
    }

    // Validate at least one special character
    if (!password.match(/[!@#$%^&*(),.?":{}|<>]/)) {
      passwordStrength.style.color = "red";
      passwordStrength.innerHTML = "No special character found";
      return false;
    }

    // If all checks pass, show success message
    passwordStrength.style.color = "green";
    passwordStrength.innerHTML = "Strong password";
    return true;
  }

  // Add event listener for input change
  document.getElementById("user_password").addEventListener("input", validatePassword);
</script>
  <br />
  <br />
  <?php
    include('footer.php');
  ?>
  <br />
  <br />
 </body>
</html>