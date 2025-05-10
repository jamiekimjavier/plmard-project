<?php
require_once 'connection.php';
include('database_connection.php');

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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-vBvzF+m2mM9JQeValApsYFjorlGrwBzAvhyJHrZc/JQ8xRRXZC5c9Qpbvys5kCxi9nU22OrXO7qg4icVWZq4uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">

</head>

 <!-- Search Bar -->

<body>

<?php
    $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

    if ($category_id > 0) {
        $category_query = "SELECT * FROM categories WHERE id = $category_id";
        $category_result = mysqli_query($con, $category_query);
        $category_name = mysqli_fetch_assoc($category_result)['name'];
?>

<h1 class="category-name mb-4"><?= htmlspecialchars($category_name); ?></h1>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="search_viewer.php" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" value="<?php if(isset($_GET['search_view'])){echo $_GET['search_view']; } ?>" class="form-control" placeholder="Search data">
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

<!-- Page Content - Displays all of the researches under certain category -->

<?php

    $query = "SELECT * FROM researches WHERE category_id = $category_id AND is_verified = 1";
    $query_run = mysqli_query($con, $query);
    $results_count = mysqli_num_rows($query_run);

    if ($results_count > 0) {
        while ($result = mysqli_fetch_assoc($query_run)) {
?>
            <div class="research_container">
                <div>
                    <h3>Title: <?= $result['name']; ?></h3>
                    <p class="authors">Authors: <?= $result['authors']; ?></p>
                    <p class="category_id">Category: <?= $result['category_id']; ?></p>
                    <p class="abstract">Abstract: <?= $result['abstract']; ?></p>
                    <p class="school_year">Year Finished: <?= $result['school_year']; ?></p>
                    <p class="language">Language: <?= $result['language']; ?></p>
                    <p class="chapters">Chapters: <?= $result['chapters']; ?></p>
                    <p class="date">Date Uploaded: <?= $result['created_at']; ?></p>
                </div>
            </div>
<?php
        }
    } else {
        echo "No data available";
    }
} else {
    echo "Invalid category ID";
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>