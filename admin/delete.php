<?php
require_once 'connection.php';

if (isset($_GET['delete_register_user_id'])) {
    $id = $_GET['delete_register_user_id'];
    $query = "DELETE FROM register_user WHERE register_user_id = $id";
    mysqli_query($con, $query);
    header("Location: display_accounts.php");
    }

 if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $query = "DELETE FROM researches WHERE id = $id";
        mysqli_query($con, $query);
        header("Location: display_researches.php");
        }
    

?>