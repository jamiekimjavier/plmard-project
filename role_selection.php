<?php
require_once 'connection.php';
include('database_connection.php');

session_start();

?>

<!DOCTYPE html>
<html>
 <header>
  <title>PLMARD Login</title>
  <nav>
  <div class="dropdown">
                <button class="dropbtn">Home</button>
                <div class="dropdown-content">
                   <a href="#">Featured</a>
                   <a href="#">Latest</a>
                </div>
               </div>
            <div class="dropdown">
                <button class="dropbtn">About</button>
                <div class="dropdown-content">
                   <a href="aboutplmard.html">PLMARD</a>
                   <a href="aboutresearch.html">Research</a>
                   <a href="aboutteam.html">Team</a>
                </div>
               </div>
            <div class="dropdown">
                <button class="dropbtn">Studies</button>
                <div class="dropdown-content">
                   <a href="filterpopup.html">Search</a>
                   <a href="categories.php">Categories</a>
                   <a href="#">Upload</a>
                </div>
               </div>
            <div class="dropdown">
                <button class="dropbtn">Log In/Sign Up</button>
                <div class="dropdown-content">
                   <a href="role_selection.php">Log In</a>
                   <a href="index.php">Sign Up</a>
                </div>
               </div>
  </nav>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://code.jquery.com/jquery.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="loginstyle.css">
    </header>

    <div class="container">
   <h2 align="center">Login</h2>
    <main>
        <section class="login-container">
            <div class="user-role-selection">
                <div class="user-role-option" data-role="user" onclick="showEmailSection('user')" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <a href="login.php"><img src="img/user.png" alt="User Icon" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); cursor: pointer; width: 100px; height: 100px; margin-bottom: 10px;"></a>
                    <p>User</p>
                </div>
                <div class="user-role-option" data-role="admin" onclick="showEmailSection('admin')" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <a href="admin_login.php"><img src="img/admin.png" alt="Admin Icon" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); cursor: pointer; width: 100px; height: 100px; margin-bottom: 10px;"></a>
                    <p>Admin</p>
                </div>
            </div>
        </section>
    </main>
</div>