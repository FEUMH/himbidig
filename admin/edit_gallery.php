<?php
include '../includes/config.php';
include 'header.php';
@session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$id = $_GET['id'];

if(isset($_POST['submit'])) {
    $title = $_POST['title'];

    // If a new image is uploaded, handle it
    if ($_FILES['image']['name']) {
        // Get the current image name from the database to delete the old one (optional)
        $result = $conn->query("SELECT * FROM gallery WHERE id=$id");
        $row = $result->fetch_assoc();
        $old_image = $row['image'];
        
        // Delete the old image if exists
        if (!empty($old_image) && file_exists("../uploads/gallery/$old_image")) {
            unlink("../uploads/gallery/$old_image");
        }
        
        // Handle the new uploaded image
        $image = $_FILES['image']['name'];
        $target_dir = "../uploads/gallery/";
        $target_file = $target_dir . basename($image);

        // Check if the uploaded file is an image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($imageFileType, $allowed_types)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Update the image in the database
                $conn->query("UPDATE gallery SET title='$title', image='$image' WHERE id=$id");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Only image files are allowed (jpg, jpeg, png, gif).";
        }
    } else {
        // If no new image is uploaded, just update the title
        $conn->query("UPDATE gallery SET title='$title' WHERE id=$id");
    }

    // Redirect to the dashboard after the update
    header('Location: dashboard.php');
}

$result = $conn->query("SELECT * FROM gallery WHERE id=$id");
$row = $result->fetch_assoc();
?>

<link rel="stylesheet" href="../assets/style_admin.css">

<form action="edit_gallery.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
    <input type="file" name="image" accept="image/*"><br>
    
    <button type="submit" name="submit">Update</button>
</form>

<script src="../includes/inspectblock.js"></script>
