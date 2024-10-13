<?php
include '../includes/config.php';

include 'header.php';
@session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
    $conn->query("INSERT INTO gallery (title, image) VALUES ('$title', '$image')");
    header('Location: dashboard.php');
}
?>
<link rel="stylesheet" href="../assets/style_admin.css">
<form action="add_gallery.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Image Title" required>
    <input type="file" name="image" required>
    <button type="submit" name="submit">Add Image</button>
</form>


<script src="../includes/inspectblock.js"></script>