<?php include "../action.php"; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="first-style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <title>Document</title>
  <style>
    * { 
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f5f5f5;
      min-height: 100vh;
    }

    header {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 50px;
      background: transparent;
      position: absolute;
      width: 100%;
      margin-top: 32px;
      z-index: 10;
    }

    /* قسم الصورة الرئيسية */
    .hero-section {
      position: relative;
      width: 100%;
      height: 400px;
      background: url(img/kapak\ fotoler.png) no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 0;
      height: 100vh;
    }

    .title1 {
      position: absolute;
    bottom: 130px; /* المسافة من الأسفل - يمكن تعديلها */
    left: 50%; /* الموقع من اليسار - يمكن تعديله */
    transform: translateX(-50%);
    text-align: center;
    color: #f5f5f5;
    font-size: 50px; /* حجم الخط - يمكن تعديله */
    margin-right: 50px;
    }

    .title1 h2 {
      color: #f5f5f5;
      font-size: 50px;
    }
    .section-wrapper {
    width: 90%;           /* تحكم بالعرض */
    height: 10%;   
      /* تحكم بالطول */
      margin: 50px auto 10px 10px; /* لتقليل المسافة من الأسفل وزيادة المسافة من الأعلى */
      margin-top: 70px;
  padding: 40px;
  /* بتوسّط العنصر أفقياً وبتعطيه مسافة من فوق */

}
    /* حاوية البحث */
    .search-wrapper {
      display: flex;
      justify-content: center;
      margin: 20px 0;
      background-color: #f5f5f5;
      padding: 20px;
    }

    .search-container {
      display: flex;
      width: 500px;
      height: 60px;
      overflow: hidden;
      border-radius: 15px;
      transform: skew(-20deg);
      box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.2);
      border: 1px solid black;
    }

    .search-icon {
      background-color: #111;
      color: white;
      width: 80px;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
    }

    .search-icon i {
      transform: skew(20deg);
    }

    .search-input {
      flex: 1;
      border: none;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 0 20px;
      font-size: 18px;
      font-weight: bold;
      color: #333;
      outline: none;
    }

    .search-input::placeholder {
      color: #aaa;
      font-weight: normal;
      transform: skew(20deg);
      display: inline-block;
    }

    /* حاوية البطاقات */
    .cards-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      justify-items: center;
      max-width: 1200px;
      margin: 50px auto;
      background-color: #f5f5f5;
      padding: 20px;
    }

    .card {
      width: 260px;
      height: 310px;
      border: 2px solid #00000050;
      border-radius: 15px;
      overflow: hidden;
      background: linear-gradient(180deg, #f5f5f5 70%, #f9f9f9 100%);
      position: relative;
      text-align: center;
      display: none; /* مخفي افتراضيًا */
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
      gap: 1px;
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
      display: flex;
      justify-content: center;
      margin-top: 15px;
      gap: 5px;
    }

    .card-buttons .view-btn,
    .card-buttons .ara-btn {
      padding: 10px;
      width: 110px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      line-height: 1; /* تقليل ارتفاع الخط لرفع النص */
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }

    .view-btn {
      background-color: #fabc05;
      color: white;
    }
 

    .view-btn:hover {
      background-color: #fabc05;
    }

   .ara-btn {
    background-color: #a2110d;
    color: white;
    display: flex;
    align-items: center;
    gap: 15px; /* مسافة بين الأيقونة والنص */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    font-family: inherit;
    transition: background-color 0.3s ease;
    text-decoration: none;
}
.btn{
  text-decoration: none;
}

.ara-btn:hover {
    background-color: #c0392b;
    text-decoration: none;
}

.icon-img {
    width: 20px;
    height: 20px;
    display: block;
}

    

    /* زر عرض المزيد */
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
    /* زر حساب المسافة */
    .distance-btn-container {
      text-align: center;
      margin: 20px 0;
      background-color: #f5f5f5;
      padding: 20px;
    }

    .tooltip-container {
      cursor: pointer;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
    }

    /* مساحة الفوتر */
    .footer-space {
      height: 100px;
      width: 100%;
      clear: both;
      background-color: #f5f5f5;
    }

    /* Media Query للشاشات الصغيرة */
    @media screen and (max-width: 767px) {
      .hero-section {
        height: 300px;
      }

      .title1 h2 {
        font-size: 28px;
      }

      .search-container {
        width: 90%;
        height: 50px;
        transform: skew(-20deg);
      }

      .search-input {
        font-size: 16px;
        padding: 0 10px;
      }

      .search-icon {
        width: 60px;
      }

      .cards-container {
        grid-template-columns: 1fr;
        margin: 20px auto;
      }

      .card {
        width: 100%;
        max-width: 280px;
      }

      .card-buttons {
        justify-content: space-between;
      }

      .ara-btn, .view-btn {
        width: 48%;
        padding: 8px 0;
        font-size: 13px;
      }
    }

        /* متغيرات CSS لتسهيل تعديل حجم الصور */
        :root {
      --circle-image-size: 75px; /* حجم الصورة في الدائرة */
      --rectangle-image-size: 75px; /* حجم الصورة في المستطيل */
    }

    /* تنسيق حاوية الزر */
    .distance-btn-container {
      position: fixed; /* جعل الزر ثابتًا */
      bottom: 20px; /* المسافة من الأسفل */
      right: 20px; /* المسافة من اليمين (الزاوية اليمنى) */
      z-index: 1000; /* لضمان ظهور الزر فوق العناصر الأخرى */
      background: none; /* إزالة الخلفية */
      padding: 0; /* إزالة الحشوة */
      margin: 0; /* إزالة الهوامش */
    }

    /* تنسيق الزر */
    .tooltip-container {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 60px; /* عرض الزر الدائري */
      height: 60px; /* ارتفاع الزر الدائري */
      background-color: #cb1813; /* لون أحمر */
      border: none; /* إزالة الحدود */
      border-radius: 50%; /* شكل دائري */
      font-size: 0; /* إخفاء النص افتراضيًا */
      font-weight: bold; /* وزن الخط */
      cursor: pointer; /* مؤشر الماوس */
      transition: width 0.3s ease, border-radius 0.3s ease, font-size 0.3s ease, color 0.3s ease, transform 0.3s ease; /* تأثيرات التحويل */
      text-align: center;
      text-decoration: none; /* إزالة أي تنسيق نص إضافي */
    }

    /* تأثير عند الوقوف على الزر */
    .tooltip-container:hover {
      width: 250px; /* عرض المستطيل أكبر */
      height: 60px; /* نفس ارتفاع الدائرة */
      border-radius: 30px; /* زوايا منحنية جدًا (شبه دائرية) */
      background-color: #cb1813; /* لون أحمر داكن عند الـ hover */
      color: white; /* إظهار النص باللون الأبيض */
      font-size: 14px; /* حجم النص */
      transform: translateY(0px); /* رفع الزر قليلاً */
      justify-content: flex-start; /* محاذاة المحتوى إلى اليمين */
      padding-left: 30px; /* مسافة للنص من الصورة */
    }

    /* الصورة داخل الدائرة */
    .tooltip-container::before {
      content: ""; /* لا نص افتراضيًا */
      position: absolute;
      right: -7px; /* وضع الصورة في يمين الدائرة */
      width: var(--circle-image-size); /* حجم الصورة في الدائرة */
      height: var(--circle-image-size); /* حجم الصورة في الدائرة */
      background-image: url('img/4aykon.png'); /* أيقونة موقع للدائرة */
      background-size: cover; /* تغطية الصورة */
      background-position: center;
      transition: opacity 0.3s ease, background-image 0.3s ease, width 0.3s ease, height 0.3s ease; /* تأثيرات التحول */
    }

    /* إخفاء الصورة الدائرية وإظهار النص عند الـ hover */
    .tooltip-container:hover::before {
      content: "Konumunu Seç"; /* النص الجديد */
      position: static; /* إزالة التموضع المطلق */
      width: auto; /* إزالة حجم الصورة */
      height: auto; /* إزالة حجم الصورة */
      background-image: none; /* إزالة الصورة */
      font-size: 20px; /* حجم النص */
        text-align:left; /* محاذاة النص إلى المنتصف */
      color: white; /* لون النص */
      font-weight: bold; /* وزن النص */
    }

    /* صورة إضافية داخل المستطيل عند الـ hover */
    .tooltip-container::after {
      content: ""; /* لا محتوى افتراضيًا */
      position: absolute;
      right: -7px; /* وضع الصورة في يمين المستطيل (نفس مكان صورة الدائرة) */
      width: var(--rectangle-image-size); /* حجم الصورة في المستطيل */
      height: var(--rectangle-image-size); /* حجم الصورة في المستطيل */
      background-image: none; /* لا صورة افتراضيًا */
      background-size: cover; /* تغطية الصورة */
      background-position: center;
      opacity: 0; /* مخفي افتراضيًا */
      transition: opacity 0.3s ease; /* تأثير الظهور */
    }

    .tooltip-container:hover::after {
      background-image: url('img/_Acılci\ -\ icons\ \(13\).png'); /* نفس أيقونة الدائرة للمستطيل */
      opacity: 1; /* إظهار الصورة */
    }

    /* Media Query للشاشات الصغيرة */
    @media screen and (max-width: 767px) {
      .distance-btn-container {
        bottom: 10px; /* تقليل المسافة من الأسفل */
        right: 10px; /* تقليل المسافة من اليمين */
      }

      .tooltip-container {
        width: 50px; /* تصغير الزر الدائري */
        height: 50px; /* تصغير الزر الدائري */
      }

      .tooltip-container:hover {
        width: 140px; /* تصغير عرض المستطيل */
        height: 50px; /* نفس ارتفاع الدائرة */
        border-radius: 25px; /* زوايا منحنية أقل قليلاً */
        font-size: 12px; /* تصغير النص */
        padding-left: 40px; /* تقليل المسافة */
      }

      .tooltip-container::before,
      .tooltip-container::after {
        width: calc(var(--circle-image-size) * 0.8); /* تصغير الصورة بنسبة 80% */
        height: calc(var(--circle-image-size) * 0.8); /* تصغير الصورة بنسبة 80% */
        right: 10px; /* تقليل المسافة من اليمين */
      }
    }
  </style>
</head>

<body>
  <!-- قسم الصورة الرئيسية مع العنوان -->
  <section class="hero-section">
    <header>
    <?php include 'navbar.php'; ?>
    </header>
    <div class="title1">
      <h2>Acil servis hemen alın</h2>
    </div>
  </section>
  <div class="section-wrapper">


<!-- هون بنستدعي القسم -->
<?php include 'filter.php';
render() ?>


</div>
  <!-- خانة البحث -->
  <div class="search-wrapper">
    <div class="search-container">
      <div class="search-icon">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
      <input type="text" placeholder="Ara" class="search-input" id="search-input" />
    </div>
  </div>

  <!-- زر حساب المسافة -->
  <div class="distance-btn-container">
    <button id="calculate-distance-btn" class="tooltip-container"></button>
  </div>

  <!-- البطاقات -->
  <div class="cards-container">
    <?php
    $query = $conn->prepare("
        SELECT 
            services.id AS service_id, 
            services.*, 
            clients.adi, 
            clients.soyadi, 
            clients.profile_image,
            clients.konum
        FROM services
        INNER JOIN clients ON services.client_id = clients.id
    ");
    $query->execute();
    $result = $query->get_result();

    while ($row = $result->fetch_assoc()) {
        if ($row['urgent_service'] != 1) continue;

        $clientName = htmlspecialchars($row['adi'] . ' ' . $row['soyadi']);
        $clientImage = '../dashboard/' . htmlspecialchars($row['profile_image']);
        $serviceImage = '../dashboard/image/' . htmlspecialchars($row['profession_image']);
        $serviceName = htmlspecialchars($row['profession_name']);
        $serviceId = $row['service_id'];
        $clientKonum = htmlspecialchars($row['konum']);
    ?>
    <div class="card" id="card-<?php echo $serviceId ?>" data-latlong="<?php echo $clientKonum ?>" data-search="<?php echo strtolower($serviceName . ' ' . $clientName); ?>">
      <img class="main-image" src="<?php echo $serviceImage ?>" alt="service">
      <div class="profile-container">
        <img class="profile-image" src="<?php echo $clientImage ?>" alt="Profile">
        <p class="name" id="client-name-<?php echo $serviceId ?>"><?php echo $clientName ?></p>
      </div>
      <div class="card-content">
        <h3><?php echo $serviceName ?></h3>
        <div class="card-info">
          <img src="img/_Acılci - icons (12).png" style="width:25px; height:25px; margin-left:5px;">
          <span class="people">
            <div class="distance-container"></div>
            <img src="img/13aykon.png" style="width:25px; height:25px; margin-left:5px;">
            <span style="color: black;">300</span>
          </span>
          <span class="rating">
            <img src="img/14aykon.png" style="width:25px; height:25px;">
            <i class="fas fa-star"></i><i class="fas fa-star"></i>
            <i class="fas fa-star"></i><i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </span>
        </div>
        <div class="card-buttons" >
          <a href="hizmet_detay_acil.php?service_id=<?php echo $serviceId; ?>" class="btn">
         <button class="ara-btn">
                            <img src="img/15aykon.png" alt="اتصال" style="width:16px; height:16px; margin-left:5px;">
                            Ara
                        </button> </a>
          <a href="hizmet_detay_acil.php?service_id=<?php echo $serviceId; ?>" class="view-btn">Daha</a>
          
        </div>
      </div>
    </div>
    <?php } ?>
  </div>

  <!-- زر عرض المزيد -->
  <div class="load-more-container">
    <button id="load-more-btn" class="load-more-btn">
      <p> Daha göster</p>
     
    </button>
  </div>

  <div class="footer-space"></div>
  <footer>
        <?php  include 'footer.php';?>
        <?php includeFooter(); ?>
        </footer>
  <script>
   document.addEventListener('DOMContentLoaded', function () {
  const cards = document.querySelectorAll('.card');
  const loadMoreBtn = document.getElementById('load-more-btn');
  const searchInput = document.getElementById('search-input');
  let visibleCards = 16;
  let filteredCards = Array.from(cards);

  // دالة لإظهار البطاقات بناءً على الفلتر
  function showCards(cardsToShow, startIndex, count) {
    cards.forEach(card => card.classList.remove('visible'));
    for (let i = startIndex; i < Math.min(startIndex + count, cardsToShow.length); i++) {
      cardsToShow[i].classList.add('visible');
    }
  }

  // إظهار أول 16 بطاقة افتراضيًا
  showCards(filteredCards, 0, visibleCards);

  // إخفاء زر "عرض المزيد" إذا كان عدد البطاقات 16 أو أقل
  if (filteredCards.length <= visibleCards) {
    loadMoreBtn.style.display = 'none';
  }

  // التعامل مع زر "عرض المزيد"
  loadMoreBtn.addEventListener('click', function () {
    const nextCards = visibleCards + 4;
    showCards(filteredCards, 0, nextCards);
    visibleCards = nextCards;

    // إخفاء الزر إذا تم إظهار جميع البطاقات
    if (visibleCards >= filteredCards.length) {
      loadMoreBtn.style.display = 'none';
    }
  });

  // التعامل مع البحث أثناء الكتابة
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

  // كود حساب المسافة وترتيب البطاقات
  const calculateButton = document.getElementById('calculate-distance-btn');

  calculateButton.addEventListener('click', function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        const userLat = position.coords.latitude;
        const userLon = position.coords.longitude;

        // مصفوفة لتخزين البطاقات مع المسافات
        let cardDistances = [];

        // حساب المسافة لكل بطاقة
        cards.forEach(function (card) {
          const latlongStr = card.getAttribute('data-latlong');
          if (!latlongStr) return;

          const [clientLat, clientLon] = latlongStr.split(',').map(parseFloat);

          if (isNaN(clientLat) || isNaN(clientLon)) {
            console.warn('Geçersiz koordinatlar:', latlongStr);
            return;
          }

          const R = 6371; // نصف قطر الأرض
          const dLat = (clientLat - userLat) * Math.PI / 180;
          const dLon = (clientLon - userLon) * Math.PI / 180;
          const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(userLat * Math.PI / 180) * Math.cos(clientLat * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
          const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
          const distance = R * c;

          // تحديث عنصر المسافة في البطاقة
          const distanceElement = card.querySelector('.distance-container');
          distanceElement.innerHTML = ` ${distance.toFixed(2)}km`;

          // تخزين البطاقة مع المسافة
          cardDistances.push({ card, distance });
        });

        // ترتيب البطاقات بناءً على المسافة (من الأقصر إلى الأطول)
        cardDistances.sort((a, b) => a.distance - b.distance);

        // تحديث ترتيب البطاقات في DOM
        const cardsContainer = document.querySelector('.cards-container');
        cardsContainer.innerHTML = ''; // إفراغ الحاوية
        cardDistances.forEach(({ card }) => {
          cardsContainer.appendChild(card); // إضافة البطاقات بالترتيب
        });

        // تحديث filteredCards لتعكس الترتيب الجديد
        filteredCards = cardDistances.map(item => item.card);

        // إعادة إظهار البطاقات بناءً على الترتيب الجديد
        visibleCards = 16;
        showCards(filteredCards, 0, visibleCards);

        // تحديث زر "عرض المزيد"
        loadMoreBtn.style.display = filteredCards.length > visibleCards ? 'block' : 'none';

        alert("Konumunuz başarıyla belirlendi ve kartlar mesafeye göre sıralandı. ✅");
      }, function (error) {
        alert("Konum belirleme başarısız oldu: ❌" + error.message);
      });
    } else {
      alert("Tarayıcı konum belirlemeyi desteklemiyor. ❌");
    }
  });
});
</script>
</body>
</html>