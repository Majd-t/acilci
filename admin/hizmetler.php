<?php include 'sidebar_include.php'; ?>

<?php

include '../action.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../register/login.php");
    exit();
}



// التحقق من إرسال البيانات وإضافتها إلى قاعدة البيانات
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profession_name = trim($_POST['profession_name']);
    $sub_professions = array_filter($_POST['sub_profession_name']); // إزالة الفراغات

    if (!empty($profession_name) && !empty($sub_professions)) {
        // إضافة المهنة إلى قاعدة البيانات
        $stmt = $conn->prepare("INSERT INTO professions (name) VALUES (?)");
        $stmt->bind_param("s", $profession_name);
        if ($stmt->execute()) {
            $profession_id = $conn->insert_id; // جلب ID المهنة التي تم إدخالها

            // إدخال التخصصات المرتبطة بها
            $stmt = $conn->prepare("INSERT INTO sub_professions (name, profession_id) VALUES (?, ?)");
            foreach ($sub_professions as $sub_name) {
                $stmt->bind_param("si", $sub_name, $profession_id);
                $stmt->execute();
            }

            $error_message = "Hizmet Başarıyla Eklendi. ✅";
            $_SESSION['error_message'] = $error_message;
            header("Refresh:3");
        } else {
            echo "<p class='error'>حدث خطأ أثناء الإضافة!</p>";
        }
    } else {
        echo "<p class='error'>يرجى إدخال اسم المهنة واسم تخصص واحد على الأقل!</p>";
    }
}
?>

