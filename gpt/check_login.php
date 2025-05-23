<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "acilc"; // ضع اسم قاعدة البيانات هنا

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['sifre'];

// تحقق أولاً من جدول clients
$sql_client = "SELECT * FROM clients WHERE email = ? AND sifre = ?";
$stmt = $conn->prepare($sql_client);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result_client = $stmt->get_result();

if ($result_client->num_rows > 0) {
    $_SESSION['email'] = $email;
    $_SESSION['type'] = 'client';
    header("Location: client_chat.php");
    exit;
}

// تحقق من جدول users
$sql_user = "SELECT * FROM users WHERE email = ? AND sifre = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows > 0) {
    $_SESSION['email'] = $email;
    $_SESSION['type'] = 'user';
    header("Location: user_dashboard.php");
    exit;
}

// إذا لم يتم العثور على المستخدم
echo "بيانات الدخول غير صحيحة.";
?>
