<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../icon/favicon.ico">
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>

<header>
    <nav>
    <div class="img">
        <a href="./"><img src="../icon/logo.png" alt="LOGO" width="100px"></a>
        <h2>
            ADMIN DASHBOARD
        </h2>
    </div>

    <div id="menu-icon" class="menu-icon">
        <i class="fa-solid fa-bars"></i>
    </div>

    <ul id="menu-list" class="hidden">
    <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_gallery.php">Add Gallery</a></li>
            <li><a href="add_event.php">Add Event</a></li>
            <li><a href="add_member.php">Add Member</a></li>
            <li><a href="add_pengurus.php">Add Pengurus</a></li>
            <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
</header>


<style>
    nav {
        border-radius: 0px;
        display: flex;
        justify-content: space-between;
        padding: 1rem 2rem;
        background-color:#ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        align-items: center;
    }

    /* Flex container for the logo and text */
    nav .img {
        display: flex;
        align-items: center;
        gap: 1rem; /* Space between logo and text */
    }

    nav div img {
        width: 60px;
    }

    h2 {
        font-family: 'Courier New', Courier, monospace;
        margin: 0;
    }

    sub {
        font-family: cursive;
        color: #007BFF;
    }

    hr {
        display: none;
    }

    nav ul {
        display: flex;
        align-items: center;
        gap: 2rem;
        list-style-type: none;
    }

    nav ul li a {
        text-decoration: none;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #191919;
        font-weight: 600;
        padding: 8px 0px;
        transition: all;
        transition-duration: 400ms;
        border-bottom: 1px solid rgba(34, 34, 34, 0);
        font-weight: 500;
    }

    nav ul li a:hover {
        border-bottom: 1px solid #007BFF;
        color: #007BFF;
    }

    .menu-icon {
        font-size: 24px;
        display: none;
    }

    @media only screen and (max-width: 768px) {
        nav {
            flex-wrap: wrap;
            z-index: 1000;
        }

        nav ul {
            flex-direction: column;
            width: 100%;
        }

        nav ul.hidden {
            display: none;
        }

        .menu-icon {
            display: flex;
            align-items: center;
        }

        h2 {
            font-family: Courier;
            font-size: 20px;
        }
    }
</style>

<script>
    /** Toggle menu visibility */
    const menuIcon = document.getElementById("menu-icon");
    const menuList = document.getElementById("menu-list");

    menuIcon.addEventListener("click", () => {
        menuList.classList.toggle("hidden");
    });
</script>
<script src="../includes/inspectblock.js"></script>