<?php if (!empty($_SESSION['error_message'])): ?>
        <div class="notification show">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></span>
        </div>
    <?php endif; ?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مهنة وتخصصات</title>
    <link rel="stylesheet" href="styles.css">
    <style>
                    /* إعدادات عامة */
                /* تنسيق الصفحة العام */
            body {
                font-family: 'Poppins', 'Arial', sans-serif;
                background: linear-gradient(135deg, #f8f8f8, #e0e0e0);
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                overflow-x: hidden;
                
            }

            /* حاوية المحتوى */
            .container {
                background: #ffffff;
                width: 90%; /* Changed from 55% to 90% for better width within the content area */
                max-width: 700px; /* Reduced from 600px to 500px */
                padding: 25px;
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 0 1px 5px rgba(0, 0, 0, 0.05);
                text-align: left;
                border-top: 6px solid #d40000;
                position: relative;
                animation: fadeIn 0.8s ease-out;
                overflow: hidden;
                
            }

            /* Add option to include sidebar in this different layout */
            .with-sidebar {
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                min-height: 100vh;
                background: linear-gradient(135deg, #f8f8f8, #e0e0e0);
            }

            .with-sidebar .content-area {
                margin-left: 360px;
                padding: 20px; /* Reduced from 40px to 20px */
                width: calc(100% - 360px);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                animation: shine 3s infinite;
            }

            /* العناوين */
            h2, h3 {
                color: #d40000;
                text-align: left;
                margin-bottom: 15px;
                font-weight: 700;
                letter-spacing: 0.5px;
                position: relative;
            }

            h2::after, h3::after {
                content: '';
                position: absolute;
                width: 50px;
                height: 3px;
                background: #d40000;
                bottom: -5px;
                left: 0;
                border-radius: 2px;
            }

            /* إدخال النصوص */
            input {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                border-radius: 10px;
                border: 2px solid #ddd;
                font-size: 15px;
                background: #f9f9f9;
                transition: all 0.4s ease;
                outline: none;
                box-sizing: border-box;
            }

            input:focus {
                border-color: #d40000;
                background: #fff;
                box-shadow: 0 0 12px rgba(212, 0, 0, 0.2);
                transform: scale(1.02);
            }

            /* الأزرار */
            button {
                width: 100%;
                padding: 12px;
                border: none;
                background: linear-gradient(45deg, #d40000, #ff4d4d);
                color: white;
                font-size: 17px;
                font-weight: 600;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 10px;
                position: relative;
                overflow: hidden;
            }

            button:hover {
                background: linear-gradient(45deg, #a50000, #d40000);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(212, 0, 0, 0.4);
            }

            button:active {
                transform: translateY(0);
            }

            button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.2);
                transition: all 0.5s;
            }

            button:hover::before {
                left: 100%;
            }

            /* رسائل النجاح والخطأ */
            .success {
                color: #2d7d46;
                font-weight: 600;
                background: #e6f4e6;
                padding: 10px;
                border-radius: 8px;
                text-align: center;
                border-left: 4px solid #2d7d46;
                animation: slideIn 0.5s ease;
            }

            .error {
                color: #d40000;
                font-weight: 600;
                background: #fceaea;
                padding: 10px;
                border-radius: 8px;
                text-align: center;
                border-left: 4px solid #d40000;
                animation: slideIn 0.5s ease;
            }

            /* تأثيرات التحميل */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes shine {
                0% { left: -100%; }
                20% { left: 100%; }
                100% { left: 100%; }
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            /* تنسيق القائمة المنسدلة */
            .toggle-list {
                margin-top: 15px;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s ease-in-out, opacity 0.3s ease;
                opacity: 0;
            }

            .input toggle-list{

                width: 10px;

            }
            .container .toggle-list input {
                /* الأنماط */
                width: 97%;
                    margin-left: 10px;
                    
                
            }

            .toggle-list.open {
                max-height: 400px;
                opacity: 1;
            }

            .toggle-header {
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
                background: linear-gradient(90deg,rgb(0, 0, 0),rgb(0, 0, 0));
                color: white;
                padding: 12px 18px;
                border-radius: 10px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .toggle-header:hover {
                background: linear-gradient(90deg, #a50000, #d40000);
                transform: translateY(-2px);
            }

            .toggle-header img {
                width: 20px;
                transition: transform 0.4s ease;
            }

            .toggle-header.active img {
                transform: rotate(180deg);
            }


                .notification {
                position: fixed;
                top: 20px;
                right: 10px;
                background-color: #2d7d46;
                color: white;
                padding: 15px 25px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                transform: translateX(120%);
                transition: transform 0.3s ease-out;
                display: flex;
                align-items: center;
                }

            .notification.show {
                transform: translateX(0);
            }

            .notification-icon {
                margin-right: 10px;
                font-size: 20px;
            }

            .notification-message {
                font-weight: 500;
            }

            .no-results {
                text-align: center;
                color: #666;
                padding: 20px;
                display: none;
            }

            /* Media Query لوضعية الهاتف (أقل من 768px) */
            @media (max-width: 768px) {
                body {
                    padding: 0;
                    margin: 0;
                    font-size: 14px; /* تصغير حجم النص */
                }

                .with-sidebar .content-area {
                    margin-left: 0; /* إزالة المسافة الجانبية */
                    padding: 10px; /* تقليل الحواف الداخلية */
                    width: 100%; /* اجعل العرض ممتلئًا */
                }

                .container {
                    width: 95%; /* تقليل عرض الحاوية */
                    max-width: none; /* إزالة الحد الأقصى للعرض */
                    padding: 15px; /* تقليل الحواف الداخلية */
                    margin-top: -90PX; /* توسيط الحاوية */
                    box-shadow: none; /* إزالة الظلال */
                    border-radius: 10px; /* تقليل الزوايا المستديرة */
                }

                h2, h3 {
                    font-size: 18px; /* تصغير حجم العناوين */
                    margin-bottom: 10px; /* تقليل المسافة السفلية */
                }

                input {
                    font-size: 14px; /* تصغير حجم النص داخل الحقول */
                    padding: 8px; /* تقليل الحواف الداخلية */
                    margin: 5px 0; /* تقليل المسافات بين الحقول */
                }

                button {
                    font-size: 14px; /* تصغير حجم النص داخل الأزرار */
                    padding: 10px; /* تقليل الحواف الداخلية */
                }

                .toggle-header {
                    padding: 10px; /* تقليل الحواف الداخلية */
                    font-size: 14px; /* تصغير النص */
                }

                .toggle-list {
                    padding: 10px; /* تقليل الحواف الداخلية */
                }

                .toggle-list input {
                    font-size: 14px; /* تصغير النص داخل الحقول */
                    padding: 8px; /* تقليل الحواف الداخلية */
                }
            }
    </style>
    
</head>
 <?php renderSidebar(); ?>
<body class="with-sidebar"> 
    
    <div class="content-area">
        <div class="container">
            <H2> Yeni Hizmet Ekle</H2>
            <form method="post">
                <!-- حقل المهنة -->
                <input type="text" name="profession_name" placeholder="Hizmet adı" required>

                <!-- حقل التخصصات -->
                <h3>Alan Ekle</h3>
                <input type="text" name="sub_profession_name[]" placeholder="ALan 1 " required>
                <input type="text" name="sub_profession_name[]" placeholder="Alan 2" >
                <input type="text" name="sub_profession_name[]" placeholder="Alan 3" >

                <!-- قسم التخصصات الإضافية -->
                <div class="toggle-header" id="toggle-header">
                    <span>Ek alanlar ekleyin</span>
                        <img id="toggle-icon" src="image/down.png" alt="Arrow Icon">
                </div>
                <div class="toggle-list" id="toggle-list">
                    <input type="text"name="sub_profession_name[]" class="input-field" placeholder="Alan 4">
                    <input type="text" name="sub_profession_name[]" class="input-field" placeholder="Alan 5">
                    <input type="text" name="sub_profession_name[]" class="input-field" placeholder="Alan 6">
                    <input type="text" name="sub_profession_name[]" class="input-field" placeholder="Alan 7">
                    <input type="text" name="sub_profession_name[]" class="input-field" placeholder="Alan 8">
                    <input type="text" name="sub_profession_name[]" class="input-field" placeholder="Alan 9">          
                </div>
                <!-- زر الإرسال -->
                <button type="submit">Ekle</button>
            </form>
        </div>
   

    </div>
    <div class="containere">
        <div class="curved-line2"></div>
        <div class="curved-line1"></div>
    </div> 
<script>
    const toggleHeader = document.getElementById('toggle-header');
    const toggleList = document.getElementById('toggle-list');
    const toggleIcon = document.getElementById('toggle-icon');

    toggleHeader.addEventListener('click', function() {
        // Toggle the visibility of the list
        toggleList.classList.toggle('open');
        toggleHeader.classList.toggle('active');
    });
</script>

</body>
</html>