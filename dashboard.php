<?php
require_once 'connection.php';
require_once 'sidebar.php';
include('database_connection.php');


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
    <link rel="stylesheet" href="dashboard.css">
</head>


<!-- sidebar open button -->

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>

<!-- Displays all the categories -->


<div class="container">
        <div class="row">
            <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="search.php" method="GET">
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


      <!-- Lets user open the researches under a category -->

      <?php
$squery = mysqli_query($con, "SELECT * FROM researches");

if (($result = mysqli_fetch_assoc($squery))) {
    $category_id = $result['category_id'];
    $selectQuery = "SELECT * from researches WHERE category_id = $category_id";
    $category_squery = mysqli_query($con, $selectQuery);
    $category_result = mysqli_fetch_assoc($category_squery);
?>

<!-- CATEGORIES -->
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Categories</h1>
                <div class="row">
                    <hr>
                    <?php
                    $categories = getAll("categories", $con);

                    if (mysqli_num_rows($categories) > 0) {
                        foreach ($categories as $name) {
                            ?>
                            <div class="col-md-3 mb-2">
                                <a href="researches.php?category_id=<?php echo $name['id']; ?>">
                                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                                        <div class="card-body">
                                            <img src="admin/categories/<?= $name['image']; ?>" alt="Category Image" class="w-100">
                                            <h4 class="text-center" class="text-black"><?= $name['name']; ?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No data available";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

    
<?php
                            }
    ?>


</body>


</html>