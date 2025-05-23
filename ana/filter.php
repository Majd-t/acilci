<?php
function render() {
    global $user;
    ?>


<?php
include('../action.php');

// إذا كان طلب AJAX لجلب التخصصات
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profession_id'])) {
    $profession_id = intval($_POST['profession_id']);
    $stmt = $conn->prepare("SELECT name FROM sub_professions WHERE profession_id = ?");
    $stmt->bind_param("i", $profession_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = '<option value="">Alanı seçin</option>';
    while ($row = $result->fetch_assoc()) {
        $name = htmlspecialchars($row['name']);
        $options .= "<option value=\"$name\">$name</option>"; 
    }
    echo $options;
    exit();
}

// جلب جميع المهن
$professions_result = $conn->query("SELECT id, name FROM professions");
$professions = $professions_result->fetch_all(MYSQLI_ASSOC);
?>

  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    .container {
    max-width: 1200px;
    margin-left: 120px;
    position:static; /* or absolute/fixed, depending on your layout */
    z-index: 1000; /* A high value to ensure it’s on top */
    margin-top: -90px ;
}

    h2 {
      text-align: center;
      color: #333;
      font-size: 24px;
      margin-bottom: 30px;
    }

    .select-container {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        background-color: #d10000;
        padding: 32px;
        border-radius: 15px; /* انحناء دائري قوي للزوايا */
        transform: skewX(-20deg); /* ميل واضح وكبير */
        transition: all 0.3s ease;
        overflow: hidden;
        }


    .select-box {
      position: relative;
      background-color: #f8f8f8;
      flex: 1;
      box-shadow: 0 5px 10px rgba(0,0,0,0.07);
      transform: skewX(-20deg); /* ميل واضح وكبير */
      border-radius: 15px; /* انحناء دائري قوي للزوايا */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 65px;
      margin: 0 0.5vw;
    }

    .select-box select {
      width: 100%;
      height: 100%;
      padding: 0 40px 0 10px;
      font-size: 1.6rem;
      transform: skewX(20deg); /* ميل واضح وكبير */

      font-weight: bold;
      color: #222;
      background: transparent;
      border: none;
      outline: none;
      appearance: none;
      text-align: center;
      font-family: inherit;
      cursor: pointer;
    }

    .select-box select option {
      color: #222;
      font-weight: bold;
      font-size: 1.2rem;
    }

    .select-box::after {
      content: "▼";
      font-size: 20px;
      color: #222;
      position: absolute;
      right: 24px;
      pointer-events: none;
      top: 50%;
      transform: translateY(-50%);
      font-weight: bold;
    }

    label {
      display: none;
    }

    @media (max-width: 768px) {
  .select-container {
    display: flex;
    flex-direction: column; /* جعل العناصر داخل الـ container تأخذ ترتيب عمودي */
    gap: 15px; /* المسافة بين العناصر */
    padding: 20px; /* المسافة الداخلية */
    clip-path: none; /* إزالة أي قص للحواف */
    border-radius: 15px; /* تدوير الحواف */
    transform: skewX(0deg); /* إزالة الميل */
    width: 2000px;
        max-width: 200%;
 /* تأكد من عدم تجاوز الـ container العرض الكامل */
    height: auto; /* الارتفاع تلقائي حسب المحتوى */
    margin-left: -110px;
  }

  .select-box {
    clip-path: none;
    border-radius: 15px; /* تدوير الزوايا */
    margin: 0;
    padding: 20px 10px; /* المسافة الداخلية داخل الزر */
    /* إزالة الميل */
    width: 100%; /* جعل الزر يتناسب مع العرض */
    max-width: 1000px; /* تأكد من عدم تجاوز الزر العرض المحدد */
    height: 50px; /* تحديد ارتفاع الزر */
    font-size: 16px; /* تحديد حجم الخط داخل الزر */
    
    
  }

  .select-box::after {
    right: 10px; /* تحديد المسافة من الجهة اليمنى */
  }

  /* التحكم بالنص داخل الزر أو الـ container */
  .select-box p {
    font-size: 1px; /* تحديد حجم الخط داخل النص */
    line-height: 1.5; /* تحديد تباعد الأسطر */
    text-align: center; /* محاذاة النص في المنتصف */
    margin: 0; /* إزالة الهوامش الخارجية */
    
  }
}
  </style>
</head>
<body>
  <div class="container">
    <input type="hidden" name="profession_name_text" id="profession_name_text">

    <div class="select-container">
     
      <div class="select-box">
        <label for="profession_id">Hizmeti Seçiniz:</label>
        <select id="profession_id" onchange="updateProfessionName(this)">
          <option value="">Hizmet</option>
          <?php foreach ($professions as $profession): ?>
            <option value="<?= $profession['id'] ?>" data-name="<?= htmlspecialchars($profession['name']) ?>">
              <?= htmlspecialchars($profession['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="select-box">
        <label for="sub_profession_id">Hizmet Alanını Seçiniz:</label>
        <select id="sub_profession_id">
          <option value="">Alanlar</option>
        </select>
      </div>
      <div class="select-box">
        <label for="Iller">İl Seçiniz:</label>
        <select id="Iller">
          <option value="0">İl</option>
        </select>
      </div>
      <div class="select-box">
        <label for="Ilceler">İlçe Seçiniz:</label>
        <select id="Ilceler" disabled="disabled">
          <option value="0">İlçe</option>
        </select>
      </div>



    </div>
  </div>
</body>
</html>

<script src="il.js" defer></script> <!-- ربط السكربت -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 


<script>
        function updateProfessionName(select) {
            const name = select.options[select.selectedIndex].dataset.name || "";
            document.getElementById('profession_name_text').value = name;

            const id = select.value;
            if (!id) {
                document.getElementById("sub_profession_id").innerHTML = '<option value="">hizmeti seçiniz</option>';
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = () => {
                if (xhr.status === 200) {
                    document.getElementById("sub_profession_id").innerHTML = xhr.responseText;
                }
            };
            xhr.send("profession_id=" + encodeURIComponent(id));
        }
    </script>


<?php
}
?>


