<?php

//forgot_password.php

include('database_connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendors/phpmailer/phpmailer/src/PHPMailer.php';
require './vendors/phpmailer/phpmailer/src/Exception.php';
require './vendors/phpmailer/phpmailer/src/SMTP.php';
require 'class.phpmailer.php';


?>


<div class="modal fade" id="deleteUploadModal" tabindex="-1" role="dialog" aria-labelledby="deleteUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUploadModalLabel">Request Upload Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
      <div class="modal-body">
        
        <p>To:</p><input type="email" name="to_email" value="plmard.official@gmail.com" required>
        
        <p>Email:</p><input type="email" name="from_email" required>

        <p>Name:</p><input type="text" name="from_name" required>
        
        <p>Title of Paper:</p><input type="text" name="subject" required value="Deletion Request:">
        
        <p>Reason for deletion:</p>
        <textarea id="deletionReason" class="form-control" rows="3" name="message"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-danger" name="sendemail" value="sendemail">Submit Request</button>
        </form>
      </div>
    </div>
  </div>
</div>