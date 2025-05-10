<?php
require_once 'connection.php';
require_once 'download.php';
require_once 'view_pdf.php';
require_once 'bookmark.php';
include('database_connection.php');


session_start();
error_reporting(E_ALL ^ E_NOTICE);


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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-vBvzF+m2mM9JQeValApsYFjorlGrwBzAvhyJHrZc/JQ8xRRXZC5c9Qpbvys5kCxi9nU22OrXO7qg4icVWZq4uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">

</head>

<body>
    <html>

<!-- Search Bar -->

<div class="container">
        <div class="row">
            <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="search_viewer.php" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <?php require_once 'filters.php'; ?>
                                        <div class="text-left">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            <i class="fas fa-filter fa-lg text-white"></i>
                                        </button>
                                            </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>

            <!-- Search Results -->

            <?php
                                    

                                    $squery = mysqli_query($con, "SELECT * FROM researches WHERE is_verified = 1");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = isset($_GET['search']) ? $_GET['search'] : '';
                                        $query = "SELECT * FROM researches WHERE CONCAT(name,authors,abstract,school_year,language,created_at) LIKE '%$filtervalues%' AND is_verified = 1";
                                        $query_run = mysqli_query($con, $query);

                                        $category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
                                        if ($category_id > 0) {
                                            $query .= " AND category_id = $category_id";
                                        }
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                $result = mysqli_fetch_assoc($squery)
                                                ?>
                                                <div class="research_container">
                                                    <div>
                                                <h3>Title: <?= $items['name']; ?></h3>
                                                        <p class="authors">Authors: <?= $items['authors']; ?></p>
                                                        <p class = "category_id">Category: <?= $items['category_id']; ?></p>
                                                        <p class = "abstract">Abstract: <?= $items['abstract']; ?></p>
                                                        <p class = "school_year">Year Finished: <?= $items['school_year']; ?></p>
                                                        <p class = "language">Language: <?= $items['language']; ?></p>
                                                        <p class = "chapters">Chapters: <?= $items['chapters']; ?></p>
                                                        <p class = "date">Date Uploaded: <?= $items['created_at']; ?></p>
</div>
                                                </div>


<?php
                                            }
                                        }
                                    }
                                    
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                ?>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>