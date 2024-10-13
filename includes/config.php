<?php
$servername = "sql12.freemysqlhosting.net";
$username = "sql12737472";
$password = "tKyrqh3vcu";
$dbname = "sql12737472";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
