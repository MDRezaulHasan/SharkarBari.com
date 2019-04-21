<?php
 session_start();
 if (!isset($_SESSION['email'])) {
  header("Location: login.php");
 } 
 
 if (isset($_GET['logout'])) {
  unset($_SESSION['email']);
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit;
 }
 ?>

