<?php 
include '../../includes/header.php';
 ?>
<link rel="stylesheet" href="../../assets/style.css">
<div class="container">
    <section class="event-list">
        <?php
        // Fetch events from the database
        include '../../includes/config.php';
        $result = $conn->query("SELECT * FROM content");
        while($row = $result->fetch_assoc()) {
            $content = substr($row['content'], 0, 100); // Initial 100 characters
            echo "
                <div class='event-item'>
                    <div class='event-image'>
                        <img src='../../uploads/".$row['image']."' alt='".$row['title']."'>
                    </div>
                    <div class='event-details'>
                        <h3>{$row['title']}</h3>
                        <p class='event-content' id='content-{$row['id']}' data-short-content='{$content}'>{$content}...</p>
                        <button class='show-more' id='btn-{$row['id']}' data-id='{$row['id']}' data-full-content='{$row['content']}'>Show More</button>
                    </div>
                </div>
            ";
        }
        ?>
    </section>
</div>
<?php include '../../includes/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.show-more');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.getAttribute('data-id');
                const fullContent = this.getAttribute('data-full-content');
                const contentElement = document.getElementById('content-' + eventId);

                // If the button says 'Show More'
                if (this.textContent === 'Show More') {
                    revealContent(eventId, fullContent);
                    this.textContent = 'Show Less'; // Change button text to 'Show Less'
                } 
                // If the button says 'Show Less'
                else {
                    hideContent(eventId, contentElement);
                    this.textContent = 'Show More'; // Change button text back to 'Show More'
                }
            });
        });
    });

    function revealContent(id, fullContent) {
        const contentElement = document.getElementById('content-' + id);
        contentElement.textContent = fullContent; // Show the full content
    }

    function hideContent(id, contentElement) {
        const shortContent = contentElement.getAttribute('data-short-content'); // Retrieve short content from the data attribute
        contentElement.textContent = shortContent + '...'; // Show truncated content
    }
</script>


<script src="../../includes/inspectblock.js"></script>