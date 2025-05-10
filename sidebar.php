<!-- Sidebar -->

<div id="mySidebar" class="sidebar">
 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
 <a href="dashboard.php">Home</a>
 <a href="account.php">Settings</a>
 <a href="research_upload.php">Upload</a>
 <a href="bookmarks_view.php">Bookmarks</a>
 <a href="faq.php">FAQ</a>
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