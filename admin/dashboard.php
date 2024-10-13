<?php
include 'header.php';

@session_start();

// Redirect to login if not admin
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
?>
<link rel="stylesheet" href="../assets/style_admin.css">

<!-- Admin Dashboard Section -->
<div class="admin-dashboard">

    <!-- Gallery Section -->
    <section class="admin-section">
        <h3>Gallery</h3>
        <div>
            <?php
            $result = $conn->query("SELECT * FROM gallery");
            while($row = $result->fetch_assoc()) {
                echo "<div class='admin-item'>
                        <span class='item-text'>" . $row['title'] . "</span>
                        <span class='item-buttons'>
                            <a class='edit-btn' href='edit_gallery.php?id=" . $row['id'] . "'>Edit</a> | 
                            <a class='delete-btn' href='delete_gallery.php?id=" . $row['id'] . "' onclick='return confirmDelete(this)'>Delete</a>
                        </span>
                      </div>";
            }
            ?>
        </div>
    </section>

    <!-- Events Section -->
    <section class="admin-section">
        <h3>Events</h3>
        <div>
            <?php
            $result = $conn->query("SELECT * FROM content");
            while($row = $result->fetch_assoc()) {
                echo "<div class='admin-item'>
                        <span class='item-text'>" . $row['title'] . "</span>
                        <span class='item-buttons'>
                            <a class='edit-btn' href='edit_event.php?id=" . $row['id'] . "'>Edit</a> | 
                            <a class='delete-btn' href='delete_event.php?id=" . $row['id'] . "' onclick='return confirmDelete(this)'>Delete</a>
                        </span>
                      </div>";
            }
            ?>
        </div>
    </section>

    <!-- Members Section -->
    <section class="admin-section">
        <h3>Members</h3>
        <div>
            <?php
            $result = $conn->query("SELECT * FROM members");
            while($row = $result->fetch_assoc()) {
                echo "<div class='admin-item'>
                        <span class='item-text'>" . $row['name'] . " - " . $row['position'] . "</span>
                        <span class='item-buttons'>
                            <a class='edit-btn' href='edit_member.php?id=" . $row['id'] . "'>Edit</a> | 
                            <a class='delete-btn' href='delete_member.php?id=" . $row['id'] . "' onclick='return confirmDelete(this)'>Delete</a>
                        </span>
                      </div>";
            }
            ?>
        </div>
    </section>

    <!-- Pengurus Section -->
    <section class="admin-section">
        <h3>Pengurus</h3>
        <div>
            <?php
            $result = $conn->query("SELECT * FROM pengurus");
            while($row = $result->fetch_assoc()) {
                echo "<div class='admin-item'>
                        <span class='item-text'>" . $row['name'] . " - " . $row['position'] . "</span>
                        <span class='item-buttons'>
                            <a class='edit-btn' href='edit_pengurus.php?id=" . $row['id'] . "'>Edit</a> | 
                            <a class='delete-btn' href='delete_pengurus.php?id=" . $row['id'] . "' onclick='return confirmDelete(this)'>Delete</a>
                        </span>
                      </div>";
            }
            ?>
        </div>
    </section>
</div>

<!-- Custom CSS Popup for Alert -->
<style>
    /* Admin Dashboard Styles */
    .admin-dashboard {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .admin-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .item-text {
        flex-grow: 1;
        text-align: left;
    }

    .item-buttons {
        text-align: right;
    }

    /* Button Styles */
    .edit-btn, .delete-btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px 5px;
        border-radius: 5px;
        text-decoration: none;
    }

    .edit-btn {
        background-color: #28a745;
        color: white;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
    }

    /* Confirmation Popup Styles */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .popup button {
        padding: 10px 15px;
        border: none;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup button:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .admin-dashboard {
            width: 95%;
        }
    }
</style>

<!-- Popup Confirmation -->
<div class="popup" id="confirmationPopup">
    <div class="popup-content">
        <p>Are you sure you want to delete this item?</p>
        <button id="confirmBtn">Yes</button>
        <button id="cancelBtn">No</button>
    </div>
</div>

<!-- JavaScript -->
<script>
    function confirmDelete(element) {
        event.preventDefault(); // Prevent the link from executing
        const popup = document.getElementById('confirmationPopup');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        // Show the popup
        popup.style.display = 'flex';

        // Set the confirm button's action to delete the item
        confirmBtn.onclick = function() {
            window.location.href = element.href; // Proceed with the delete action
        };

        // If cancel is clicked, close the popup
        cancelBtn.onclick = function() {
            popup.style.display = 'none';
        };
    }
</script>
<script src="../includes/inspectblock.js"></script>