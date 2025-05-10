<?php
include('connection.php');
include('sidebar.php');

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $path = "categories";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $cate_query = "INSERT INTO categories (name,slug,description,meta_title,meta_description,meta_keywords,status,popular,image)
    VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run) {
        move_uploaded_file($image_temp, $path.'/'.$filename);

        redirect("add-category.php", "Category Added Successfully");
    }
    else {
        redirect("add-category.php", "Something Went Wrong");
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="admin.css">
</head>

<!-- sidebar open button -->

<div id="main">
 <button class="openbtn" onclick="openNav()">
    <i class="fas fa-bars"></i>
</button>
</div>

<body>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
            <h2 class="title">Add Category</h2>
            <div class="card-body">
            <div class="row">
            <form action="add-category.php" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="">Name</label>
                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Slug</label>
                <input type="text" name="slug" placeholder="Enter Slug" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="">Description</label>
                <input type="text" name="description" placeholder="Enter description" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="">Upload Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="">Meta Title</label>
                <input type="text" name="meta_title" placeholder="Enter Meta Title" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="">Meta Description</label>
                <input type="text" name="meta_description" placeholder="Enter Meta Description" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="">Meta Keywords</label>
                <input type="text" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Status</label>
                <input type="checkbox" name="status" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Popular</label>
                <input type="checkbox" name="popular" class="form-control">
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" name="add_category_btn">Save</button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>