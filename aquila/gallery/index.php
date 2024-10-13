<?php
 include '../../includes/header.php';
?>
<link rel="stylesheet" href="../../assets/style.css">
<div class="container">
    <div class="gallery">
        <?php
        // Fetch gallery images from the database and display them
        include '../../includes/config.php';
        $result = $conn->query("SELECT * FROM gallery");
        while($row = $result->fetch_assoc()) {
            echo "<div class='gallery-item'><img src='../../uploads/".$row['image']."' alt='".$row['id']."'></div>";
        }
        ?>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>

<script src="../../includes/inspectblock.js"></script>