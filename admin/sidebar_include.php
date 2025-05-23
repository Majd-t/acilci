<?php
function renderSidebar() {
    ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* زر التبديل (يظهر فقط في الهواتف) */
        .sidebar-toggle {
            display: none; /* مخفي افتراضيًا في الكمبيوتر */
            position: fixed;
            top: 15px;
            left: 15px;
            background-color: rgb(188, 25, 19);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1002; /* أعلى من كل شيء */
            color: white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.4);
        }

        .toggle-icon {
            width: 24px;
            height: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .toggle-icon span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: white;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        /* تحريك الخطوط لشكل X عند تفعيل القائمة */
        .sidebar-toggle.active .toggle-icon span:nth-child(1) {
            transform: translateY(8.5px) rotate(45deg);
        }

        .sidebar-toggle.active .toggle-icon span:nth-child(2) {
            opacity: 0;
        }

        .sidebar-toggle.active .toggle-icon span:nth-child(3) {
            transform: translateY(-8.5px) rotate(-45deg);
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 350px;
            height: 100vh;
            background-color: rgb(188, 25, 19);
            overflow: hidden;
            z-index: 100;
            border-radius: 30px;
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.5s ease-out;
        }

        .sidebar-top {
            text-align: center;
            padding: 40px 30px 20px;
        }

        .profile-image {
            width: 400px;
            height: 200px;
            margin-top: 20px;
            margin-bottom: -60px;
            margin-right: 25px;
        }

        .profile-image img {
            width: 70%;
            height: 70%;
        }

        .logo {
            color: white;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .logo-subtitle {
            color: white;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .menu-items {
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: 0 21px;
            width: 75%;
            margin-right: 15px;
        }

        .menu-item {
            background-color: white;
            color: #b81510;
            padding: 15px 25px;
            font-size: 22px;
            font-weight: bold;
            transform: skew(-20deg);
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }

        .menu-item:hover {
            background-color: gold;
            color: #383848;
            transform: skew(-20deg) translateX(10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 215, 0, 0.2);
            transition: all 0.5s ease;
        }

        .menu-item.active::before {
            left: 0;
        }

        .curved-line1 {
            position: fixed;
            width: 110px;
            height: 150px;
            bottom: 0px;
            left: 0;
            border-top: 2px solid rgba(255, 255, 255, 0.7);
            border-right: 2px solid rgba(255, 255, 255, 0.7);
            border-top-right-radius: 80px;
            z-index: 101;
            background-color: transparent;
        }

        .curved-line2 {
            position: fixed;
            width: 190px;
            height: 80px;
            bottom: 0px;
            left: 0;
            border-top: 2px solid rgba(255, 255, 255, 0.7);
            border-right: 2px solid rgba(255, 255, 255, 0.7);
            border-top-right-radius: 80px;
            z-index: 101;
            background-color: transparent;
        }

        .curved-line3 {
            position: fixed;
            width: 140px;
            height: 180px;
            bottom: 0px;
            right: 0; /* تغيير من left إلى right ليبدأ من اليمين */
            border-top: 2px solid #b81510;
            border-left: 2px solid #b81510; /* تغيير من border-right إلى border-left */
            border-top-left-radius: 80px; /* تغيير من border-top-right-radius إلى border-top-left-radius */
            z-index: 0;
            background-color: transparent;
            opacity: 0.5; /* جعل الشفافية 50% */
        }

        .curved-line4 {
            position: fixed;
            width: 70px;
            height: 250px;
            bottom: 0px;
            right: 0; /* تغيير من left إلى right ليبدأ من اليمين */
            border-top: 2px solid #b81510;
            border-left: 2px solid #b81510; /* تغيير من border-right إلى border-left */
            border-top-left-radius: 80px; /* تغيير من border-top-right-radius إلى border-top-left-radius */
            z-index: 0;
            background-color: transparent;
            opacity: 0.5; /* جعل الشفافية 50% */
        }

        /* منطقة السحب لفتح السايدبار */
        .swipe-area {
            position: fixed;
            width: 20px;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 98;
            background: transparent;
        }

        /* Media Query للهواتف (أقل من 768px) */
        @media screen and (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%); /* إخفاء Sidebar خارج الشاشة */
                width: 280px; /* عرض أقل في الهاتف */
                border-radius: 0 20px 20px 0; /* تعديل الزوايا */
                transition: transform 0.4s ease;
                position: fixed;
                left: 0;
                top: 0;
            }

            .sidebar.active {
                transform: translateX(0); /* يظهر عند التنشيط */
            }

            .sidebar-toggle {
                display: flex; /* إظهار زر التبديل في الهواتف */
            }

            .curved-line1, .curved-line2 {
                display: none; /* إخفاء الخطوط المنحنية في الهواتف */
            }
           
            

            .profile-image {
                width: 400px;
                height: 200px;
                margin-top: 20px;
                margin-bottom: -60px;
                margin-right: 25px;
            }

            .profile-image img {
                width: 70%;
                height: 70%;
            }

            .logo {
                font-size: 36px;
                margin-bottom: 10px;
            }

            .logo-subtitle {
                font-size: 16px;
                margin-bottom: 20px;
            }

            .menu-items {
                gap: 25px; /* زيادة المسافة بين المربعات */
                width: 85%; /* تكبير عرض المربعات */
                margin-top: 20px; /* إنزال المربعات للأسفل */
                padding: 0 21px;
                margin-right: 15px;
            }

            .menu-item {
                padding: 15px 25px; /* تكبير حجم المربعات */
                font-size: 20px; /* تكبير النص داخل المربعات */
            }

            /* تأثير متدرج للسايدبار في الهاتف */
            .sidebar::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                height: 100%;
                width: 15px;
                background: linear-gradient(to left, rgba(255, 255, 255, 0.1), transparent);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            /* مؤشر السحب في الجانب الأيمن من السايدبار */
            .swipe-indicator {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                height: 50px;
                width: 5px;
                background-color: rgba(255, 255, 255, 0.3);
                border-radius: 10px;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                padding: 5px 0;
            }
            
            .swipe-indicator::before, 
            .swipe-indicator::after {
                content: '';
                display: block;
                width: 3px;
                height: 8px;
                background-color: white;
                border-radius: 5px;
                margin-left: 1px;
            }
        }

        /* الحفاظ على السلوك في الكمبيوتر (أكبر من 768px) */
        @media screen and (min-width: 769px) {
            .sidebar-toggle {
                display: none !important; /* إخفاء زر التبديل في الكمبيوتر */
            }

            .sidebar {
                left: 0; /* Sidebar مفتوح دائمًا في الكمبيوتر */
                transform: translateX(0);
            }

           

            .swipe-area, .swipe-indicator {
                display: none !important; /* إخفاء مناطق السحب في الكمبيوتر */
            }
            

            .profile-image {
                width: 400px;
                height: 200px;
                margin-top: 20px;
                margin-bottom: -60px;
                margin-right: 25px;
            }

            .profile-image img {
                width: 70%;
                height: 70%;
            }

            .logo {
                color: white;
                font-size: 36px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .logo-subtitle {
                color: white;
                font-size: 16px;
                margin-bottom: 20px;
            }

            .menu-items {
                display: flex;
                flex-direction: column;
                gap: 30px;
                padding: 0 20px;
                width: 80%;
            }
        }
    </style>

    <button class="sidebar-toggle">
        <div class="toggle-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>

    <div class="swipe-area"></div>

    <div class="sidebar">
        <div class="swipe-indicator"></div>
        <div class="sidebar-top">
            <div class="profile-image">
                <a href="../ana/home.php"><img src="image/logo.png" alt="Profile Photo"></a>
            </div>
          
        </div>

        <div class="menu-items">
            <a href="new.php" class="menu-item">Ana Sayfa</a>
            <a href="hizmetciler.php" class="menu-item">Hizmetciler</a>
            <a href="kullanicilar.php" class="menu-item">Kullanıcılar</a>
            <a href="hizmetler.php" class="menu-item">Hizmetler</a>
            <a href="logout.php" class="menu-item">Çkış</a>
        </div>
    </div>

    <div class="containerr">
        <div class="curved-line2"></div>
        <div class="curved-line1"></div>
        <div class="curved-line3"></div>
        <div class="curved-line4"></div>
    </div>

    <script>
        // سكربت الـ Sidebar الأصلي
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.classList.add('active');
                this.style.transform = 'skew(-20deg) translateX(15px)';
                this.style.backgroundColor = '#ffd700';
            });

            item.addEventListener('mouseleave', function(event) {
                this.classList.remove('active');
                this.style.transform = 'skew(-20deg)';
                this.style.backgroundColor = 'white';

                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.backgroundColor = 'rgba(255, 215, 0, 0.1)';
                ripple.style.borderRadius = '50%';
                ripple.style.width = '200px';
                ripple.style.height = '200px';
                ripple.style.left = (event.offsetX - 100) + 'px';
                ripple.style.top = (event.offsetY - 100) + 'px';
                ripple.style.transform = 'scale(0)';
                ripple.style.opacity = '1';
                ripple.style.transition = 'all 0.6s ease-out';

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.style.transform = 'scale(1)';
                    ripple.style.opacity = '0';
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                }, 10);
            });

            item.addEventListener('click', function() {
                this.style.transform = 'skew(-20deg) scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'skew(-20deg) translateX(15px)';
                }, 150);
            });
        });

        // سكربت محسن للتحكم في السحب
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const swipeArea = document.querySelector('.swipe-area');
            
            // تعريف المتغيرات المستخدمة في السحب
            let touchStartX = 0;
            let touchEndX = 0;
            let currentX = 0;
            let initialX = 0;
            let sidebarWidth = 280; // عرض السايدبار في الهاتف
            let isDragging = false;
            
            // تعريف دالة لتحديث موضع السايدبار أثناء السحب
            function updateSidebarPosition(x) {
                // التأكد من أن السايدبار لا يتجاوز الحدود
                if (x > 0) x = 0;
                if (x < -sidebarWidth) x = -sidebarWidth;
                
                sidebar.style.transform = `translateX(${x}px)`;
            }
            
            // زر فتح/إغلاق السايدبار
            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                toggleButton.classList.toggle('active');
            });
            
            // معالجة أحداث اللمس لفتح السايدبار من الحافة
            swipeArea.addEventListener('touchstart', function(e) {
                touchStartX = e.touches[0].clientX;
                sidebar.style.transition = 'none'; // إيقاف الانتقال السلس أثناء السحب
                isDragging = true;
                initialX = -sidebarWidth; // وضع السايدبار خارج الشاشة
                currentX = initialX;
            }, {passive: true});
            
            document.addEventListener('touchmove', function(e) {
                if (!isDragging && !sidebar.classList.contains('active')) return;
                
                if (isDragging) {
                    // فتح السايدبار عند السحب من الحافة
                    let touchX = e.touches[0].clientX;
                    let diffX = touchX - touchStartX;
                    currentX = initialX + diffX;
                    updateSidebarPosition(currentX);
                } else if (sidebar.classList.contains('active')) {
                    // إذا كان السايدبار مفتوحًا وبدأ المستخدم بالسحب من داخله
                    touchStartX = e.touches[0].clientX;
                    sidebar.style.transition = 'none';
                    isDragging = true;
                    initialX = 0; // السايدبار مفتوح تمامًا
                    currentX = initialX;
                }
            }, {passive: true});
            
            document.addEventListener('touchend', function() {
                sidebar.style.transition = 'transform 0.4s ease'; // استعادة الانتقال السلس
                
                if (isDragging) {
                    if (currentX > -sidebarWidth / 2) {
                        // فتح السايدبار إذا تم سحبه لأكثر من نصف العرض
                        sidebar.classList.add('active');
                        toggleButton.classList.add('active');
                        sidebar.style.transform = 'translateX(0)';
                    } else {
                        // إغلاق السايدبار
                        sidebar.classList.remove('active');
                        toggleButton.classList.remove('active');
                        sidebar.style.transform = 'translateX(-100%)';
                    }
                }
                
                isDragging = false;
            }, {passive: true});
            
            // معالجة أحداث اللمس على السايدبار نفسه للإغلاق
            sidebar.addEventListener('touchstart', function(e) {
                if (sidebar.classList.contains('active')) {
                    touchStartX = e.touches[0].clientX;
                    sidebar.style.transition = 'none';
                    isDragging = true;
                    initialX = 0; // السايدبار مفتوح تمامًا
                    currentX = initialX;
                }
            }, {passive: true});
            
            // إغلاق السايدبار عند النقر خارجه
            document.addEventListener('click', function(e) {
                if (sidebar.classList.contains('active') && 
                    !sidebar.contains(e.target) && 
                    !toggleButton.contains(e.target) && 
                    !swipeArea.contains(e.target)) {
                    sidebar.classList.remove('active');
                    toggleButton.classList.remove('active');
                }
            });
        });
    </script>
    <?php
}
?>