<?php
include '../includes/config.php';
include 'header.php';
session_start();
if(!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$id = $_GET['id'];
$conn->query("DELETE FROM content WHERE id=$id");
header('Location: dashboard.php');
?>

<script src="../includes/inspectblock.js"></script>