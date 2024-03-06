<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    // do processing and stuff...
    $password = $_POST['password'];

    $servername = "localhost"; 
    $username_db = "root";
    $password_db = ""; 
    $dbname = "web_app_proyecto";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkQuery = "SELECT username, password, email, admin FROM users WHERE username = '$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows == 0) {
        echo "User with the provided username does not exists.";
    } else {
        $user_data = $result->fetch_assoc();
        if (password_verify($password, $user_data["password"])) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $user_data["email"];
            $_SESSION['admin'] = $user_data["admin"];
            echo "Login successful, welcome " . $_SESSION['username'] . "!";
            header("Location: ../estrenos.php");
        } else {
            echo "Incorrect password.";
        }
    }

    $conn->close();
}
?>