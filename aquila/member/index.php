<?php include '../../includes/header.php'; ?>
<link rel="stylesheet" href="../../assets/style.css">



<div class="container">
<h1>Pengurus</h1>
    <div class="member-list">
        <?php
        // Fetch pengurus from the database
        include '../../includes/config.php';
        $result = $conn->query("SELECT * FROM pengurus");

        // Check if pengurus exist and fetch each row
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="member-card">
                
                    <div class="card-header">
                        <img src="../../assets/profile/' . $row['image'] . '" alt="' . $row['name'] . '" class="profile-img">
                    </div>
                    <div class="card-body">
                        <h3>' . $row['name'] . '</h3>
                        <p class="position">' . $row['position'] . '</p>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No pengurus found.</p>';
        }
        ?>
    </div>
</div>

<div class="container">
    
<h1>anggota</h1>
    <div class="member-list">
        <?php
        // Fetch members from the database
        include '../../includes/config.php';
        $result = $conn->query("SELECT * FROM members");

        // Check if members exist and fetch each row
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="member-card">
                    <div class="card-header">
                        <img src="../../assets/profile/' . $row['image'] . '" alt="' . $row['name'] . '" class="profile-img">
                    </div>
                    <div class="card-body">
                        <h3>' . $row['name'] . '</h3>
                        <p class="position">' . $row['position'] . '</p>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No members found.</p>';
        }
        ?>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>

<style style="font-family: verdana, geneva, sans-serif;">
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
}

h1{ padding :10px;
    width: 100%;
    text-align:center;
    font-size:20px;
    text-transform:uppercase;
}

.member-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    background-color:white;
    padding:20px;
    border-radius:8px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.member-card {
    background: #fff;
    width: 200px;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    text-align: center;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.member-card:hover {
    transform: translateY(-3px);
}

.card-header {
    background: lightgray;
    padding: 20px;
}

.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;

 /*   border: 2px solid #3498db; */
}

.card-body {
    padding: 20px;
}

h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
}

.position {
    font-size: 15px;
    color: #777;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .member-card {
        width: 70%;
        margin-bottom: 20px;
    }
}
</style>

<script src="../../includes/inspectblock.js"></script>