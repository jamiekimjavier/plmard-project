<!-- Sidebar -->

<div id="mySidebar" class="sidebar">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
 <a href="admin/display_researches.php">Display Researches</a>
 <a href="admin/display_accounts.php">Display Accounts</a>
 <a href="admin/add-category.php">Add Categories</a>
 <a href="logout.php">Log Out</a>
</div>


   <!-- Sidebar Script -->

<script>
 function openNav() {
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("main").style.marginLeft = "25%";
}

 function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
 }
</script>