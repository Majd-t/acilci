

<?php
include '../action.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

$query = $conn->prepare("SELECT adi, soyadi, email, numara, il, ilce FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h2>Merhaba, <?php echo $user['adi']; ?>!</h2>
    <p>Soyadı: <?php echo $user['soyadi']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Telefon: <?php echo $user['numara']; ?></p>
    <p>Mahalle: <?php echo $user['il']; ?></p>
    <p>Şehir: <?php echo $user['ilce']; ?></p>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>




<!-- 

 التحقق مما إذا كان المستخدم مسجلاً الدخول
// if (!isset($_SESSION["email"]) ) {
//     header("Location: login.php"); // إعادة التوجيه إلى صفحة تسجيل الدخول إذا لم يكن هناك جلسة
//     exit();
// }



// ?> -->
<!-- // <!DOCTYPE html> 
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Document</title>
// </head>
// <body>
//     <h1>Welcome, <?php echo $_SESSION["email"]; ?></h1>
//     <h1>Welcome, <?php echo $_SESSION['adi'] ; ?></h1>

//     <a href="logout.php">js</a>
   
// </body>
// </html> -->