<?php
 session_start();
 if (!isset($_SESSION['email'])) {
  header("Location: index.php");
 } elseif (!isset($_SESSION['tenant_email'])) {
    header("Location: index.php");
}
 
 if (isset($_GET['signout'])) {
    //unset($_SESSION['email']);
    //session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
 }elseif(isset($_GET['signout_t'])){
    //unset($_SESSION['tenant_email']);
    //session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
 }
 ?>