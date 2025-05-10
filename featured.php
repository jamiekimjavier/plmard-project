<?php
require_once 'connection.php';
include('database_connection.php');

$con = mysqli_connect("localhost","root","","project");

session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">

</head>

</div>

<!-- Page Content - Displays all of the researches under certain category -->

<?php
$squery = mysqli_query($con, "SELECT * FROM researches WHERE is_verified = 1 AND featured = 1");

while (($result = mysqli_fetch_assoc($squery))) {
    $category_id = $result['category_id'];
    $category_id = mysqli_real_escape_string($con, $category_id);
    $selectQuery = "SELECT * from researches WHERE category_id = $category_id";
    $category_squery = mysqli_query($con, $selectQuery);
    $category_result = mysqli_fetch_assoc($category_squery);
?>

<div class="research_container">
    <div>
<h3>Title: <?php echo $result['name']; ?></h3>
        <p class="authors">Authors: <?php echo $result['authors']; ?></p>
        <p class = "category_id">Category: <?php echo $result['category_id']; ?></p>
        <p class = "abstract">Abstract: <?php echo $result['abstract']; ?></p>
        <p class = "school_year">Year Finished: <?php echo $result['school_year']; ?></p>
        <p class = "language">Language: <?php echo $result['language']; ?></p>
        <p class = "chapters">Chapters: <?php echo $result['chapters']; ?></p>
        <p class = "date">Date Uploaded: <?php echo $result['created_at']; ?></p>
    </div>
</div>

<?php
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>