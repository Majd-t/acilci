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

$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الخدمات المتاحة</title>
    <style>
        body { font-family: Arial; background-color: #f8f8f8; padding: 20px; }
        .card-container { display: flex; flex-wrap: wrap; gap: 20px; }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 250px;
            text-align: center;
        }
        .card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .card h3 { margin: 10px 0; }
        .card p { color: gray; margin: 5px 0; }
        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .card a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>قائمة مقدمي الخدمة</h2>

<div class="card-container">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="صورة مقدم الخدمة">
            <h3><?= htmlspecialchars($row['adi']) ?></h3>
            <p><?= htmlspecialchars($row['email']) ?></p>
            <a href="service_detail.php?id=<?= $row['id'] ?>">المزيد</a>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
