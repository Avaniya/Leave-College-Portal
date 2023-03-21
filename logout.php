<?php
session_start();
unset($_SESSION['ROLE']);
unset($_SESSION['USERNAME']);
unset($_SESSION['PASSWORD']);
header('location:index.php');
die();
?>
