<?php
include '../includes/config.php';
include 'header.php';
@session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

// Handle form submission for updating member details
if(isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);

    // Handle image upload if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($image_extension, $allowed_extensions)) {
            $unique_image_name = uniqid('profile_', true) . '.' . $image_extension;
            $image_folder = '../assets/profile/' . $unique_image_name;
            
            // Move uploaded file to profile folder
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                // Update the member details including the new image
                $conn->query("UPDATE members SET name='$name', position='$position', image='$unique_image_name' WHERE id=$id");
            } else {
                echo "Failed to upload new image.";
                exit();
            }
        } else {
            echo "Invalid file format. Please upload JPG, JPEG, PNG, or GIF.";
            exit();
        }
    } else {
        // If no new image is provided, update only the name and position
        $conn->query("UPDATE members SET name='$name', position='$position' WHERE id=$id");
    }

    header('Location: dashboard.php');
    exit();
}

// Fetch existing member data
$result = $conn->query("SELECT * FROM members WHERE id=$id");
$row = $result->fetch_assoc();
?>
<link rel="stylesheet" href="../assets/style_admin.css">
<form action="edit_member.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
    <input type="text" name="position" value="<?php echo htmlspecialchars($row['position']); ?>" required>
    <input type="file" name="image" accept="image/*">

    <!-- Display existing image with fallback to a placeholder -->
    <p>Current Image:</p>
    <?php if (!empty($row['image']) && file_exists('../assets/profile/' . $row['image'])): ?>
        <img src="../assets/profile/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="120px">
    <?php else: ?>
        <img src="../assets/profile/default-placeholder.png" alt="No Image" width="120px"> <!-- Add a default placeholder -->
    <?php endif; ?>

    <button type="submit" name="submit">Update Member</button>
</form><script src="../includes/inspectblock.js"></script>