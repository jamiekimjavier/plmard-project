

</head>
<body>

<!-- Button to trigger modal -->
<br>
<br>


<!-- Modal -->
<div class="modal fade" id="myModal" style="z-index: 9999999">
  <div class="modal-dialog" style="z-index: 9999999">
    <div class="modal-content" style="z-index: 9999999">
    
      <!-- Modal Header -->
      <div class="modal-header" style="z-index: 9999999">
        <h4 class="modal-title">Filter</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body" style="z-index: 9999999">
        <form method="post" action="">
        <div class="form-group" style="z-index: 9999999">
          <label for="name">Title:</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group" style="z-index: 9999999">
          <label for="authors">Authors:</label>
          <input type="text" class="form-control" id="authors" name="authors">
        </div>
        <div class="form-group" style="z-index: 9999999">
          <label for="created_at">Created At:</label>
          <input type="text" class="form-control" id="created_at" name="created_at">
        </div>
        <div class="form-group" style="z-index: 9999999">
          <label for="school_year">School Year:</label>
          <input type="text" class="form-control" id="school_year" name="school_year">
        </div>
        <div class="form-group" style="z-index: 9999999">
          <label for="chapters">Chapters:</label>
          <input type="text" class="form-control" id="chapters" name="chapters">
        </div>
        <!-- Add the category dropdown here -->
        <div style="z-index: 9999999">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category">
                <option value="">All Categories</option>
                <?php
                $categories = getAll("categories", $con);
                if (mysqli_num_rows($categories) > 0) {
                    foreach ($categories as $category) {
                        echo "<option value='{$category['id']}'>{$category['name']}</option>";
                    }
                } else {
                    echo "<option value=''>No categories found</option>";
                }
                ?>
            </select>
        </div>

        <!-- Sort Options -->
        <div class="row" style="z-index: 9999999">
          <div class="col" style="z-index: 9999999">
            <strong>Arrange by:</strong><br>
            <label><input type="radio" name="arrange" value="date"> Date Published</label><br>
          </div>
          <div class="col" style="z-index: 9999999">
            <strong>&nbsp;</strong><br>
            </div>
          <div style="z-index: 9999999">
        <label><input type="radio" name="arrange" value="title"> Title</label><br>
        </div>
        <div class="col" style="z-index: 9999999">
        <strong>&nbsp;</strong><br>
        <label><input type="radio" name="arrange" value="school_year"> School Year</label><br>
        </div>
        </div>

        <!-- Sort Direction -->
        <div class="row" style="z-index: 9999999">
        <div class="col" style="z-index: 9999999">
        <strong>Sort Direction:</strong><br>
        <label><input type="radio" name="direction" value="asc"> Ascending</label><br>
        </div>
        <div class="col" style="z-index: 9999999">
        <strong>&nbsp;</strong><br>
        <label><input type="radio" name="direction" value="desc"> Descending</label><br>
        </div>
        </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer" style="z-index: 9999999">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="filter_submit">Apply Changes</button>
        </form>
        </div>
        </div>
        </div>
        </div>

<?php
if (isset($_POST['filter_submit'])) {
// Handle form submission here
$name = $_POST['name'];
$authors = $_POST['authors'];
$created_at = $_POST['created_at'];
$school_year = $_POST['school_year'];
$chapters = $_POST['chapters'];
$arrange = $_POST['arrange'];
$direction = $_POST['direction'];
$category = $_POST['category'];

// Create connection

// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Prepare the SQL query
$sql = "SELECT * FROM entries WHERE 1=1";

// Add conditions based on form data
if (!empty($title)) {
$sql .= " AND title LIKE '%$title%'";
}
if (!empty($authors)) {
$sql .= " AND authors LIKE '%$authors%'";
}
if (!empty($date)) {
$sql .= " AND date LIKE '%$date%'";
}
if (!empty($school_year)) {
$sql .= " AND school_year = '$school_year'";
}
if (!empty($chapters)) {
$sql .= " AND chapters LIKE '%$chapters%'";
}
if (!empty($categories)) {
  $sql .= " AND categories LIKE '%$categories%'";
  }

// Add sorting
if ($arrange == 'date') {
$sql .= " ORDER BY date_published";
} elseif ($arrange == 'name') {
$sql .= " ORDER BY name";
} elseif ($arrange == 'school_year') {
$sql .= " ORDER BY school_year";
}

if ($direction == 'desc') {
$sql .= " DESC";
}

// Execute the query
$result = mysqli_query($con, $sql);

// Display the results
if (mysqli_num_rows($result) > 0) {
// Display the results
} else {
echo "No results found";
}

// Close the connection
mysqli_close($con);
}
?>