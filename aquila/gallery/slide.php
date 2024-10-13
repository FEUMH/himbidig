<?php
include '../../includes/config.php';
// Read all images from the gallery
$query = "SELECT * FROM gallery";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result(); // Get the result set

// Fetch all rows into an associative array
$images = $result->fetch_all(MYSQLI_ASSOC); // Use fetch_all with MySQLi
?>

<div class="slider-container" id="slider-container">
    <!-- Slider Section (100% width) -->
    <div class="slider-section">
        <div class="slider">
            <!-- Loop through each image for the slider -->
            <?php foreach ($images as $index => $image): ?>
                <div class="slide <?= $index === 0 ? 'active' : ''; ?>">
                    <img src="../../uploads/gallery/<?= htmlspecialchars($image['image']); ?>" alt="Gallery Image">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Pagination dots -->
    <div class="dots">
        <?php foreach ($images as $index => $image): ?>
            <span class="dot <?= $index === 0 ? 'active' : ''; ?>" onclick="currentSlide(<?= $index; ?>)"></span>
        <?php endforeach; ?>
    </div>

    <!-- Navigation Arrows -->
    <div class="nav-arrows">
        <span class="prev" onclick="prevSlide()">&#10094;</span>
        <span class="next" onclick="nextSlide()">&#10095;</span>
    </div>
</div>

<style>
/* Adjust Slider Container for full width */
.slider-container {
    display: flex;
    width: 100%;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    position: relative;
}

.slider-section {
    width: 100%; /* Full width for the slider */
    position: relative;
}

/* Slider section styles */
.slider {
    display: flex;
    width: 100%;
    transition: transform 0.5s ease-in-out;
}

.slide {
    min-width: 100%;
    background-color: white;
    padding: 14px;
    box-sizing: border-box;
    border-radius: 3px;
    display: none; /* Hide all slides by default */
}

.slide.active {
    display: block; /* Only display the active slide */
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 3px;
}

/* Pagination dots */
.dots {
    text-align: center;
    position: absolute;
    bottom: 15px;
    width: 100%;
}

.dot {
    cursor: pointer;
    height: 5px;
    width: 20px;
    border-radius:10px;
    margin: 0 5px;
    background-color: #bbb;
    display: inline-block;
    transition: background-color 0.6s ease-in-out;

}

.dot.active, .dot:hover {
    background-color: #007BFF;
}

/* Navigation arrows */
.nav-arrows {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    padding: 0 10px;
}

.nav-arrows span {
    cursor: pointer;
    font-size: 30px;
    color: white;
    padding: 10px;
    border-radius: 50%;
    color: #007BFF;
}

/* Responsive design */
@media only screen and (max-width: 768px) {
    .slider-container {
        flex-direction: column;
    }

    .slider-section {
        width: 100%;
    }

    .dot {
        height: 4px;
        width: 16px;
    }

    .nav-arrows span {
        font-size: 24px;
    }
}

@media only screen and (max-width: 550px) {
    .slider-container {
        flex-direction: column;
    }

    .slider-section {
        width: 100%;
    }

    .slide img {
        height: 300px;
    }
}
</style>

<script>
// Slider functionality
let currentIndex = 0;
let slides = document.querySelectorAll('.slide');
let dots = document.querySelectorAll('.dot');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        dots[i].classList.remove('active');
    });
    slides[index].classList.add('active');
    dots[index].classList.add('active');
}

function currentSlide(index) {
    currentIndex = index;
    showSlide(index);
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
}

function autoSlide() {
    setInterval(() => {
        nextSlide();
    }, 3000); // Automatically change slide every 3 seconds
}

// Initialize the slider on page load
window.onload = function() {
    showSlide(currentIndex);
    autoSlide();
};
</script>
