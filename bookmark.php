<?php
session_start();
require_once 'connection.php';
require_once 'sidebar.php';
include('database_connection.php');

//Checks for bookmarks

$user_id = $_SESSION["user_id"];
$bookmarks = array();

if(isset($_SESSION["bookmarks"]))
{
    $bookmarks = $_SESSION["bookmarks"];
}

//gets IDs by Bookmarks

if(isset($_GET["pdf_id"]))
{
    $pdf_id = $_GET["pdf_id"];

    if(!isset($_SESSION["bookmarks"]))
    {
        $_SESSION["bookmarks"] = array();
    }

    if(!in_array($pdf_id, $_SESSION["bookmarks"]))
    {
        $_SESSION["bookmarks"][] = $pdf_id;
    }
}

$citations = "";

if(!empty($bookmarks))
{
    $bookmarks_str = implode(',', $bookmarks);
    $sql = "SELECT * FROM researches WHERE id IN ($bookmarks_str) ORDER BY name";
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_assoc($result))
    {
        $citations .= getCitation($row) . "\n";
    }
}

//Gets citations from bookmarks

function getCitation($row)
{
    return sprintf(
        '%s (%s). %s. Pamantasan ng Lungsod ng Marikina Senior High School',
        $row['authors'],
        $row['school_year'],
        $row['name']
    );
}


if (isset($_POST['id'])) {
    $bookmarkId = $_POST['id'];
    $bookmarks = $_SESSION['bookmarks'];
    $index = array_search($bookmarkId, $bookmarks);

    if ($index !== false) {
        unset($bookmarks[$index]);
        $_SESSION['bookmarks'] = $bookmarks;
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>