<?php
// navbar.php - يحتوي على كود الناف بار الكامل

// يمكنك إضافة متغيرات لتحديد الصفحة النشطة
// $current_page = "home"; // يمكن تعيين هذا في كل صفحة قبل استدعاء navbar.php
?>

<!-- أنماط النافبار -->
<style>
    /* Navbar Styles */
    header {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0; /* فقط علوي وسفلي */
        background: transparent;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000; /* تأكد من أنه يظهر فوق جميع العناصر الأخرى */
    }
    
    .navbar-outline {
        position: fixed;
        top: 20px;
        left: 55px;
        width: calc(90% + 10px);  /* نزيد العرض 5px من اليمين و5px من اليسار */
        height: calc(90px + 10px); /* نزيد الارتفاع فوق وتحت */
        border: 1px solid black;
        border-radius: 18px; /* شوي أكبر من nav */
        transform: skew(-20deg);
        z-index: 0;
    }

    nav {
        width: 90%; /* تم تقليل العرض لخلق فراغ على الطرفين */
        max-width: 1400px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
        background-color: white;
        border-radius: 15px;
        height: 90px;
        margin-top: -40px;
        box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.3);
        padding: 0 2.5%; /* فراغ داخلي من اليمين واليسار بنسبة */
        transform: skew(-20deg);
        position: relative;
        z-index: 10;
        transition: all 0.4s ease;
        position: fixed;
    }

    .logo img {
        height: 80px;
        width: auto;
        max-width: 200px;
        transform: skew(20deg);
    }
    
    .home-icon {
        width: 40px;
        height: 40px;
        object-fit: contain;
        margin-right: 10px;
        vertical-align: middle;
        transition: transform 0.3s ease-in-out;
    }
    
    .home-icon:hover {
        transform: scale(1.2);
    }
    
    .nav-links {
        display: flex;
        align-items: center;
        gap: 35px;
        transform: skew(20deg);
    }
    
    .nav-links a {
        text-decoration: none;
        color: black;
        font-size: 22px;
        transition: transform 0.3s ease-in-out;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }
    
    .nav-links a:hover {
        transform: scale(1.2);
    }
    
    .buttons {
        display: flex;
        gap: 20px;
        transform: skew(20deg);
    }
    
    .buttons .btn {
        padding: 16px 28px;
        border: none;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        background-color: #d61b15;
        color: white;
        border-radius: 10px;
        transform: skew(-30deg);
        transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }
    
    .btn.red {
        background-color: #d61b15;
    }
    
    .buttons .btn span {
        display: inline-block;
        transform: skew(30deg);
    }
    
    .buttons .btn:hover {
        background-color: #b51510;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Mobile menu toggle button */
    .menu-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        transform: skew(20deg);
        z-index: 1000;
    }
    
    .menu-toggle .bar {
        display: block;
        width: 30px;
        height: 3px;
        margin: 6px auto;
        background-color: #333;
        transition: all 0.3s ease-in-out;
    }
    
    /* إخفاء mobile-buttons على الشاشات الكبيرة */
    .mobile-buttons {
        display: none;
    }

    /* إضافة مسافة للمحتوى تحت الناف بار الثابت */
    .content-spacer {
        height: 130px; /* يجب ضبطه بناءً على ارتفاع الناف بار */
    }

    /* Media queries for responsive design */
    @media (max-width: 1024px) {
        .nav-links {
            gap: 20px;
        }
        
        .nav-links a {
            font-size: 18px;
        }
        
        .buttons .btn {
            padding: 12px 20px;
            font-size: 16px;
        }
    }
    
    @media (max-width: 768px) {
        header {
            
            padding: 10% 4%;
            width: 100%;
        }

        .navbar-outline {
            display: none; /* إزالة الإطار الأسود في نسخة الهاتف */
           
        }

        nav {
            
            padding: 0 4%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.3);
            transform: none;
            width: 90%; /* عرض كامل للشاشة */
            max-width: 100%;
            flex-wrap: wrap;
            transition: all 0.4s ease;
            top: 50px; /* أو أي مسافة بدك ياها */
        }

        nav.expanded {
            height: auto;
            padding-bottom: 20px;
            border-radius: 15px;
        }

        .logo img {
            height: 50px;
            transform: none;
        }

        /* تعديل الروابط لتظهر أسفل الناف بار */
        .nav-links {
            display: none; /* إخفاء افتراضي */
            width: 100%;
            flex-direction: column;
            padding-top: 15px;
            gap: 20px;
            align-items: center;
            transform: none;
            opacity: 0;
            transition: all 0.4s ease;
            margin-top: 10px;
            order: 3;
        }

        .nav-links.active {
            display: flex;
            opacity: 1;
            animation: fadeInDown 0.5s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: none;
            }
            to {
                opacity: 1;
                transform: none;
            }
        }

        .buttons {
            display: none;
        }

        /* زر المزيد (hamburger menu) */
        .menu-toggle {
            display: block;
            background: none;
            border: none;
            cursor: pointer;
            transform: none;
        }

        /* الأزرار الجديدة (زرين مع صور) */
        .mobile-buttons {
            display: flex;
            gap: 10px;
            transform:none;
        }

        .mobile-buttons img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            cursor: pointer;
            transition: none;
        }

        .mobile-buttons img:hover {
            transform: scale(1.2);
        }

        /* إخفاء أيقونة الرئيسية على الهاتف والإبقاء على النص فقط */
        .nav-links a.home-icon-link {
            display: none;
        }

        .nav-links a.home-link {
            display: block;
        }

        .nav-links a {
            padding: 10px 0;
            font-size: 20px;
            color: #333;
            text-decoration: none;
            text-align: center;
            width: 100%;
            display: block;
            transition: none;
        }

        .nav-links a:hover {
            transform: none;
        }

        /* أنيميشن لزر المزيد */
        .menu-toggle.active .bar:nth-child(1) {
            transform:none;
        }

        .menu-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active .bar:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg)none;
        }
        
        /* تعديل مسافة المحتوى للهاتف */
        .content-spacer {
            height: 90px;
        }
    }
