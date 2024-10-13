<head>
<link rel="icon" type="image/x-icon" href="../icon/favicon.ico">
<title>ADMIN HIMBIDIG FE UNMUHA</title>
</head>
<?php
session_start();
include '../includes/config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header('Location: index.php');
    } else {
        echo "<p style='color:red;'>Invalid login credentials</p>";
    }
}
?>

<!-- Login form -->
<form action="login.php" method="post">
    <h1>LOGIN</h1>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
<!-- Styles -->
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Courier New', Courier, monospace;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height for centering */
        background-color: #f0f8ff; /* Light blue background */
        color: #333;
    }

    form {
        background-color: #ffffff; /* White background */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px; /* Max width for form */
        text-align: center;
        margin-bottom: 20px; /* Margin for spacing between form and Back button */
    }

    h1 {
        color: #007bff; /* Blue color for heading */
        margin-bottom: 20px;
        font-size: 2em;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border-radius: 5px;
        border: 2px solid #007bff; /* Blue border */
        font-size: 16px;
        color: #333;
    }

    input:focus {
        outline: none;
        border-color: #0056b3; /* Darker blue on focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #007bff; /* Primary blue button */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    @media (max-width: 768px) {
        form {
            padding: 20px;
        }

        input, button {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        input, button {
            font-size: 12px;
            padding: 10px;
        }
    }
</style>


<script src="../includes/inspectblock.js"></script>
