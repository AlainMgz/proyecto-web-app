<?php
require_once 'config.php';
require 'session_start.php';

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password_encrypted = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $servername = "localhost"; 
    $username_db = "root";
    $password_db = ""; 
    $dbname = "web_app_proyecto";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // User already exists
        echo "User with the provided username or email already exists.";
    } else {
        // User doesn't exist, insert into the database
        $insertQuery = "INSERT INTO users (username, email, password, admin) VALUES ('$username', '$email', '$password_encrypted', 1)";
    
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: ../login.php");

        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
    
    $conn->close();

}
?>