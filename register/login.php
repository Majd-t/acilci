<?php
include '../action.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];



    // البحث في جدول الأدمن
    $query = $conn->prepare("SELECT * FROM clients WHERE email = ? AND sifre = ?");
    $query->bind_param("ss", $email, $sifre);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // استرجاع بيانات العميل
        $row = $result->fetch_assoc();
        
        // تخزين بيانات الجلسة: البريد الإلكتروني و client_id
        $_SESSION['email'] = $email;
        $_SESSION['client_id'] = $row['id']; // تخزين client_id في الجلسة

        // إعادة التوجيه إلى صفحة العميل الخاصة
        header('Location:../dashboard/profil.php?id=' . $row['id']);
        exit();
    }

    // البحث في جدول العملاء
    $query = $conn->prepare("SELECT * FROM admin WHERE email = ? AND sifre = ?");
    $query->bind_param("ss", $email, $sifre);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: ../admin/new.php");
        exit();
    }

    // البحث في جدول المستخدمين
    $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND sifre = ?");
    $query->bind_param("ss", $email, $sifre);
    $query->execute();
    $result = $query->get_result();


    
    if ($result->num_rows > 0) {
        // استرجاع بيانات العميل
        $row = $result->fetch_assoc();
        
        // تخزين بيانات الجلسة: البريد الإلكتروني و client_id
        $_SESSION['email'] = $email;
        $_SESSION['client_id'] = $row['id']; // تخزين client_id في الجلسة

        // إعادة التوجيه إلى صفحة العميل الخاصة
        header("Location:../user_dashboard/profil.php");
        exit();
    }

    // إذا لم يتم العثور على المستخدم
    $error_message = "E-posta veya şifre hatalı! <br> Lütfen tekrar deneyin."; ;
        $_SESSION['error_message'] = $error_message;
        header("Refresh:5");    
}

$conn->close();
?>

<?php if (!empty($_SESSION['error_message'])): ?>
        <div class="notification show">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></span>
        </div>
    <?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>girs</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
     .notification {
    position: fixed;
    top: 20px;
    right: -350px;
    background: linear-gradient(45deg, #ff4d4d, #ff0000);
    color: white;
    padding: 16px 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
    font-size: 16px;
    display: flex;
    align-items: center;
    transition: all 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    border: 2px solid white;
    min-width: 280px;
    max-width: 350px;
    z-index: 9999;
    transform-origin: center right;
}

.notification.show {
    right: 20px;
    animation: slideIn 0.7s forwards;
}

.notification.hide {
    animation: slideOut 0.7s forwards;
}

.notification i {
    margin-right: 15px;
    font-size: 20px;
    color: white;
}

@keyframes slideIn {
    0% {
        transform: translateX(100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    0% {
        transform: translateX(0);
        opacity: 1;
    }
    100% {
        transform: translateX(100%);
        opacity: 0;
    }
}
    </style>

   
</head>
<body>
    <body>
        <div class="container">
            <div class="left">
                <h1>Hoş Geldiniz!</h1>
                <p>ACİLCİ’ye giriş yap veya hemen kaydol.<br>
                    İster hizmet al, ister profesyonel olarak kazanmaya başla!</p>
                <p><strong>Müşteri:</strong> Hemen ihtiyacın olan hizmeti bul.<br>
                    <strong>Hizmet Veren:</strong> Daha fazla müşteriye ulaş ve kazancını artır.</p>
            </div>
            <div class="right">
                <form action="login.php" method="post">
                    <input type="email" name="email" placeholder="Email" required>

                    <input type="password" name="sifre" placeholder="şifre" required>
                    <div class="button-container">
                    <button class="login-btn"> <img src="resimler/giris.png" alt=""><strong>Giriş Yap</strong> </button>
                    
                </div>
                </form>
                <div class="links">
                    <p>Yeni misin? <a href="new.php">Kayıt Ol </a></p>
                    <p>Şifreni mi unuttun? <a href="sifreSifirla.php">Şifre Sıfırla</a></p>
                </div>
            </div>
        </div>
    </body>


    </html>
    
