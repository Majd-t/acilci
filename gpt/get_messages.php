<?php
session_start();

// التحقق من وجود جلسة وبريد العميل
if (!isset($_SESSION['email'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$client_email = $_SESSION['email'];
$selected_user_email = isset($_GET['user_email']) ? $_GET['user_email'] : '';

if (empty($selected_user_email)) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'No user email provided']);
    exit;
}

// إعداد الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "acilc";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// استعلام لجلب الرسائل مع صورة المرسل
$stmt = $conn->prepare("
    SELECT m.*, u.profile_image, u.adi, u.soyadi
    FROM messages m
    LEFT JOIN users u ON m.sender_email = u.email
    WHERE (m.sender_email = ? AND m.receiver_email = ?) 
       OR (m.sender_email = ? AND m.receiver_email = ?) 
    ORDER BY m.created_at ASC
");
$stmt->bind_param("ssss", $selected_user_email, $client_email, $client_email, $selected_user_email);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    // التأكد من أن profile_image يحتوي على قيمة افتراضية إذا كانت فارغة
    $messages[] = $row;
}

// إغلاق الاتصال
$stmt->close();
$conn->close();

// إرجاع البيانات بصيغة JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>