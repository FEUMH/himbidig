<?php
include '../includes/config.php';
include 'header.php';
@session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

if(isset($_POST['submit'])) {
    // Get the title and content from the form
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle the image upload
    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Set the allowed file extensions (e.g., jpg, jpeg, png)
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        if(in_array(strtolower($image_ext), $allowed_extensions)) {
            // Set the target directory and file path
            $target_dir = "../uploads/content/";
            $image = $target_dir . basename($image_name);

            // Check if the file already exists
            if (!file_exists($image)) {
                // Move the uploaded image to the target directory
                if(move_uploaded_file($image_tmp_name, $image)) {
                    echo "Image uploaded successfully.";
                } else {
                    echo "Error uploading image.";
                }
            } else {
                echo "File already exists.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
    }

    // Insert the content and image path into the database
    $stmt = $conn->prepare("INSERT INTO content (title, content, image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $image]);

    header('Location: dashboard.php');
}
?>
<link rel="stylesheet" href="../assets/style_admin.css">
<form action="add_event.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="content" placeholder="Event content" required></textarea>
    <input type="file" name="image" accept="image/jpeg, image/png" required>
    <button type="submit" name="submit">Add Event</button>
</form>
<script src="../includes/inspectblock.js"></script>
