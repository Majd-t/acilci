<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acilci - İletişim Formu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        /* Hero section with background image */
        
        .hero-section {
            background: url('img/kabak1.png') no-repeat center center/cover;
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
            justify-content: center;
            align-items: center;
            color: rgb(255, 255, 255);
            text-align: center;
        }
        
        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 30px;
            border-radius: 10px;
        }
        
        .content h1 {
            font-size: 60px;
            /* Increased font size */
            font-weight: bold;
            color: #fabc05;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            margin-bottom: 15px;
        }
        /* Form Styles - removed container background */
        
        .form-container {
            width: 100%;
            max-width: 1000px;
            /* Increased width */
            padding: 40px;
            /* Increased padding */
            margin: 0 auto;
            background-color: transparent;
            /* Removed white background */
            border-radius: 15px;
        }
        
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            /* Increased margin */
        }
        
        .form-group {
            width: 48%;
            margin-bottom: 25px;
            /* Increased margin */
            position: relative;
        }
        
        .form-group.full-width {
            width: 100%;
        }
        
        label {
            font-size: 16px;
            /* Increased font size */
            color: #333;
            /* Darker text color */
            margin-bottom: 8px;
            /* Increased margin */
            display: block;
            font-weight: bold;
            transition: transform 0.3s ease, color 0.3s ease;
        }
        
        label span {
            color: #d61b15;
            /* Red color for asterisk */
        }
        
        .form-group:hover label {
            transform: translateY(-3px);
            color: #000;
        }
        
        .input-box {
            position: relative;
            width: 100%;
            height: 70px;
            /* Increased height */
            background-color: #fff;
            border: 1px solid #666;
            border-radius: 15px;
            transform: skew(-30deg);
            display: flex;
            align-items: center;
            padding: 0 15px 0 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            /* Increased shadow */
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        
        .textarea-box {
            position: relative;
            width: 100%;
            height: 180px;
            /* Increased height */
            background-color: #fff;
            border: 1px solid #666;
            border-radius: 15px;
            transform: skew(-30deg);
            padding: 15px 15px 15px 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            /* Increased shadow */
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        
        .input-box:hover,
        .textarea-box:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            /* Increased shadow on hover */
            border-color: #333;
        }
        
        .input-box input {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            font-size: 18px;
            /* Increased font size */
            background: transparent;
            transform: skew(30deg);
            color: #333;
            padding-left: 10px;
        }
        
        .textarea-box textarea {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            font-size: 18px;
            /* Increased font size */
            background: transparent;
            transform: skew(30deg);
            color: #333;
            resize: none;
            padding-left: 25px;
        }
        
        .input-box .icon,
        .textarea-box .icon {
            position: absolute;
            right: 15px;
            font-size: 24px;
            /* Increased font size */
            color: #000;
            transform: skew(30deg);
            transition: transform 0.3s ease;
        }
        
        .input-box:hover .icon,
        .textarea-box:hover .icon {
            transform: skew(30deg) scale(1.2);
        }
        
        .submit-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
            /* Increased margin */
        }
        
        .submit-btn {
            width: 240px;
            /* Increased width */
            padding: 18px;
            /* Increased padding */
            font-size: 20px;
            /* Increased font size */
            font-weight: bold;
            background-color: #d61b15;
            color: white;
            border: none;
            border-radius: 12px;
            /* Increased border radius */
            cursor: pointer;
            transform: skew(-30deg);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(214, 27, 21, 0.3);
            /* Added shadow to button */
        }
        
        .submit-btn:hover {
            background-color: #b51510;
            box-shadow: 0 8px 20px rgba(214, 27, 21, 0.5);
            /* Increased shadow on hover */
        }
        
        .submit-btn span {
            display: inline-block;
            transform: skew(30deg);
        }
        
        /* بداية أنماط صفحة thertibege.html - القسم المضاف */
        .contact-section {
            background: url('img/hat1.png') no-repeat center center/cover;
            min-height: 100vh;
            overflow: hidden;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
            direction: rtl;
        }
        
        .contact-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 10px;
            height: 95vh;
            
        }
        
        .contact-section .section {
            padding: 20px;
            position: relative;
        }
        
        .contact-section .contact-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* محاذاة العناصر من اليمين */
            margin-top: 30px;
            margin-left: 0;
            padding-left: 140px; /* بدل padding-left */
        }
        
        .contact-section .title {
            color: #e53935;
            font-size: 40px;
            margin-bottom: 20px;
            margin-left: 0;
            margin-right: 40px; /* تعيين المسافة من اليمين لتقريبه */
            text-align: right;
        }
        
        .contact-section .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
            direction: ltr;
            /* اتجاه من اليسار لليمين */
        }
        
        .contact-section .icon {
            width: 40px;
            height: 40px;
            margin-right: 15px;
            display: inline-block;
        }
        
        .contact-section .contact-text {
            font-size: 20px;
            color: #333;
            display: inline-block;
        }
        
        .contact-section .question-section {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-bottom: -30px;
        }
        
        .contact-section .question-icon {
            width: 300px;
            height: 300px;
        }
        
        .contact-section .megaphone-section {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .contact-section .megaphone-icon {
            width: 300px;
            height: 300px;
        }
        
        .contact-section .social-section {
            display: flex;
            flex-direction: column;
            align-items: end;
            justify-content: center;
        }
        
        .contact-section .social-title {
            color: #e53935;
            font-size: 40px;
            margin-bottom: 30px;
            margin-top: 50px;
           
        }
        
        .contact-section .social-icons {
            display: flex;
            gap: 20px;
        }
        
        .contact-section .social-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .contact-section .social-icon:hover {
            transform: scale(1.1);
        }
        
        .contact-section .dashed-line {
            position: absolute;
            border-top: 2px dashed #ccc;
            width: 80%;
            z-index: -1;
        }
        
        .contact-section .dashed-line-1 {
            top: 30%;
            left: 10%;
            transform: rotate(-5deg);
        }
        
        .contact-section .dashed-line-2 {
            bottom: 40%;
            right: 10%;
            transform: rotate(-5deg);
        }

        .contact-section-andar
        {
            display: flex;
          justify-content: center;
           align-items: center;
      min-height: 100vh;
      position: relative;
      flex-direction: column;
        }

        .card-container {


      width: 70%;
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
      top: 210px;
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
      text-decoration: none;
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
      text-decoration: none;
    }

    .button-content {
      transform: skew(30deg);
      display: flex;
      align-items: center;
      text-decoration: none;
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

    
    /* تعديلات وضع الهاتف */
    @media (max-width: 768px) {
      /* تعديلات العنوان الرئيسي في البداية */
      .content h1 {
        font-size: 40px;
      }

      /* تعديلات قسم الفورم للهاتف */
      .form-section {
        padding: 40px 20px;
      }

      .form-container {
        padding: 20px;
        margin-left: 40px;
      }

      .form-row {
        flex-direction: column;
        margin-bottom: 0;
      }

      .form-group, .form-group.full-width {
        width: 70%;
        margin-bottom: 20px ;
      }

      .input-box {
        height: 55px;
      }

      .textarea-box {
        height: 150px;
      }

      .input-box input, .textarea-box textarea {
        font-size: 16px;
      }

      .submit-btn {
        width: 200px;
        padding: 14px;
        font-size: 18px;
        margin-right: 120px;
      }

      /* تعديلات قسم الاتصال بحيث تظهر العناصر فوق بعضها */
      .contact-section {
        min-height: auto;
        padding: 30px 10px;
        background-size: cover;
      }

      .contact-container {
        display: flex;
        flex-direction: column;
        height: auto;
        gap: 30px;
      }

      .contact-section .section {
        padding: 15px 10px;
        width: 100%;
      }

      /* تعديل حجم الصور للهاتف */
      .contact-section .question-icon,
      .contact-section .megaphone-icon {
        width: 200px;
        height: 200px;
      }

      .contact-section .question-section,
      .contact-section .megaphone-section {
        justify-content: center;
        margin-bottom: 0;
        margin-top: 20px;
      }

      /* تعديل العناوين والأيقونات للهاتف */
      .contact-section .title,
      .contact-section .social-title {
        font-size: 30px;
        margin-right: 0;
        text-align: center;
      }

      .contact-section .contact-info {
        align-items: center;
        padding-left: 0;
      }

      .contact-section .social-section {
        align-items: center;
      }

      .contact-section .social-icons {
        justify-content: center;
        flex-wrap: wrap;
      }

      .contact-section .social-icon {
        width: 50px;
        height: 50px;
      }

      /* تعديل القسم الأخير للهاتف */
      .card-container {
        flex-direction: column;
        align-items: center;
        transform: none;
        padding: 30px 20px;
        width: 80%;
      }

      .text-section {
        transform: none;
        padding-right: 0;
        text-align: center;
      }

      .main-title {
        font-size: 32px;
        margin-bottom: 20px;
      }

      .description {
        font-size: 16px;
        margin-bottom: 20px;
      }

      .secondary-title {
        font-size: 24px;
      }

      /* إعادة تموضع الصورة العائمة لتكون مستقلة */
      .floating-image-container {
    display: none;
  }

      .floating-image {
        width: 100%;
        height: auto;
        /* تم تعديل الصورة لتكون مقصوصة ومناسبة للعرض على الهاتف */
        object-fit: contain;
      }

      .signup-button-container {
        position: relative;
        bottom: auto;
        left: auto;
        transform: none;
        margin-top: 20px;
      }

      .signup-button {
        transform: none;
        margin: 0 auto;
      }

      .button-content {
        transform: none;
      }
    }
    </style>
</head>

<body>
    <!-- Hero Section with Background Image -->
    <div class="hero-section">
        <!-- Navigation Bar Section -->
        <header>
        <?php include 'navbar.php'; ?>
        </header>

        <!-- Hero Content -->
        <section class="hero">
            <div class="content">
                <h1>Bize Ulaşın</h1>
            </div>
        </section>
    </div>

    <!-- Form Section - removed white background container -->
    <div class="form-section">
        <div class="form-container">
            <div class="form-row">
                <div class="form-group">
                    <label>Adı<span>*</span></label>
                    <div class="input-box">
                        <input type="text" value="">
                        <span class="icon">✏</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Soyadı<span>*</span></label>
                    <div class="input-box">
                        <input type="text" value="">
                        <span class="icon">✏</span>
                    </div>
                </div>
            </div>

            <div class="form-group full-width">
                <label>E-posta<span>*</span></label>
                <div class="input-box">
                    <input type="email" value="">
                    <span class="icon">✏</span>
                </div>
            </div>

            <div class="form-group full-width">
                <label>Konu<span>*</span></label>
                <div class="input-box">
                    <input type="text" value="">
                    <span class="icon">✏</span>
                </div>
            </div>

            <div class="form-group full-width">
                <label>Mesajınız</label>
                <div class="textarea-box">
                    <textarea></textarea>
                    <span class="icon">✏</span>
                </div>
            </div>

            <div class="submit-container">
                <button type="submit" class="submit-btn"><span>Gönder</span></button>
            </div>
        </div>
    </div>
    
    <!-- محتوى صفحة thertibege.html - القسم المضاف -->
    <div class="contact-section">
        <div class="contact-container">
            <!-- القسم العلوي اليمين - أيقونات الاستفهام -->
            <div class="section question-section">
                <div class="question-icon">
                    <img src="img/1bizaulas.png" alt="Phone Icon" class="question-icon">
                </div>
            </div>

            <!-- القسم العلوي اليسار - معلومات الاتصال -->
            <div class="section contact-info">
                <h2 class="title">İletişim</h2>
                <li class="contact-item">
                    <img src="img/3aykon.png" alt="Phone Icon" class="icon"> +90 5XX XXX XX XX
                </li>
                <li class="contact-item">
                    <img src="img/5aykon.png" alt="Email Icon" class="icon"> info@acılcı.co
                </li>
            </div>

            <!-- القسم السفلي اليمين - وسائل التواصل الاجتماعي -->
            <div class="section social-section">
                <h2 class="social-title">Bizi takip edin</h2>
                <div class="social-icons">
                    <a href="#"><img src="img/6aykon.png" alt="Instagram" class="social-icon"></a>
                    <a href="#"><img src="img/7aykon.png" alt="Facebook" class="social-icon"></a>
                    <a href="#"><img src="img/9aykon.png" alt="Linkedin" class="social-icon"></a>
                    <a href="#"><img src="img/8aykon.png" alt="YouTube" class="social-icon"></a>
                </div>
            </div>

            <!-- القسم السفلي اليسار - الكمبيوتر والمكبر -->
            <div class="section megaphone-section">
                <div class="megaphone-icon">
                    <img src="img/2bizeulas.png" alt="Phone Icon" class="megaphone-icon">
                </div>
            </div>
        </div>
    </div>

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
                <img src="img/1aykon.png" alt="Arrow Icon" class="button-icon" />
              </div>
            </button> </a>
          </div>

    </div>

    <footer>
    <?php  include 'footer.php';?>
    <?php includeFooter(); ?>
    </footer>
</body>

</html>