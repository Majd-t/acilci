<?php
session_start();
$client_email = $_SESSION['email']; // البريد الإلكتروني للعميل
$selected_user_email = isset($_POST['user_email']) ? $_POST['user_email'] : null;
$message = isset($_POST['message']) ? $_POST['message'] : null;

if ($selected_user_email && $message) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "acilc";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // إدخال الرسالة الجديدة في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO messages (sender_email, receiver_email, message, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $client_email, $selected_user_email, $message);
    $stmt->execute();

    echo "تم إرسال الرسالة"; // الرد على العميل بعد إرسال الرسالة
}
?>
