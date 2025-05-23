<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة هبوط متجاوبة</title>
    <style>
        /* إعدادات عامة للصفحة */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: #f5f5f5;
            /* Light gray background for the entire page */
        }

        .hero-section {
            background: url('img/4.png') no-repeat center center/cover;
            min-height: 100vh;
            /* Full viewport height for hero section */
            position: relative;
        }
        /* Form section - removed white background */
        
        .form-section {
            padding: 80px 0;
            /* Increased padding */
            background-color: transparent;
            /* Removed background color */
        }
        /* Navbar Styles */
        
        header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 50px;
            background: transparent;
        }
        
        
        .hero {
            position: relative;
            height: calc(100vh - 130px);
            display: flex;
            margin-left: 50%;
            align-items: center;
            color: rgb(255, 255, 255);
            text-align: left;
        }
        
        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            padding-left: 130px;
        }
        
        .content h1 {
            font-size: 90px;
            /* Increased font size */
            font-weight: bold;
            color: rgb(255, 255, 255);
            text-align: left;
        }
        /* تنسيق الحاويات للأقسام */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* تنسيق الأقسام - مثل الصورة المرفقة */
        .section {
            display: flex;
            margin-bottom: 60px;
            padding: 20px 0;
        }

        /* تنسيق القسم المعكوس */
        .section-reverse {
            flex-direction: row-reverse;
        }

        /* تنسيق الصورة */
        .image-part {
            flex: 1;
            min-height: 350px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 50px;
        }

        .image-part img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* تنسيق العنوان الرئيسي بلون أحمر مثل الصورة */
        .section-title {
            color: #e32929;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* تنسيق النص */
        .text-part {
            flex: 1;
            padding: 20px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .text-part h2 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #d61b15;
        }

        .text-part p {
            font-size: 20px;
            font-weight: bold;
            line-height: 1.6;
            color: #333;
        }

        /* قسم "جيب قسمك لهون" */
        .contact-section-andar {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            flex-direction: column;
        }

        .card-container {
            width: 72%;
            max-width: 1100px;
            background-color: #fabc05;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            padding: 40px;
            position: relative;
            transform: skew(-7deg);
        }

        .text-section {
            flex: 1;
            padding-right: 350px; /* كان 350px وخفّفته */
            transform: skew(8deg);
        }
        .main-title {
            font-size: 42px;
            font-weight: bold;
            color: #000;
            margin-bottom: 30px;
        }

        .description {
            font-size: 20px;
            color: #000;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .secondary-title {
            font-size: 32px;
            font-weight: bold;
            color: #000;
        }

        .floating-image-container {
            position: absolute;
            z-index: 10;
            top: 90px;
            right: 320px; /* خففته شوي */
            width: 280px; /* خففته شوي */
            pointer-events: none;
        }

        .floating-image {
            width: 150%;
            height: 150%;
            display: block;
        }

        .signup-button-container {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .signup-button {
            background-color: #a2110d;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 16px 28px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            height: 60px; /* تثبيت الارتفاع */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: skew(-30deg);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .button-content {
            transform: skew(30deg);
            display: flex;
            align-items: center;
        }

        .button-icon {
            width: 50px;
            height: 50px;
            margin-left: 10px;
        }

        .signup-button:hover {
            background-color: #c42836;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        /* تجاوب الموقع مع الشاشات الصغيرة */
        @media (max-width: 768px) {
            /* تعديل قسم الهيرو للهاتف */
            .hero-section {
                min-height: 70vh; /* تقليل ارتفاع القسم الأول للهاتف */
                background-position: 70% center; /* تحريك الخلفية للتركيز على الجزء المهم */
            }
            
            .hero {
                height: calc(70vh - 100px);
                margin-left: 0; /* إزالة الهامش اليسار */
                justify-content: center; /* توسيط المحتوى أفقيًا */
            }
            
            .content {
                padding: 15px;
                text-align: center; /* توسيط النص */
                padding-left: 15px; /* إزالة الباديننغ من اليسار */
            }
            
            .content h1 {
                font-size: 50px; /* تقليل حجم الخط للهاتف */
                text-align: center; /* توسيط النص */
            }

            /* ترتيب الأقسام التالية */
            .section, .section-reverse {
                flex-direction: column;
                align-items: center; /* توسيط العناصر */
                text-align: center;
            }
            
            .image-part {
                min-height: 200px;
                order: 1; /* جعل الصورة تظهر أولاً في الشاشات الصغيرة */
                width: 100%;
                margin-top: 20px;
            }
            
            .text-part {
                order: 2;
                padding: 20px;
                text-align: center;
                align-items: center;
            }
            
            .section-title {
                font-size: 28px;
                text-align: center;
            }
            
            .text-part p {
                font-size: 16px;
            }
            
            /* تعديل قسم الكارت الأخضر (الأصفر) */
            .contact-section-andar {
                min-height: auto;
                padding: 40px 0;
            }
            
            .card-container {
                width: 90%;
                transform: none; /* إزالة الانحراف */
                padding: 30px 20px;
                margin-bottom: 80px; /* إضافة مساحة للزر تحته */
            }
            
            .text-section {
                padding-right: 0;
                transform: none; /* إزالة الانحراف */
                text-align: center;
            }
            
            .main-title {
                font-size: 28px;
            }
            
            .description {
                font-size: 16px;
            }
            
            .secondary-title {
                font-size: 24px;
            }
            
            /* إزالة الصورة من الكارت */
            .floating-image-container {
                display: none;
            }
            
            /* تعديل زر التسجيل */
            .signup-button-container {
                position: relative;
                bottom: auto;
                left: auto;
                transform: none;
                margin-top: 30px;
            }
            
            .signup-button {
                transform: none;
                width: 100%;
                justify-content: center;
            }
            
            .button-content {
                transform: none;
                justify-content: center;
            }
            
            /* تعديل الكونتينر */
            .container {
                margin: 20px auto;
            }
            
            /* إضافة مساحة بين الأقسام */
            .section {
                margin-bottom: 40px;
            }
        }
    </style>
</head>
<body>
<div class="hero-section">
        <!-- Navigation Bar Section -->
        <header>
        <?php include 'navbar.php'; ?>
        </header>

        <!-- Hero Content -->
        <section class="hero">
            <div class="content">
                <h1>Bize</h1>
                <h1>Kimiz?</h1>
            </div>
        </section>
    </div>
    <!-- المحتوى الرئيسي -->
    <div class="container">
        <!-- القسم الأول: صورة يمين، نص يسار (مثل الصورة المرفقة) -->
        <section class="section">
            <div class="text-part">
                <h2 class="section-title">Vizyonumuz</h2>
                <p>Biz açilci olarak zamanın en değerli kaynak olduğuna inanıyoruz. Bu nedenle, müşterileri hizmet sağlayıcılarla sorunsuz ve hızlı bir şekilde buluşturan yenilikçi bir platform sunuyoruz. Acil bir hizmete mi ihtiyacınız var, yoksa planlı bir talepte mi bulunmak istiyorsunuz? Amacımız, en yüksek kalitede ve en kısa sürede hizmet almanızı sağlayacak güvenilir ve güvenli bir ortam yaratmaktır.</p>
            </div>
            <div class="image-part dots-decoration">
                <img src="img/7.png" alt="عمال في موقع البناء بخوذات صفراء">
                
            </div>
        </section>

        <!-- القسم الثاني: صورة يسار، نص يمين -->
        <section class="section section-reverse">
            <div class="text-part">
                <h2 class="section-title">Misyonumuz</h2>
                <p>Müşteriler ile hizmet sağlayıcıları akıllı bir şekilde birbirine bağlayan, anında ve etkili çözümler sunuyoruz. Kullanıcı dostu arayüzümüz sayesinde hizmetleri kolayca arayabilir, filtreleyebilir ve tek bir tıklamayla talepte bulunabilirsiniz. İster acil bir tamirata, ister ev temizliğine ya da başka bir hizmete ihtiyacınız olsun, acilci sizin yanınızda.</p>            </div>
            <div class="image-part">
                <img src="img/8.png" alt="وصف الصورة">
            </div>
        </section>

        <!-- القسم الثالث: صورة يمين، نص يسار -->
        <section class="section">
            <div class="text-part">
                <h2 class="section-title">Neden Biz?</h2>
                <p>Anında Yanıt: Acil hizmet taleplerinizi doğrudan hizmet sağlayıcılara iletebilirsiniz.
Çeşitli Hizmetler: Temizlik, bakım, nakliye ve daha fazlasını içeren kapsamlı bir platform sunuyoruz.
Güvenilir Değerlendirmeler: Şeffaf değerlendirme sistemimiz sayesinde, önceki müşteri deneyimlerine dayanarak en iyi hizmet sağlayıcıyı seçebilirsiniz.
Kolay Kullanım: Hızlı ve sezgisel kullanıcı deneyimi ile aradığınız hizmeti kolayca bulabilirsiniz.
Sürekli Destek: Destek ekibimiz, sorularınızı yanıtlamak ve sorunsuz bir deneyim sağlamak için her zaman hazırdır</p>
            </div>
            <div class="image-part">
                <img src="img/9.png" alt="وصف الصورة">
            </div>
        </section>

        <!-- القسم الرابع: صورة يسار، نص يمين -->
        <section class="section section-reverse">
            <div class="text-part">
                <h2 class="section-title">Sistem Nasıl Çalışır?</h2>
                <p>Gelişmiş arama motorumuz ve akıllı filtreleme sistemi ile ihtiyacınız olan hizmeti bulun.
Hizmetin acil mi yoksa planlı mı olduğunu belirleyin.
Gerekli bilgileri doldurup kolayca talepte bulunun.
Acil durumlarda hizmet sağlayıcıyla anında sohbet edin veya doğrudan arayın.
Hizmetinizi aldıktan sonra deneyiminizi değerlendirin ve kaliteyi korumaya katkı sağlayın.</p>
            </div>
            <div class="image-part">
                <img src="img/10.png" alt="وصف الصورة">
            </div>
        </section>

        <!-- قسم "جيب قسمك لهون" -->
        <div class="your-section">
        <div class="contact-section-andar">
        <div class="card-container">
            <div class="text-section">
              <h1 class="main-title">Bugün Bize Katılın!</h1>
              <p class="description">
                Güvenilir bir hizmet mi arıyorsunuz, yoksa hizmetlerinizi sunmak mı istiyorsunuz?
                acilci, sizin için en doğru adres! Hemen kaydolun ve akıllı sistemimizin sunduğu
                profesyonel ve sorunsuz deneyimden yararlanın.
              </p>
              <h2 class="secondary-title">Gerçek Yardımcı</h2>
            </div>
          </div>
        
          <div class="floating-image-container">
            <img src="img/_1x1 Acılci - fotolar .png" alt="Team Image" class="floating-image" />
          </div>
        
          <div class="signup-button-container">
            <a href="../register/login.php">
            <button class="signup-button">
              <div class="button-content">
                ÜCRETSİZ ÜYE OL
                <img src="img/10 (2).png" alt="Arrow Icon" class="button-icon" />
              </div>
            </button> </a>
          </div>

    </div>
        </div>
    </div>
    <footer>
    <?php  include 'footer.php';?>
    <?php includeFooter(); ?>
    </footer>
</body>
</html>

