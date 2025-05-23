<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "acilc"; // ضع اسم قاعدة البيانات هنا

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// الحصول على ID من الرابط
if (!isset($_GET['id'])) {
    echo "مقدم الخدمة غير محدد.";
    exit;
}

$client_id = intval($_GET['id']);

// جلب بيانات مقدم الخدمة
$sql = "SELECT * FROM clients WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "مقدم الخدمة غير موجود.";
    exit;
}

$client = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل مقدم الخدمة</title>
    <style>
        body { font-family: Arial; background-color: #f9f9f9; padding: 30px; }
        .details-box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        img {
            width: 100px; height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        h2 { margin-bottom: 10px; }
        p { color: gray; margin-bottom: 20px; }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>

<div class="details-box">
    <img src="https://via.placeholder.com/100" alt="صورة مقدم الخدمة">
    <h2><?= htmlspecialchars($client['adi']) ?></h2>
    <p>البريد الإلكتروني: <?= htmlspecialchars($client['email']) ?></p>
    
    <a href="chat.php?client_id=<?= $client['id'] ?>">مراسلة مقدم الخدمة</a>
</div>

</body>
</html>
