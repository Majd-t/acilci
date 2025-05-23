<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['type'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>
<h2>مرحباً بك في لوحة العميل</h2>

<a href="chat.php">eee</a>

<a href="services.php">servic</a>
