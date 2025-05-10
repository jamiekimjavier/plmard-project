<?php

require_once 'connection.php';

if (!$con){
    ?>
        <script>alert("Connection Unsuccessful!!!")</script>
    <?php
}

function getAll($table, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
    $query_run = mysqli_query($con, $query);

    return $query_run;
}

function getByID($table, $id, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id'";
    return $query_run = mysqli_query($con, $query);
}

function getSlugActive($table, $slug, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug ='$slug' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
}

function getResearchByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM researches WHERE category_id ='$category_id' AND status='0' AND is_verified = 1";
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}


function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
}

?>