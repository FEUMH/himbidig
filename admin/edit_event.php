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
    $content = $_POST['content'];

    // Handle image upload (if a new image is uploaded)
    $image = $_POST['existing_image'];  // Keep the existing image path by default

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

    // Update the content and image path in the database
    $stmt = $conn->prepare("UPDATE content SET title=?, content=?, image=? WHERE id=?");
    $stmt->execute([$title, $content, $image, $id]);

    header('Location: dashboard.php');
}

$result = $conn->query("SELECT * FROM content WHERE id=$id");
$row = $result->fetch_assoc();
?>

<link rel="stylesheet" href="../assets/style_admin.css">
<form action="edit_event.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
    <textarea name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea>
    
    <!-- Existing Image Display -->
    <?php if (!empty($row['image'])): ?>
        <div>
            <p>Existing Image:</p>
            <img src="<?php echo '../uploads/content/' . basename($row['image']); ?>" alt="Event Image" width="200">
        </div>
    <?php endif; ?>
    
    <!-- Upload new image -->
    <input type="file" name="image" accept="image/jpg,image/jpeg, image/png">
    
    <!-- Hidden input to keep the existing image path (if no new image is uploaded) -->
    <input type="hidden" name="existing_image" value="<?php echo $row['image']; ?>">
    
    <button type="submit" name="submit">Update Event</button>
</form>

<script src="../includes/inspectblock.js"></script>
