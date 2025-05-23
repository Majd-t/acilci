<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>تسجيل الدخول</h2>
    <form action="check_login.php" method="post">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required>
        <input type="password" name="sifre" placeholder="كلمة المرور" required>
        <button type="submit">تسجيل الدخول</button>
    </form>
</div>

</body>
</html>
