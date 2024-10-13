<?php
include '../includes/config.php';

include 'header.php';
@session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);

    // Handle image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_error = $_FILES['image']['error'];

    // Check for errors in image upload
    if ($image_error === UPLOAD_ERR_OK) {
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file extension
        if (in_array($image_extension, $allowed_extensions)) {
            // Generate a unique name for the image
            $unique_image_name = uniqid('profile_', true) . '.' . $image_extension;
            $image_folder = '../assets/profile/' . $unique_image_name;

            // Move the uploaded file to the designated folder
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                // Insert the member data including the image into the database using a prepared statement
                $stmt = $conn->prepare("INSERT INTO members (name, position, image) VALUES (?, ?, ?)");
                $stmt->bind_param('sss', $name, $position, $unique_image_name);
                if ($stmt->execute()) {
                    header('Location: dashboard.php');
                    exit();
                } else {
                    echo "Failed to insert member data into the database.";
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file format. Please upload a JPG, JPEG, PNG, or GIF image.";
        }
    } else {
        echo "Error uploading the image. Error code: $image_error";
    }
}
?>
<link rel="stylesheet" href="../assets/style_admin.css">
<form action="add_member.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Member Name" required>
    <input type="text" name="position" placeholder="Member Position" required>
    <input type="file" name="image" accept="image/*" required> <!-- File upload field -->
    <button type="submit" name="submit">Add Member</button>
</form>


<script src="../includes/inspectblock.js"></script>