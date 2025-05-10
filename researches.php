<?php
require_once 'connection.php';
require_once 'download.php';
require_once 'view_pdf.php';
require_once 'bookmark.php';
require_once 'sidebar.php';
include('database_connection.php');

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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-vBvzF+m2mM9JQeValApsYFjorlGrwBzAvhyJHrZc/JQ8xRRXZC5c9Qpbvys5kCxi9nU22OrXO7qg4icVWZq4uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">

</head>

<!-- sidebar open button -->

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>

<?php
    $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

    if ($category_id > 0) {
        $category_query = "SELECT * FROM categories WHERE id = $category_id";
        $category_result = mysqli_query($con, $category_query);
        $category_name = mysqli_fetch_assoc($category_result)['name'];
?>

<h1 class="category-name mb-4"><?= htmlspecialchars($category_name); ?></h1>

<?php
    }
?>

 <!-- Search Bar -->

<body>

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
<h3>Title: <?php echo $result['name']; ?></h3>
        <p class="authors">Authors: <?php echo $result['authors']; ?></p>
        <p class = "category_id">Category: <?php echo $result['category_id']; ?></p>
        <p class = "abstract">Abstract: <?php echo $result['abstract']; ?></p>
        <p class = "school_year">Year Finished: <?php echo $result['school_year']; ?></p>
        <p class = "language">Language: <?php echo $result['language']; ?></p>
        <p class = "chapters">Chapters: <?php echo $result['chapters']; ?></p>
        <p class = "date">Date Uploaded: <?php echo $result['created_at']; ?></p>
        <a href="download.php?id=<?php echo $result['id']; ?>" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
        <button class="btn btn-success" onclick="openForm('<?php echo $result['authors']; ?>', '<?php echo $result['school_year']; ?>', '<?php echo $result['name']; ?>')"><i class="fa fa-quote-left"></i> Cite </button>
        <button onclick="bookmark('<?php echo $result['id']; ?>')" class="btn btn-primary"><i class="fa fa-bookmark-o"></i> Bookmark</button>
        <a href="view_pdf.php?pdf_id=<?php echo $result['id']; ?>" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> View PDF</a>
    </div>
</div>

<script>
function bookmark(pdf_id) {
    // Send a GET request to bookmark.php with the pdf_id parameter
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `bookmark.php?pdf_id=${pdf_id}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Display a message to the user
            alert('Bookmark added successfully!');
        } else {
            // Display an error message to the user
            alert('Error adding bookmark.');
        }
    };
    xhr.send();
}
</script>


 <!-- Citation Modal Script -->

<div class="form-popup" id="myForm">
  <form action class="form-container">
    <input type="text" value="<?php echo $result['authors']; ?> (<?php echo $result['school_year']; ?>). <?php echo $result['name']; ?>. Pamantasan ng Lungsod ng Marikina Senior High School" id="myInput">
    <button type="button" class="btn" onclick="myFunction()">Copy text</button>
    <br>
    <br>
    <script>
    function myFunction() {
      // Get the text field
      var copyText = document.getElementById("myInput");
    
      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices
    
      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
      
      // Alert the copied text
      alert("Copied the text: " + copyText.value);
    }
    </script>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<?php
                            }
    }
    ?>

 <!-- Citation Modal -->

<script>
function openForm(authors, school_year, name) {
  document.getElementById("myInput").value = `${authors} (${school_year}). ${name}. Pamantasan ng Lungsod ng Marikina Senior High School`;
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>