<?php
session_start(); //Start session

session_destroy(); //Remove session

header("Location: login.php"); //Direct to login page
exit();
?>