<?php
require_once 'connection.php';
require_once 'download.php';
require_once 'sidebar.php';

session_start();

require_once 'checks.php';

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
<body>

    <!-- sidebar open button -->

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>

<div>
        <div class="container">
            <div class="form-input py-2">
            <h2 class="form-title">Upload Research</h2>
            <form action="research_upload.php" method="POST" enctype="multipart/form-data" oninput="maxFileSize.setCustomValidity(maxFileSize.checkValidity() ? '' : 'File size should not exceed 20 MB.')" maxFileSize="20000000">
            <div class="form-group">
                <label class="form-label" for="name">Research Title:</label>
                <input class="form-control" type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="file">Upload Research *.pdf only </label>
                <input class="form-control" type="file" id="file" name="file" accept=".pdf" required>
                <p class="form-help">Please compress the file if it exceeds 20 MB. Maximum file size is 20 MB.</p>
            </div>
            <div class="form-group">
                <label class="form-label" for="authors">Authors:</label>
                <input class="form-control" type="text" id="authors" name="authors" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="language">Language:</label>
                <input class="form-control" type="text" id="language" name="language" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="chapters">Chapters:</label>
                <input class="form-control" type="text" id="chapters" name="chapters" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="school_year">School Year:</label>
                <input class="form-control" type="number" id="school_year" name="school_year" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="abstract">Abstract/Summary:</label>
                <textarea class="form-control" id="abstract" name="abstract" rows="5" required></textarea>
            </div>
            <div class="form-group">
        <label class="form-label" for="categories">Select Category:</label>
        <select name="category_id" class="form-select">
        <option selected>Select Category</option>
           <?php
                         $categories = getAll("categories", $con);

                         if(mysqli_num_rows($categories) > 0)
                         {
                         foreach($categories as $name)
                        {
                    ?>
                    <option value="<?= $name['id']; ?>"><?= $name['name']; ?></option>
                    <?php
                }
            } else {
                echo "No Category Available";
            }
            ?>
            </select>
        </div>
            <button class="form-submit" type="submit" name="submit">Submit</button>
            </form>
            </div>
    </div>
        </div>
    </div>
    </body>
</html>