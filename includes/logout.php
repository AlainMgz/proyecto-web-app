<?php
require_once 'config.php';
require 'session_start.php';
if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
}
if(isset($_SESSION['user_obj'])) {
    unset($_SESSION['user_obj']);
}
session_destroy();
header("Location: ../login.php");
?>