</style>

<!-- هيكل النافبار HTML -->
<header>
    <div class="navbar-outline"></div>
    <nav id="mainNav">
        <a href="home.php">
        <div class="logo"><img src="img/logoo.png" alt="Acilci Logo"></div> </a>
        <!-- إضافة الأزرار الجديدة للجوال -->
        <div class="mobile-buttons">
            <a href="#"><img src="img/boton1.png" alt="Button 1"></a>
            <a href="#"><img src="img/boton2.png" alt="Button 2"></a>
        </div>
        <div class="nav-links" id="navLinks">
            <!-- أيقونة الرئيسية للكمبيوتر -->
            <a href="home.php" class="home-icon-link"><img src="img/35.png" alt="Home Icon" class="home-icon"></a>
            <!-- زر نصي للرئيسية للهاتف 
             
            <a href="#" class="home-link">Ana Sayfa</a>
            
           
            -->
            <a href="hizmetler.php">Hizmetler</a>
            <a href="hakkinda.php">Hakkında</a>
            <a href="bizeulas.php">Bize Ulaşın</a>
        </div>
        <div class="buttons">
            <!-- Buttons with skewed style matching the form submit button -->
           <a href="acil.php"> <button class="btn red"><span>Acil servis</span></button> </a>
          <a href="../register/login.php">  <button class="btn"><span>Giriş</span></button> </a>
        </div>
        <!-- زر المزيد مع خطوط -->
        <button class="menu-toggle" id="menuToggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </nav>
</header>

<!-- مسافة للمحتوى تحت الناف بار الثابت -->
<div class="content-spacer"></div>

<!-- إضافة JavaScript للتبديل بين القائمة المحمولة -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        const mainNav = document.getElementById('mainNav');
        
        menuToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            mainNav.classList.toggle('expanded');
            menuToggle.classList.toggle('active'); // لأنيميشن الخطوط
        });
        
        // إغلاق القائمة عند النقر على أحد الروابط
        const links = navLinks.querySelectorAll('a');
        links.forEach(function(link) {
            link.addEventListener('click', function() {
                navLinks.classList.remove('active');
                mainNav.classList.remove('expanded');
                menuToggle.classList.remove('active');
            });
        });
        
        // إضافة معالج لحدث التحريك (scroll)
        window.addEventListener('scroll', function() {
            // يمكنك إضافة أنماط إضافية عند التمرير إذا كنت ترغب في ذلك
            // مثلاً إضافة خلفية أكثر تعتيمًا عند التحريك
            // يمكن إضافة هذا لاحقًا إذا احتجت إليه
        });
    });
</script>