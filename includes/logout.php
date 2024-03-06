<?php
session_start();
if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
}
if(isset($_SESSION['name'])) {
    unset($_SESSION['name']);
}
if(isset($_SESSION['esAdmin'])) {
    unset($_SESSION['esAdmin']);
}
session_destroy();
echo "<p>You've been logged out!</p>
      <a href='login.php'>Login</a>";
?>