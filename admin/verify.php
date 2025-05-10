<?php
require_once 'connection.php';

if (isset($_GET['verify_register_user_id'])) {
    $id = $_GET['verify_register_user_id'];
    $query = "UPDATE register_user SET is_verified = 1 WHERE register_user_id = $id";
    mysqli_query($con, $query);
    header("Location: display_accounts.php");
}

if (isset($_GET['verify_id'])) {
    $id = $_GET['verify_id'];
    $query = "UPDATE researches SET is_verified = 1 WHERE id = $id";
    mysqli_query($con, $query);
    header("Location: display_researches.php");
}

if (isset($_GET['featured_id'])) {
    $id = $_GET['featured_id'];
    $query = "UPDATE researches SET featured = 1 WHERE id = $id";
    mysqli_query($con, $query);
    header("Location: display_researches.php");
}



?>
