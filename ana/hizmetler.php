<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hizmetPage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="birinci-style.css">

<style>
                    * {
                margin: 0;
                padding: 0;
                max-width: 100%;
                box-sizing: border-box;
                font-family: Arial, sans-serif;

            }

            body {
                background: url(img/kapak33.png) no-repeat center center/cover;
                background-color: #f5f5f5;
                height: 100vh;
                overflow-x: hidden;
                width: 100%;
                position: relative;
                margin: 0;
                padding: 0;
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
            .section-wrapper {
                width: 90%;           /* تحكم بالعرض */
                height: 50%;   
                /* تحكم بالطول */
                margin: -100px auto 0; /* لتقليل المسافة من الأسفل وزيادة المسافة من الأعلى */
                margin-bottom: -400px;
                    padding: 40px;
            
            
            /* بتوسّط العنصر أفقياً وبتعطيه مسافة من فوق */

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
                font-size: 60px;
                font-weight: bold;
                color: white;
                text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
                margin-top: -150px;
            }


            .action-buttons {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                padding: 40px;
            }

            .search-container {
                display: flex;
                position: relative;
                width: 500px; /* عرض الحاوية - يمكن تعديله */
                height: 60px; /* ارتفاع الحاوية - يمكن تعديله */
                overflow: hidden;
                border-radius: 15px; /* تدوير الزوايا الخارجية */
                transform: translateX(-50%) skew(-20deg); /* لمحاذاة القسم في المنتصف */
                box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.2); /* الظل */
                position: absolute; /* لجعل قسم البحث يطفو فوق الصفحة */
                bottom: 10%; /* المسافة من الأسفل - يمكن تعديلها */
                left: 50%; /* من اليسار */
                border: 1px solid black; /* الإطار الرفيع الأسود */
            }

            .search-icon {
                background-color: #111; /* لون خلفية الزر - أسود */
                color: white;
                width: 80px; /* عرض زر البحث - يمكن تعديله */
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
                position: relative;
            }

            .search-icon i {
                transform: skew(20deg); /* إرجاع الأيقونة لوضعها الطبيعي بعد الانحناء */
            }

            .search-input {
                flex: 1;
                border: none;
                background-color: rgba(255, 255, 255, 0.9); /* خلفية بيضاء شفافة جداً */
                padding: 0 20px; /* المسافة الداخلية - يمكن تعديلها */
                font-size: 18px;
                font-weight: bold;
                color: #333;
                outline: none;
            }

            .search-input::placeholder {
                color: #aaa;
                font-weight: normal;
                transform: skew(20deg); /* إرجاع النص لوضعه الطبيعي بعد الانحناء */
                display: inline-block;
            }

            .search-input-text {
                transform: skew(20deg);
                display: inline-block;
            }

            .load-more-container .view-btn {
                padding: 10px 25px;
                background: linear-gradient(45deg, #4caf50, #81c784);
                color: white;
                border-radius: 8px;
                font-size: 16px;
                font-weight: bold;
                border: none;
                cursor: pointer;
                transition: 0.3s;
            }
            .load-more-container .view-btn:hover {
                transform: scale(1.05);
                background: linear-gradient(45deg, #81c784, #4caf50);
            }

            .main-content {
                flex: 1;
                padding:0 150px
            
            
            }
            .cards-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); /* Responsive */
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
                padding: 55px 15px 10px;
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
                color: #f5c518;
                animation: sparkle 1.5s infinite;
            }

            .card-info .rating .rating-value {
                margin-left: 4px;
                font-size: 13px;
                color: #333;
                font-weight: 600;
            }

            .card-buttons {
                margin-top: 20px;
            }

            .card-buttons .view-btn,
            .card-buttons .delete-btn {
                padding: 10px 0;
                width: 90%;
                border: none;
                border-radius: 5px;
                background: linear-gradient(45deg, #f5c518, #ffeb3b);
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
            .load-more-container {
      text-align: center;
      margin: 20px 0;
      background-color: #f5f5f5;
      padding: 20px;
    }
    .load-more-btn {
      cursor: pointer;
      padding: 15px 48px;
      transform: skew(-30deg);
      
      background: linear-gradient(to bottom right, #960c09, #d61b15); /* التدرج من أعلى يمين لأسفل يسار */
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .load-more-btn:hover {
      background-color: #0056b3;
    }
    .load-more-btn p {
      transform: skew(30deg);
    }

            @media screen and (max-width: 767px) {
                /* Background image adjustment */
                body {
                    background-size: cover;
                    background-position: top center;
                }
                
                /* Header adjustments */
                header {
                    padding: 10px 15px;
                }
                
                /* Hero section adjustments */
                .hero {
                    height: auto;
                    min-height: 50vh;
                }
                
                .content {
                    padding: 15px;
                    margin-bottom: 60px;
                }
                
                .content h1 {
                    font-size: 32px;
                    margin-top: -80px;
                }
                
                /* Search container adjustments */
                .search-container {
                    width: 90%;
                    height: 50px;
                    bottom: auto;
                    position: relative;
                    margin: 20px auto;
                    transform: skew(-20deg);
                    left: 0;
                }
                
                .search-icon {
                    width: 50px;
                }
                
                .search-input {
                    font-size: 16px;
                    padding: 0 10px;
                }
                
                /* Section wrapper adjustments */
                .section-wrapper {
                    width: 100%;
                    height: auto;
                    padding: 15px;
                    margin-top: 0;
                    margin-bottom: 0;
                }
                
                /* Main content adjustments */
                .main-content {
                    padding: 0 15px;
                }
                
                /* Cards container adjustments */
                .cards-container {
                    grid-template-columns: 1fr;
                    margin-top: 30px;
                }
                
                /* Card adjustments */
                .card {
                    width: 100%;
                    max-width: 280px;
                }
                
                /* Action buttons adjustments */
                .action-buttons {
                    flex-direction: column;
                    padding: 20px 10px;
                    gap: 15px;
                }
                
                /* Fix search container inside action buttons */
                .action-buttons .search-container {
                    position: relative;
                    transform: skew(-20deg);
                    left: 0;
                    width: 100%;
                }
                
                /* Card buttons adjustments */
                .card-buttons .view-btn {
                    width: 80%;
                }
                
                /* Adjust footer space */
                footer {
                    margin-top: 30px;
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
          <div class="action-buttons">
          <!-- حاوية البحث - يمكن تعديل الحجم والموضع من خلال class "search-container" في CSS -->

        <div class="search-container">
            <div class="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="text" placeholder="Ara" class="search-input" id="search-input">
        </div>
  
            </div>
            </section>
            <div class="section-wrapper">


</div>
<?php include 'filter.php'; 
            render()?>
            <div class="main-content">
                
         
                <div class="cards-container">
                <?php
                include "../action.php";
        // Retrieve service and client data
        $query = $conn->prepare("
        SELECT 
            services.id AS service_id, 
            services.*, 
            clients.adi, 
            clients.soyadi, 
            clients.profile_image,
            clients.il,
            clients.ilce
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
            $professionName = htmlspecialchars($row['profession_name']);
            $subProfessionName = htmlspecialchars($row['profession_n']);
    ?>
                    <!-- بطاقة 1 -->
                    <div class="card service-card" id="card-1" data-profession="<?php echo $professionName; ?>" data-sub-profession="<?php echo $subProfessionName; ?>">

                        
                        <img class="main-image" src="<?php echo $serviceImage?>" alt="Eve Nakliyat">
                        <div class="profile-container">
                            <img class="profile-image" src="<?php echo $clientImage?>" alt="Profile">
                            <p class="name"><?php echo $clientName?></p>
                        </div>
                        <div class="card-content">
                            <h3><?php echo $serviceName?></h3>
                            <div class="card-info">
                                <span class="people"><i class="fas fa-users"></i> 350</span>
                                <span class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span class="rating-value">4/5</span>
                                </span>
                            </div>
                            <div class="card-buttons">
                              <a href="hizmet_detay.php?service_id=<?php echo $serviceId; ?>"> <button class="view-btn">Daha</button> </a> 

                            </div>
                        </div>
                    </div>
                    <?php  } ?>

        
                </div>
            </div>
            <div class="load-more-container">
     <button id="load-more-btn" class="load-more-btn">
      <p> Daha göster</p>
     
    </button>
  </div>

            <div style="height: 60px;"></div>
            <footer>
    <?php  include 'footer.php';?>
    <?php includeFooter(); ?>
    </footer>
</body>
</html>

<script>
    const searchInput = document.getElementById('search-input');
    const cards = document.querySelectorAll('.card');

    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();

        cards.forEach(card => {
            const cardText = card.innerText.toLowerCase();
            if (cardText.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".service-card");
        const loadMoreBtn = document.getElementById("load-more-btn");
        let cardsPerPage = 16;
        let currentIndex = 0;

        function showCards() {
            for (let i = currentIndex; i < currentIndex + cardsPerPage; i++) {
                if (cards[i]) {
                    cards[i].style.display = "block";
                }
            }
            currentIndex += cardsPerPage;

            if (currentIndex >= cards.length) {
                loadMoreBtn.style.display = "none";
            }
        }

        // في البداية نخفي كل البطاقات
        cards.forEach(card => card.style.display = "none");

        // نعرض أول مجموعة
        showCards();

        // عند الضغط على الزر نعرض المزيد
        loadMoreBtn.addEventListener("click", showCards);
    });
</script>

<div id="no-results" style="display:none; text-align:center; font-weight:bold; margin-top:20px;">
  لا توجد نتائج
</div>


