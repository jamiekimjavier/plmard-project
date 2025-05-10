
<?php
require_once 'connection.php';

// Check if the user is logged in and has requested account deletion
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['confirm']) || $_GET['confirm'] != 'yes') {
    die('Unauthorized access.');
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Delete the user's account and all related data
$query = "DELETE FROM register_user WHERE register_user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$result = $stmt->execute();

if ($result) {
    // Account deletion successful, redirect the user to the login page
    session_destroy();
    header('Location: login.php');
    exit;
} else {
    // Account deletion failed, show an error message
    echo 'Error deleting account. Please try again later.';
}

$conn->close();
?>