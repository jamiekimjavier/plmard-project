<?php
require_once 'connection.php';

if (isset($_GET['make_admin_register_user_id'])) {
    $id = $_GET['make_admin_register_user_id'];
    $query = "UPDATE register_user SET user_role = 'admin' WHERE register_user_id = $id";
    mysqli_query($con, $query);
    header("Location: display_accounts.php");
}

?>