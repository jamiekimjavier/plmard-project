<?php
require_once 'connection.php';
require_once 'download.php';
require_once 'view_pdf.php';
require_once 'bookmark.php';
require_once 'sidebar.php';
include('database_connection.php');

session_start();

require_once 'checks.php';


$user_name = '';
$user_id = '';

if(isset($_SESSION["user_name"], $_SESSION["user_id"]))
{
 $user_name = $_SESSION["user_name"];
 $user_id = $_SESSION["user_id"];
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <!-- sidebar open button -->

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>


    <!-- Citations display -->
    <div class="container">
        <h1>Bookmarked Items</h1>
        <textarea rows="20" class="form-control" readonly><?php echo $citations; ?></textarea>
        <button class='btn btn-success' onclick="copyCitations()">Copy Citations</button>
        <button class='btn btn-primary' onclick="clearBookmarks()">Clear All Bookmarks</button>
        
    </div>

    <!-- Bookmarked Items display -->

    <div id="bookmarkedItems">
    <?php if (!empty($bookmarks)): ?>
        <?php
        $bookmarks_str = implode(',', $bookmarks);
        $sql = "SELECT * FROM researches WHERE id IN ($bookmarks_str) AND is_verified = 1 ORDER BY name";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='research_container'>
                        <div>
                            <h3>Title: {$row['name']}</h3>
                            <p class='authors'>Authors: {$row['authors']}</p>
                            <p class='category_id'>Category: {$row['category_id']}</p>
                            <p class='abstract'>Abstract: {$row['abstract']}</p>
                            <p class='school_year'>Year Finished: {$row['school_year']}</p>
                            <p class='language'>Language: {$row['language']}</p>
                            <p class='chapters'>Chapters: {$row['chapters']}</p>
                            <p class='date'>Date Uploaded: {$row['created_at']}</p>
                            <a href='download.php?id={$row['id']}' class='btn btn-primary'><i class='fa fa-file-pdf-o'></i> Download PDF</a>
                            <button class='btn btn-success' onclick='openForm(\"{$row['authors']}\", \"{$row['school_year']}\", \"{$row['name']}\")'><i class='fa fa-quote-left'></i> Cite </button>
                            <a href='view_pdf.php?pdf_id={$row['id']}' class='btn btn-primary'><i class='fa fa-file-pdf-o'></i> View PDF</a>
                            <button class='btn btn-danger' onclick='deleteBookmark(\"{$row['id']}\")'>
                            <i class='fa fa-trash'></i> Delete
                            </button>
                        </div>
                  </div>";
        }
        ?>
    <?php endif; ?>
</div>
<script>
    function deleteBookmark(bookmarkId) {
        if (confirm("Are you sure you want to delete this bookmark?")) {
            $.ajax({
                type: 'POST',
                url: 'bookmark.php',
                data: { id: bookmarkId },
                success: function (response) {
                    if (response === 'success') {
                        location.reload();
                    } else {
                        alert('An error occurred while deleting the bookmark.');
                    }
                }
            });
        }
    }
</script>

    <script>
                function clearBookmarks() {
            if (confirm("Are you sure you want to delete all bookmarks?")) {
                <?php
                $_SESSION["bookmarks"] = array();
                ?>
                location.reload();
            }
        }
    </script>

    <!-- Copies the citations -->

    <script>
        function copyCitations() {
            var citations = $('textarea').val();
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(citations).select();
            document.execCommand('copy');
            tempInput.remove();
            alert('All citations have been copied to your clipboard.');

            $('#copyModal').modal('show');
        }
    </script>
</body>
</html>