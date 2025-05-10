<?php
require_once 'connection.php';
session_start();

// Get the user's name and ID from the session
$user_name = '';
$user_id = '';
if (isset($_SESSION["user_name"], $_SESSION["user_id"])) {
    $user_name = $_SESSION["user_name"];
    $user_id = $_SESSION["user_id"];
}


// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "project");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Query the database to check the user's verification status
$query = "SELECT is_verified FROM register_user WHERE register_user_id = '$user_id' ";
$result = $mysqli->query($query);

// Check if the user is logged in
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == '') {
    // User is not logged in, redirect to role_selection.php
    header("location: role_selection.php");
    exit();
}

// If the query was successful and the user is verified, allow them to access the page
if ($result && $result->num_rows > 0 && $row = $result->fetch_assoc()) {
    if ($row["is_verified"] == 1) {
        // User is verified, allow them to access the page
    } else {
        // User is not verified, redirect them to the dashboard
        header("location:dashboard.php");
        exit();
    }
} else {
    // Query failed or user not found, redirect to an error page
    header("location:role_selection.php");
    exit();
}

// Close the database connection
$mysqli->close();
?>