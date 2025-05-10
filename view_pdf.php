<?php
require_once 'connection.php';

session_start();

require_once 'checks.php';

if (isset($_GET['pdf_id'])) {
    $id = mysqli_real_escape_string($con, $_GET['pdf_id']);
    $query = "SELECT file FROM researches WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && file_exists('uploads/' . $row['file'])) {
        $file_path = 'uploads/' . $row['file'];
        $file_content = file_get_contents($file_path);
        $base64_pdf = base64_encode($file_content);
        $data_uri = 'data:application/pdf;base64,' . $base64_pdf;
?>

<!DOCTYPE html>
<html>
  <header>
    <style>
      #pdf_viewer {
        width: 100%;
        height: 100vh;
      }
    </style>
  </header>
  <body>
    <div>
      <object id="pdf_viewer" data="<?php echo $data_uri; ?>" type="application/pdf"></object>
    </div>
  </body>
</html>

<?php
    }
}

?>