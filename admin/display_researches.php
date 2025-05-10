<?php
include('connection.php');
include('sidebar.php');

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="admin.css">
</head>

<!-- sidebar open button -->

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>

<body>
        
<div class="content-section">
  
  <?php
  include ('connection.php');
  $sql = "SELECT * FROM researches";
  $result = mysqli_query($con, $sql);

  
  echo "<table class='table table-bordered'>
  <tr>
  <th>ID</th>
  <th>Name</th>
  <th>File</th>
  <th>Authors</th>
  <th>Language</th>
  <th>Chapters</th>
  <th>Year</th>
  <th>Date Uploaded</th>
  <th>Featured</th>
  <th>Is Verified</th>
  <th>Action</th>
  <th>Action</th>
  </tr>";
  
  while ($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['file'] . "</td>";
      echo "<td>" . $row['authors'] . "</td>";
      echo "<td>" . $row['language'] . "</td>";
      echo "<td>" . $row['chapters'] . "</td>";
      echo "<td>" . $row['school_year'] . "</td>";
      echo "<td>" . $row['created_at'] . "</td>";
      echo "<td>" . ($row['featured'] == 1 ? 'Yes' : 'No') . "</td>";
      echo "<td>" . ($row['is_verified'] == 1 ? 'Yes' : 'No') . "</td>";
      if ($row['is_verified'] == 0) {
          echo '<td?><a href="verify.php?verify_id=' . $row["id"] . '" class="btn btn-primary">Verify</a></td>';        
        }
        else {
            echo '<td><a href="delete.php?delete_id=' . $row["id"] . '" class="btn btn-primary">Delete</a>
                  <a href="verify.php?featured_id=' . $row["id"] . '" class="btn btn-primary">Feature</a></td>';
          }
      }
      
  
        echo "</table>"; 
  
        if (mysqli_num_rows($result) == 0) {
          echo "No Researches Found.";
        }
  
  ?>
  </div>
</body>
</html>