<?php include '../../includes/header.php'; ?>
<link rel="stylesheet" href="../../assets/style.css">
<div class="container">
    <aside class="sidebar-section">
        <h1>Latest Events</h1>
        <div class="event-list">
        <?php
            include '../../includes/config.php';
            // Fetch the latest 2 events
            $result = $conn->query("SELECT * FROM content ORDER BY 1 DESC LIMIT 2");
            while($row = $result->fetch_assoc()) {
                echo "
                    <div class='event-item1'>
                        <h3>{$row['title']}</h3>
                        <p>" . substr($row['content'], 0, 99) . "../...</p>
                    </div>
                ";
            }
            ?>
        </div>
        <a href="../event" class="view-more">View All Events</a>
    </aside>

    <section class="gallery-section">
<!--        <h1>Gallery</h1> -->
        <div class="gallery-grid">
            <?php
            include '../gallery/slide.php';
            ?>
        </div>
        <a href="../gallery" class="view-more">View All Gallery</a>
    </section>

</div>

<?php include '../../includes/footer.php'; ?>

<style>
    /* Event List Styling */
.event-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Evenly space out event items */
    gap: 20px;
    
}

.event-item1 {
    
    background-color: #ffffff; /* White background for event items */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    flex: 1 1 calc(33.333% - 40px); /* 3 items per row, adjust for margin */
    min-width: 100%; /* Ensure minimum width for smaller screens */
    text-align: center; /* Center the content */
}

.event-item1 img {
    max-width: 100%; /* Ensure the image takes up the full width */
    height: auto; /* Maintain the aspect ratio */
    border-radius: 5px; /* Slight rounding of image corners */
    margin-bottom: 15px; /* Space between image and content */
}

.event-item1 h3 {
    /* color: #007bff; */
    margin-bottom: 10px;
}

.event-item1 p {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
}
h1 {
    color:#333;
    font-size:20px;
    text-align:center;
    text-decoration:underline;
    margin-bottom:10px;
}

</style>


<script src="../../includes/inspectblock.js"></script>