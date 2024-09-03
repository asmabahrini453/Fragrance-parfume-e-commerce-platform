<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout']==1) {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_email']);
    unset($_SESSION['admin_name']);
    header('Location: admin_login.php');
    exit;
}
?>
