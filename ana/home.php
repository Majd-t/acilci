<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acilci - Gerçek Yardımcı</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
                * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
               

            }

            body {
                background: url('img/new2.png') no-repeat center center/cover;
                height: 100vh;
                background-color: #f5f5f5;

            }

            header {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px 50px;
                background: transparent;
                
            }


            .hero {
                position: relative;
                height: calc(100vh - 90px);
                display: flex;
                justify-content: center;
                align-items: center;
                color: white;
                text-align: center;
            }

            .content {
                position: relative;
                z-index: 1;
                text-align: center;
                padding: 30px;
                border-radius: 10px;
                margin-bottom: 120px;
            }

            .content h1 {
                font-size: 48px;
                font-weight: bold;
                color: white;
                text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
                margin-bottom: 15px;
            }

            .content p {
                font-size: 24px;
                color: white;
                text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
                margin-bottom: 35px;
            }

            .action-buttons {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                padding: 40px 40px;
                
            }

            .search-box {
                display: flex;
                align-items: center;
                background-color: #fff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                overflow: hidden;
                transform: skew(-30deg);
                border-radius: 10px;
                height: 60px;
                


            }

            .search-icon {
                background-color: #111;
                color: white;
                padding: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 60px;

            }

            .search-icon i {
                font-size: 20px;
            }

            .search-input {
                border: none;
                outline: none;
                padding: 10px 20px;
                font-size: 18px;
                transform: skew(30deg);
                display: inline-block;
                background: none;
            }

            .emergency-button {
                background-color: red;
                color: white;
                padding: 10px 80px;         /* كبرنا البوكس */
                border: none;
                font-size: 20px;            /* كبرنا حجم الخط */
                display: flex;
                align-items: center;
                text-decoration: none;
                transition: background-color 0.3s;
                transform: skew(-30deg);
                border-radius: 10px;
                width: 300px;
                height: 60px;

            }
            
            
            
            .emergency-icon {
                width: 30px;
                height: 30px;
                margin-left: -20px;
                margin-right: 20px;
                margin-bottom: 5px;
                transform: skew(30deg);
            }
            .emergency-button p{
        margin-bottom: 1px;
        transform: skew(30deg);

            }
            
            

            #profession_id{
                width: 200px;
                height: 50px;
                
            }
            .main-content {
                flex: 1;
                padding:0 150px
            
            
            }
            .cards-container {
                display: grid;
                grid-template-columns: repeat(4, minmax(260px, 1fr)); /* Responsive */
                gap: 20px;
                justify-items: center;
                max-width: 1200px;
                margin-top: 65px;
            }

            .card {
                width: 260px; /* تم التصغير */
                height: 300px;
                border: 2px solid #00000050;
                border-radius: 15px;
                overflow: hidden;
                background: linear-gradient(180deg, #fff 70%, #f9f9f9 100%);
                position: relative;
                display: none; /* إخفاء البطاقات افتراضيًا */
            }

            .card.visible {
                display: block; /* إظهار البطاقات المرئية */
            }

            .card .main-image {
                width: 90%;
                height: 120px;
                object-fit: cover;
                border-radius: 12px;
                margin: 10px auto 0;
                display: block;
            }

            .profile-container {
                position: absolute;
                top: 90px;
                left: 15px;
                text-align: center;
            }

            .card .profile-image {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 3px solid #fff;
            }

            .profile-container .name {
                font-size: 14px;
                color: #333;
                font-weight: 600;
                margin-top: 5px;
            }

            .card-content {
                padding: 45px 15px 55px  10px;
                text-align: center;
            }

            .card-content h3 {
                color: #d32f2f;
                font-size: 16px;
                font-weight: 800;
                text-transform: uppercase;
                text-align: left;
                margin-bottom: 10px;
            }

            .card-info {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                font-size: 13px;
                gap: 10px;
               
            }
            .icon-img {
                width: 25px;
                height: 25px;
                vertical-align: middle; /* ليتوسّط مع الرقم */
                margin-right: 5px; /* مسافة بين الصورة والرقم */
            }
            .card-info .people {
                color: #d32f2f;
                display: flex;
                align-items: center;
                font-weight: 600;
            }

            .card-info .people i {
                margin-right: 4px;
                font-size: 16px;
                animation: pulse 1.5s infinite;
            }

            .card-info .rating {
                display: flex;
                align-items: center;
            }

            .card-info .rating i {
                margin: 0 1px;
                font-size: 12px;
                color: #fabc05;
                animation: sparkle 1.5s infinite;
            }

            .card-info .rating .rating-value {
                margin-left: 4px;
                font-size: 13px;
                color: #333;
                font-weight: 600;
            }

            .card-buttons {
                margin-top: 15px;
                margin-left: -15px;
                margin-right: -15px;
            }

            .card-buttons .view-btn,
            .card-buttons .delete-btn {
                padding: 10px 0;
                width: 90%;
                border: none;
                border-radius: 5px;
                background: #fabc05;
                color: #333;
                font-size: 14px;
                font-weight: bold;
                text-transform: uppercase;
                cursor: pointer;
                transition: background 0.3s ease, transform 0.3s ease;
                box-shadow: 0 4px 12px rgba(245, 197, 24, 0.4);
            }

            .card-buttons .view-btn:hover,
            .card-buttons .delete-btn:hover {
                background: linear-gradient(45deg, #ffeb3b, #f5c518);
                transform: scale(1.03);
            }

            /* زر عرض المزيد */
            .load-more-container {
                text-align: center;
                margin: 20px 0;
                padding: 20px;
            }

            .load-more-btn {
                cursor: pointer;
                padding: 15px 48px;
                transform: skew(-30deg);
                background: linear-gradient(to bottom right, #960c09, #d61b15);
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 20px;
                font-weight: bold;
                transition: background-color 0.3s ease;
            }

            .load-more-btn:hover {
                background: linear-gradient(to bottom right, #b71c1c, #e63946);
            }

            .load-more-btn p {
                transform: skew(30deg);
            }


            /* نافذة التأكيد */
            .confirmation-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }
            .confirmation-modal .modal-content {
                background: white;
                padding: 20px;
                border-radius: 15px;
                text-align: center;
                width: 400px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                position: relative;
            }


            .confirmation-modal .modal-content h3 {
                margin-bottom: 20px;
            }
            .confirmation-modal .modal-content button {
                padding: 10px;
                margin: 5px;
                width: 45%;
                border-radius: 5px;
                cursor: pointer;
                transition: background 0.3s ease;
                margin: 5px 35px; /* زيادة المسافة بين الزرين */
            }
            .confirmation-modal .modal-content .confirm-btn {
                background-color: #d32f2f;
                color: black;
                font-size: large;
                width: 100px;
            }
            .confirmation-modal .modal-content .cancel-btn {
                background-color:gold;
                color: black;
                font-size: large;
                width: 100px;
            }
            .confirmation-modal .modal-content button:hover {
                transform: scale(1.05);
            }
            .add-service-btn {
                position: absolute;
                top: 20px;
                right: 20px;
                background-color: #d22b2b;
                color: white;
                padding: 10px 20px;
                border-radius: 10px;
                font-weight: bold;
                display: flex;
                align-items: center;
                text-decoration: none;
                margin-top: 20px;
                transform: skew(-20deg);
                font-size: 20px;
                transition: transform 0.3s ease, background-color 0.3s ease;
            
            }


            .add-service-btn:hover {
                transform: skew(-20deg) scale(1.05);
                background-color: #b71c1c;
            }

            .add-service-btn::after {
                content: "+";
                font-size: 24px;
                margin-left: 10px;
            }
            .service-wrapper {
                margin-top: 50px;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
                justify-content: center;
                align-items: center;
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
                height: 500px;
                margin-bottom: 200px;
            }
            .custom-service {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 200px;
                height: 150px;
                background: linear-gradient(to bottom right, #960c09, #d61b15);
                color: white;
                font-size: 25px;
                font-weight: bold;
                text-decoration: none;
                border-radius: 10px;
                box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
                transition: 0.3s;
                border: 2px solid black;
                transform:skew(-20deg);
                background-size: 200% auto; 
                transition: background-position 0.5s ease; 
            }
            .custom-service:hover {
                background-position: right center; 
                
            }
        
            
            .box-title h1{
                margin-top: 200px;
                font-size: 50px;
                font-weight: bold;
                text-align: center;
            }




            .container-img {
                display: flex;
                flex-direction: row; /* النص على اليسار والصورة على اليمين */
                align-items: center;
                padding: 30px;
                border-radius: 15px;
                width: 100vw; /* بعرض الشاشة بالكامل */
                height: 600px; /* جعل الطول 4 أضعاف تقريبًا */
                margin-top: 100px; /* إضافة مسافة من الأعلى */
            }

            .text-content {
                flex: 1;
                padding-right: 40px; /* تعديل التباعد */
                text-align: left; /* محاذاة النص إلى اليسار */
            }

            .text-content h1 {
                color: red;
                font-size: 48px; /* تكبير حجم العنوان */
                font-weight: bold;
            }

            .text-content p {
                font-size: 24px; /* تكبير حجم النص */
                color: #333;
                line-height: 1.6;
            }

            /* حذف النجوم */
            .img-stars {
                display: none;
            }

            .image-container {
                position: relative;
                flex: 1.5; /* تكبير مساحة الصورة */
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgba(255, 255, 255, 0.1);
            }

            .red-background {
                position: absolute;
                width: 100%;
                height: 100%;
                clip-path: polygon(0 20%, 100% 0, 100% 100%, 0 80%);
                z-index: 0;
            }

            .worker-image {
                position: relative;
                width: 100%; /* تكبير الصورة أكثر */
                height: auto;
                z-index: 1;
                border-radius: 10px;
            }






            .container2 {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 700px;
            }

            .image-container {
                position: relative;
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                
            }

            .yellow-background {
                position: absolute;
                width: 400px;
                height: 350px;
                border-radius: 20px;
                z-index: 0;
                transform: rotate(-5deg);
            }

            .clock-image {
                position: relative;
                width:  90%; /* 100% هو الحجم الأصلي، زيد النسبة */;
                height: auto;
                z-index: 1;
                animation: shake 1.5s infinite ease-in-out;
            }

            .dots-pattern {
                position: absolute;
                left: -50px;
                top: -30px;
                width: 100px;
                height: 120px;
                background-size: 12px 12px;
                opacity: 0.6;
                z-index: 0;
            }

            .text-content {
                flex: 1;
                padding-left: 50px;
                text-align: left;
                margin-top: 50px;
            }

            .text-content h1 {
                color: red;
                font-size: 48px;
                font-weight: bold;
            }

            .text-content p {
                font-size: 22px;
                color: #333;
                line-height: 1.8;
            }

            /* حركة اهتزاز الساعة */
            @keyframes shake {
                0%, 100% { transform: rotate(0deg); }
                25% { transform: rotate(3deg); }
                50% { transform: rotate(-3deg); }
                75% { transform: rotate(3deg); }
            }
            /* Mobile Responsive Styles */
            @media (max-width: 767px) {
                /* General Structure */
                body {
                    background-size: cover;
                    padding: 0;
                    overflow-x: hidden;
                }
                
                header {
                    padding: 10px 15px;
                }
                
                .main-content {
                    padding: 0 15px;
                }
                
                /* Hero Section */
                .hero {
                    height: auto;
                    padding: 20px 0;
                }
                
                .content {
                    margin-bottom: 30px;
                    padding: 20px 15px;
                }
                
                .content h1 {
                    font-size: 28px;
                    margin-bottom: 10px;
                }
                
                .content p {
                    font-size: 18px;
                    margin-bottom: 20px;
                }
                
                /* Action Buttons */
                .action-buttons {
                    flex-direction: column;
                    gap: 15px;
                    padding: 20px 10px;
                
                }
                
                .search-box {
                    width: 100%;
                    max-width: 300px;
                    margin: 0 auto;
                }
                
                .search-input {
                    width: 100%;
                    font-size: 16px;
                }
                
                .emergency-button {
                    width: 100%;
                    max-width: 300px;
                    margin: 0 auto;
                    padding: 10px 20px;
                    justify-content: center;
                }
                
                /* Card Containers */
                .cards-container {
                    grid-template-columns: 1fr;
                    margin-top: 30px;
                    gap: 20px;
                }
                
                .card {
                    width: 100%;
                    max-width: 300px;
                    height: auto;
                    margin: 0 auto 20px;
                }
                
                .card .main-image {
                    height: 100px;
                }
                
                .profile-container {
                    top: 75px;
                }
                
                .card-content {
                    padding: 45px 10px 10px;
                }
                
                .card-content h3 {
                    font-size: 14px;
                }
                
                .card-info {
                    font-size: 12px;
                }
                
                .card-buttons .view-btn {
                    padding: 8px 0;
                    width: 100%;
                    font-size: 13px;
                }
                
                /* Service Wrapper */
                .box-title {
                    margin: 30px 15px;
                    text-align: center;
                }
                
                .service-wrapper {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 15px;
                    height: auto;
                    margin-top: 30px;
                    margin-bottom: 30px;
                    padding: 0 15px;
                }
                
                .custom-service {
                    height: 100px;
                    font-size: 16px;
                }
                
                /* Container Images Section */
                .container-img {
                    flex-direction: column;
                    height: auto;
                    padding: 20px 15px;
                    margin-top: 40px;
                }
                
                .text-content {
                    padding: 0 10px 20px;
                    text-align: center;
                    order: 2;
                }
                
                .text-content h1 {
                    font-size: 24px;
                    margin-bottom: 10px;
                }
                
                .text-content p {
                    font-size: 16px;
                }
                
                .image-container {
                    order: 1;
                    margin-bottom: 20px;
                }
                
                .worker-image {
                    width: 80%;
                    max-width: 250px;
                }
                
                /* Container2 Section */
                .container2 {
                    flex-direction: column;
                    width: 95%;
                    height: auto;
                    padding: 20px 0;
                    margin: 0 auto;
                }
                
                .yellow-background {
                    width: 250px;
                    height: 220px;
                }
                
                .clock-image {
                    width: 220px;
                }
                
                .dots-pattern {
                    display: none;
                }
                
                .container2 .text-content {
                    margin-top: 30px;
                    padding: 0 15px;
                    order: 2;
                }
                
                .container2 .image-container {
                    order: 1;
                    margin-bottom: 20px;
                }
                
                /* Confirmation Modal */
                .confirmation-modal .modal-content {
                    width: 90%;
                    max-width: 300px;
                    padding: 15px;
                }
                
                .confirmation-modal .modal-content button {
                    width: 100%;
                    margin: 5px 0;
                }
                
                /* Add Service Button */
                .add-service-btn {
                    position: relative;
                    top: 0;
                    right: 0;
                    margin: 20px auto;
                    display: block;
                    width: 200px;
                    text-align: center;
                    font-size: 16px;
                }
            }

</style>

</head>
<body>
<header>
    
        <?php include 'navbar.php'; ?>
        
        </header>
    <section class="hero">
        <div class="content">
          <h1>Hizmet Anında, Sorunlarında!</h1>
          <p>İhtiyacın olan acil hizmete hızla ulaş, işlerini anında çöz.</p>
      
          <div class="action-buttons">
            <div class="search-box">
              <div class="search-icon">
                <i class="fas fa-search"></i>
              </div>
              <input type="text" class="search-input" id="search-input" placeholder="Ara">
            </div>
        
            <a href="acil.php" class="emergency-button">
                <img src="img/33aykon.png" alt="icon" class="emergency-icon">
                <p>
                Acil servis
                </p>
                
              </a>
              
          </div>
        </div>
      </section>
      





   





    <div class="main-content">
        <div class="cards-container">
        <?php
        include '../action.php'; // Include your database connection file
            // Retrieve service and client data
            $query = $conn->prepare("
            SELECT 
                services.id AS service_id, 
                services.*, 
                clients.adi, 
                clients.soyadi, 
                clients.profile_image 
            FROM 
                services  
            INNER JOIN 
                clients ON services.client_id = clients.id
            ");
            $query->execute();
            $result = $query->get_result();
            // Loop through the results
            while ($row = $result->fetch_assoc()) {
                // Construct paths correctly
                $clientName = htmlspecialchars($row['adi'] . ' ' . $row['soyadi']);
                $clientImage = '../dashboard/' . htmlspecialchars($row['profile_image']);
                $serviceImage = '../dashboard/image/' . htmlspecialchars($row['profession_image']);
                $serviceName = htmlspecialchars($row['profession_name']);
                $serviceId = $row['service_id'];
        ?>
 
            <!-- بطاقة -->
            <div class="card" id="card-<?php echo $serviceId; ?>" data-search="<?php echo strtolower($serviceName . ' ' . $clientName); ?>">
                <img class="main-image" src="<?php echo $serviceImage ?>" alt="Eve Nakliyat">
                <div class="profile-container">
                    <img class="profile-image" src="<?php echo $clientImage ?>" alt="Profile">
                    <p class="name"><?php echo $clientName ?></p>
                </div>
                <div class="card-content">
                    <h3><?php echo $serviceName ?></h3>
                    <div class="card-info">
                    <span class="people">
  <img src="img/13aykon.png" alt="Users" class="icon-img"> 350
                    </span>
                        <span class="rating">
                        <img src="img/14aykon.png" alt="Rating Icon" class="icon-img">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="rating-value"></span>
                        </span>
                    </div>
                    <div class="card-buttons">
                      <a href="hizmet_detay.php?service_id=<?php echo $serviceId; ?>">  <button class="view-btn">Daha</button> </a>
                    </div>
                </div>
            </div>
                <?php   } ?>
        </div>
        <!-- زر عرض المزيد -->
        <div class="load-more-container">
            <button id="load-more-btn" class="load-more-btn">
                <p>Daha göster</p>
            </button>
        </div>
    </div>
    <div class="box-title">
    <h1>Çeşitli Hizmetlerimiz için</h1></div>
    <div class="service-wrapper">
        <a href="#cleaning-section" class="custom-service">Temizlik</a>
        <a href="#moving-section" class="custom-service">Taşıma</a>
        <a href="#repair-section" class="custom-service">Onarım</a>
        <a href="#private-lessons-section" class="custom-service">Özel Dersler</a>
        <a href="#health-section" class="custom-service">Sağlık</a>
        <a href="#organization-section" class="custom-service">Organizasyon</a>
        <a href="#other-section" class="custom-service">Diğer</a>
        <a href="#emergency-section" class="custom-service">Acil Durum</a>
    </div>


    <div class="container-img">
        <div class="text-content">
            <h1>Alacağın hizmetin kalitesini</h1>
            <p>Daha önce yapılan işlere dair gerçek müşteri yorumlarıyla değerlendirerek güvenle seçim yapabilirsin.</p>
            
        </div>
        <div class="image-container">
            <div class="red-background"></div>
            <img src="img/eleman.png" alt="Worker" class="worker-image">
        </div>
    </div>


    <div class="container2">
        <div class="image-container">
            <div class="yellow-background"></div>
            <img src="img/saat.png" alt="Çalar Saat" class="clock-image">
            <div class="dots-pattern"></div>
        </div>

        <div class="text-content">
            <h1>Vakit Kaybetme</h1>
            <p>
                İhtiyacın olan hizmet için mağaza mağaza gezmeye veya tanıdıklarından tavsiye almaya gerek yok.
                Teklifler ayağıنا gelsin, zamanını sevdiklerinle geçirebilirsin.
            </p>
        </div>
    </div>
    <footer>
        <?php  include 'footer.php';?>
        <?php includeFooter(); ?>
        </footer>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.card');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const searchInput = document.getElementById('search-input');
        let visibleCards = 16; // عدد البطاقات المرئية في البداية
        let filteredCards = Array.from(cards); // مصفوفة تحتوي على جميع البطاقات

        // دالة لإظهار البطاقات
        function showCards(cardsToShow, startIndex, count) {
            cards.forEach(card => card.classList.remove('visible')); // إخفاء جميع البطاقات
            for (let i = startIndex; i < Math.min(startIndex + count, cardsToShow.length); i++) {
                cardsToShow[i].classList.add('visible'); // إظهار البطاقات المطلوبة
            }
        }

        // إظهار أول 16 بطاقة عند تحميل الصفحة
        showCards(filteredCards, 0, visibleCards);

        // إخفاء زر "عرض المزيد" إذا كان عدد البطاقات 16 أو أقل
        if (filteredCards.length <= visibleCards) {
            loadMoreBtn.style.display = 'none';
        }

        // التعامل مع زر "عرض المزيد"
        loadMoreBtn.addEventListener('click', function () {
            visibleCards += 16; // زيادة عدد البطاقات المرئية بـ 16
            showCards(filteredCards, 0, visibleCards);

            // إخفاء الزر إذا تم إظهار جميع البطاقات
            if (visibleCards >= filteredCards.length) {
                loadMoreBtn.style.display = 'none';
            }
        });

        // التعامل مع البحث
        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.trim().toLowerCase();

            // تصفية البطاقات بناءً على النص
            filteredCards = Array.from(cards).filter(card => {
                const searchData = card.getAttribute('data-search');
                return searchData.includes(searchTerm);
            });

            // إعادة ضبط عدد البطاقات المرئية
            visibleCards = 16;
            showCards(filteredCards, 0, visibleCards);

            // تحديث زر "عرض المزيد"
            loadMoreBtn.style.display = filteredCards.length > visibleCards ? 'block' : 'none';
        });
    });
</script>
</html>