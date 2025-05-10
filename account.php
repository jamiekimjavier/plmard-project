<?php
require_once 'sidebar.php';
require_once 'account_functions.php';
require_once 'database_connection.php';
require_once 'connection.php';
session_start();


//checks for login
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == '') {
    // User is not logged in, redirect to role_selection.php
    header("location: role_selection.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-vBvzF+m2mM9JQeValApsYFjorlGrwBzAvhyJHrZc/JQ8xRRXZC5c9Qpbvys5kCxi9nU22OrXO7qg4icVWZq4uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="accounts.css">

</head>

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>

<div class="container">

      <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
          <div class="card">
            <div class="card-body">
              <nav class="nav flex-column nav-pills nav-gap-y-1">
                <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Account Management
                </a>
                <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Account Information
                </a>
                <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>Settings
                </a>
                <a href="#notification" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell mr-2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>About
                </a>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header border-bottom mb-3 d-flex d-md-none">
              <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                <li class="nav-item">
                  <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                </li>
                <li class="nav-item">
                  <a href="#account" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                </li>
                <li class="nav-item">
                  <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                </li>
                <li class="nav-item">
                  <a href="#notification" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                </li>
              </ul>
            </div>

            <?php
        //connection
        $conn = new mysqli('localhost', 'root', '', 'project');
        
        //get user details
        $sql = "SELECT * FROM register_user WHERE register_user_id = '".$_SESSION['user_id']."'";
        $squery = $conn->query($sql);
        $row = $squery->fetch_assoc();
            ?>

            <div class="card-body tab-content">
              <div class="tab-pane active" id="profile">
                <h6>ACCOUNT MANAGEMENT</h6>
                <hr>
                <form>
                <div class="form-group">
                <h9>Full Name: <?php echo $_SESSION["user_name"]; ?></h9>
              </div>
                  <div class="form-group">
              <h9>Email Address: <?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></h9>
            </div>
            </form>

            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $newEmail = $_POST["newEmail"];
  $confirmNewEmail = $_POST["confirmNewEmail"];

  // Check if the new email and confirmed new email match
  if ($newEmail === $confirmNewEmail) {
    // Update the user's email address in the database
    $query = "UPDATE register_user SET user_email = ? WHERE register_user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $newEmail, $_SESSION['user_id']);
    $result = $stmt->execute();

    if ($result) {
      // Email address updated successfully, refresh the page
      echo "Email Successfully Changed. Refresh to see result.";
      exit();
    } else {
      echo "Error updating email address.";
    }

    $stmt->close();
  } else {
    echo "The new email addresses do not match.";
  }
}
?>

<form  action="account.php" method="POST">
  <div class="form-group">
    <label for="newEmail">New Email Address:</label>
    <input type="email" class="form-control" id="newEmail" name="newEmail" required>
  </div>
  <div class="form-group">
    <label for="confirmNewEmail">Confirm New Email Address:</label>
    <input type="email" class="form-control" id="confirmNewEmail" name="confirmNewEmail" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit and Confirm</button>
</form>


              <div class="panel-heading">
					<h6 class="panel-title">Change Password</h6>
          <a href="forgot_password.php?step1=1" class="btn btn-primary">Change Password</a>
				</div>
      </div>

      




			

             
                  
                                



              <div class="tab-pane" id="security">
                <h6>FEEDBACK</h6>
                <p>We would like to hear your feedback to improve our site.</p>
                <hr>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                  
                  <p>To:</p><input type="email" name="to_email" value="plmard.official@gmail.com" required>
                  
                  <p>Email:</p><input type="email" name="from_email" required>

                  <p>Name:</p><input type="text" name="from_name" required>
                  
                  <p>Subject:</p><input type="text" name="subjects" required>
                    <br>
                  <textarea id="deletionReason" class="form-control" rows="3" name="message"></textarea>
                <div class="footer">
          <button type="submit" class="btn btn-danger" name="feedback" value="feedback">Feedback</button>
                  </form>
                </div>
              </div>


              

              <div class="tab-pane" id="notification">
                <h6>ABOUT</h6>
                <hr>




              </div>
            


                  <div class="tab-pane" id="account">
  <h6>ACCOUNT INFORMATION</h6>
  <hr>
  <div class="row">
    <div class="col-md-6">
      <h6>Account Verification Status</h6>
      <p>
        <?php
          // **1. Connect to the database:**
          require_once 'connection.php';  // Assuming connection details are in a separate file
          $mysqli = new mysqli("localhost", "root", "", "project");  // Adjust for your database settings

          // **2. Get the user ID from the session:**
          $user_id = $_SESSION["user_id"];  // Assuming user ID is stored in a session variable

          // **3. Query the database for verification status:**
          $query = "SELECT is_verified FROM register_user WHERE register_user_id = '$user_id'";
          $result = $mysqli->query($query);

          // **4. Check the result and display verification status:**
          if ($result && $result->num_rows > 0 && $row = $result->fetch_assoc()) {
            // User found in database
            if ($row["is_verified"] == 1) {
              echo '<i class="fas fa-check-circle text-success"></i> Verified';
            } else {
              echo '<i class="fas fa-times-circle text-danger"></i> Not Verified';
            }
          } else {
            // User not found or error occurred
            echo "Verification status could not be retrieved.";
          }

          // **5. Close the database connection:**
          $mysqli->close();
        ?>
      </p>
    </div>
  </div>

    <div class="col-md-6">
      <h6>Upload Verification Status</h6>
      <ul>
        <?php
        
        function get_user_uploads($conn, $user_id) {
          $sql = "SELECT r.id, r.name, r.is_verified
                  FROM researches r
                  WHERE r.register_user_id = ?";
          $stmt = mysqli_prepare($conn, $sql);

          mysqli_stmt_bind_param($stmt, "i", $user_id);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          $uploads = [];

          while ($row = mysqli_fetch_assoc($result)) {
            $uploads[] = $row;
          }

          mysqli_stmt_close($stmt);
          return $uploads;
        }
                // Assuming you have a function to fetch user uploads with verification status
        $user_id = $_SESSION['user_id']; // Replace with appropriate session variable
        $uploads = get_user_uploads($conn, $user_id);
        
        // Process and display uploads as needed
        foreach ($uploads as $upload) {
          echo '<tr>';
          echo '<td>' . $upload['name'] . '</td>';
          echo '<td>';
          if ($upload['is_verified'] == 1) {
            echo '<i class="fas fa-check-circle text-success"></i> Verified';
          } else {
            echo '<i class="fas fa-times-circle text-danger"></i> Not Verified';
          }
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </ul>
    </div>
  <hr>
  <h6>Request Upload Deletion</h6>
  <p class="text-muted font-size-sm">
    Once you request deletion, an admin will review your request within 1-5 business days. The research will only be deleted if approved.
  </p>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUploadModal">
    Request Upload Deletion
  </button>
  <hr>
  <h6> Account Deletion</h6>
<p class="text-muted font-size-sm">
  Once you delete your account, your data will be removed from the database, but the researches you have uploaded will remain unless requested for deletion.
</p>
<form method="get" action="delete_account.php">
  <input type="hidden" name="confirm" value="yes">
  <button type="submit" class="btn btn-danger">
    Confirm Account Deletion
  </button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>


<?php


// Check if form is submitted
if(isset($_POST["sendemail"])) {
    // Get user input
    $to_email = $_POST["to_email"];
    $from_email = $_POST["from_email"];
    $subject = $_POST["subject"] . ' ' . $_POST["from_name"];
    $message = $_POST["message"] . ' Sent by: ' . $_POST["from_email"];
    $from_name = $_POST["from_name"];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                           
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';
        $mail->SMTPAuth = true;           
        $mail->FromName = $from_name;
        $mail->Username = 'plmard.official@gmail.com';
        $mail->Password = 'yjwb gscp caug iqge';
        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_SMTPS';    
        $mail->setFrom($from_email, $from_name);
        $mail->addAddress($to_email, 'PLMARD');
        $mail->WordWrap = 50;
        $mail->isHTML(true);                                       
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST["feedback"])) {
  // Get user input
  $to_email = $_POST["to_email"];
  $from_email = $_POST["from_email"];
  $subject = $_POST["subject"] . ' ' . $_POST["from_name"];
  $message = $_POST["message"] . ' Sent by: ' . $_POST["from_email"];
  $from_name = $_POST["from_name"];

  // Create a new PHPMailer instance
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->isSMTP();                                           
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = '587';
      $mail->SMTPAuth = true;           
      $mail->FromName = $from_name;
      $mail->Username = 'plmard.official@gmail.com';
      $mail->Password = 'yjwb gscp caug iqge';
      $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_SMTPS';    
      $mail->setFrom($from_email, $from_name);
      $mail->addAddress($to_email, 'PLMARD');
      $mail->WordWrap = 50;
      $mail->isHTML(true);                                       
      $mail->Subject = $subject;
      $mail->Body    = $message;
      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

          
?>
