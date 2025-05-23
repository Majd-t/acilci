<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['type'] !== 'client') {
    header("Location: login.php");
    exit;
}
?>
<h2>مرحباً بك في لوحة مقدم الخدمة</h2>


<a href="client_chat.php">ss</a>
