<?php
require_once 'connection.php';
session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT file, name FROM researches WHERE id='$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['file']) {
        $file = $row['file'];
        $file_path = 'uploads/' . $file;

        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf'); // Set the content type to application/pdf
            header('Content-Disposition: attachment; filename="' . $row['name'] . '.pdf"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        }
    }
}

@$my_var['file']; // this will suppress the "Undefined array key" warning message
// If submit button is clicked
if (isset($_POST['submit']))
{
    // get name from the form when submitted
    $file = $_FILES['file']['name'];
    $name = $_POST['name'];
    $authors = $_POST['authors'];
    $language = $_POST['language'];
    $chapters = $_POST['chapters'];
    $school_year = $_POST['school_year'];
    $abstract = $_POST['abstract'];
    $category_id = $_POST['category_id'];
    $folder='uploads/';
    $path=$folder.$file;

    if (isset($_FILES['file']['name'])) 
    { 
        // If the ‘pdf_file’ field has an attachment
        $file = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];

        // Move the uploaded pdf file into the pdf folder
        move_uploaded_file($file_tmp,"./uploads/".$file);

        // Insert the submitted data from the form into the table
        $insertquery = 
        "INSERT INTO researches(name,file,authors,language,chapters,school_year,abstract,category_id,register_user_id) VALUES('$name','$file','$authors','$language','$chapters','$school_year','$abstract','$category_id', '".$_SESSION['user_id']."')";
 
    // Execute insert query
    $iquery = mysqli_query($con, $insertquery);	 

        if ($iquery)
    {							 
?>											 
        <div class=
        "alert alert-success alert-dismissible fade show text-center">
            <a class="close" data-dismiss="alert" aria-label="close">
            ×
            </a>
            <strong>Success!</strong> Data submitted successfully.
        </div>
        <?php
        }
        else
        {
        ?>
        <div class=
        "alert alert-danger alert-dismissible fade show text-center">
            <a class="close" data-dismiss="alert" aria-label="close">
            ×
            </a>
            <strong>Failed!</strong> Try Again!
        </div>
        <?php
        }
    }
    else
    {
    ?>
        <div class=
        "alert alert-danger alert-dismissible fade show text-center">
        <a class="close" data-dismiss="alert" aria-label="close">
            ×
        </a>
        <strong>Failed!</strong> File must be uploaded in PDF format!
        </div>
    <?php
    }// end if
}// end ifs

?>

