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
        $sql = "SELECT * FROM register_user";
        $result = mysqli_query($con, $sql);

        echo "
        <table class='table table-bordered'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Email Verification</th>
        <th>Account Creation Date</th>
        <th>LRN</th>
        <th>User Role</th>
        <th>Agree to Terms</th>
        <th>Verified</th>
        <th>Action</th>
        <th>Make Admin</th>
        </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['register_user_id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['user_email'] . "</td>";
            echo "<td>" . $row['user_email_status'] . "</td>";
            echo "<td>" . $row['user_datetime'] . "</td>";
            echo "<td>" . $row['lrn'] . "</td>";
            echo "<td>" . $row['user_role'] . "</td>";
            echo "<td>" . $row['agree_to_terms'] . "</td>";
            echo "<td>" . ($row['is_verified'] == 1 ? 'Yes' : 'No') . "</td>";
            if ($row['is_verified'] == 0) {
                echo '<td><a href="verify.php?verify_register_user_id=' . $row["register_user_id"] . '" class="btn btn-primary">Verify</a>
                        <a href="delete.php?delete_register_user_id=' . $row["register_user_id"] . '" class="btn btn-primary">Delete</a></td>';
            } else {
                echo '<td><a href="delete.php?delete_register_user_id=' . $row["register_user_id"] . '" class="btn btn-primary">Delete</a></td>';
            }
            echo "<td><a href='make_admin.php?make_admin_register_user_id=" . $row["register_user_id"] . "' class='btn btn-primary'>Make Admin</a></td>";
            echo "</tr>";
        }

        echo "
        </table>";

        if (mysqli_num_rows($result) == 0) {
            echo "No Accounts Found.";
        }
        ?>
    </div>
</body>
</html>