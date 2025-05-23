<?php
// إعدادات الاتصال بقاعدة البيانات (مفترض أنها في action.php)
include '../action.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../register/login.php");
    exit();
}

// استعلام لجلب البيانات من جدول clients مع بيانات من جدول services باستخدام JOIN
$sql = "SELECT c.adi, c.soyadi, c.profile_image, s.profession_name, s.profession_n 
        FROM clients c 
        LEFT JOIN services s ON c.id = s.client_id";
$result = $conn->query($sql);

// استعلام لجلب البيانات من جدول users
$sq = "SELECT adi, soyadi,profile_image FROM users";
$use = $conn->query($sq);

// إغلاق الاتصال
$conn->close();
?>

<?php require_once 'sidebar_include.php'; ?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acilci - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            text-decoration: none;
        }

        body {
            display: flex;
            background-color: #f5f5f5;
            min-height: 100vh;
        }
        

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 360px;
            height: 100vh;
            background-color: #d81c1c;
            overflow: hidden;
            z-index: 100;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 0 30px 30px 0;
        }

        .main-content {
            margin-left: 360px;
            padding: 40px;
            width: calc(100% - 360px);
            max-width: 1600px;
            box-sizing: border-box;
            text-decoration: none;
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            width: 100%;
        }

        .stat-box {
            background-color: white;
            border-radius: 15px;
            width: 31%;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 42px;
            font-weight: bold;
            color: #d21f1f;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #666;
        }

        .stat-box:nth-child(2) .stat-number {
            font-size: 42px;
        }

        .stat-box:nth-child(2) .stat-label {
            font-size: 18px;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            background-color: #f5f5f5;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ddd;
        }

        .stat-icon svg {
            width: 40px;
            height: 40px;
            fill: #888;
        }

        .search-bar {
            display: flex;
            margin-bottom: 30px;
            width: 66%;
            position: relative;
        }

        .search-bar input {
            flex: 1;
            padding: 12px 20px 12px 50px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #888;
            background-color: #ddd;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-icon svg {
            width: 14px;
            height: 14px;
            fill: #666;
        }

       
        .table-row .service-type{
            margin-left: 130px;
            
        }

    

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        .table-title {
            font-size: 18px;
            font-weight: bold;
        }

        .table-titl {
            font-size: 15px;
            font-weight: bold;
        }

        .table-tit {
            font-size: 15px;
            font-weight: bold;
            margin-right: 240px;
        }

        .view-all {
            background-color: #ffd54f;
            color: #333;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
        }

        .table-content {
            padding: 0 20px;
        }

        .table-columns {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            font-weight: bold;
        }

        .table-columns .col {
            flex: 1;
        }

        .table-row {
            display: flex;
            padding: 15px 10px;
            border-bottom: 1px solid #f5f5f5;
            align-items: center;
            background-color: transparent;
            margin: 8px 0;
            border-radius: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .table-row:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .table-row:nth-child(odd) {
            background-color: transparent;
        }

        .table-row:nth-child(odd):hover {
            background-color: #f5f5f5;
        }

        .table-row .col {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            background-color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #d81c1c;
        }

        .user-name {
            font-size: 16px;
            font-weight: 500;
        }


        .no-results {
            text-align: center;
            color: #666;
            padding: 20px;
        }

        /* ... (الجزء الأول من CSS يبقى كما هو حتى .data-tables) ... */

        .data-tables {
            display: flex; /* تأكيد استخدام Flexbox */
            justify-content: space-between; /* توزيع المسافة بين الجداول */
            width: 100%; /* تأكيد أن الجداول تملأ العرض الكامل */
            gap: 25px; /* مسافة بين الجداول */
        }

        .data-table {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            width: 67.5%; /* جدول أعرض على اليسار */
        }

        .user-table {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            width: 32.5%; /* جدول أضيق على اليمين */
        }

        /* ... (باقي CSS يبقى كما هو حتى @media) ... */

        @media screen and (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .stats-container {
                flex-direction: column;
                gap: 10px;
                padding: 40px 40px 0px 40px;
            }

            .stat-box {
                width: 100%;
            }

            .search-bar {
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            .table-header, .table-content {
                padding: 10px;
            }

            .table-row {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }

            .table-row .col {
                width: 100%;
                justify-content: flex-start;
            }

            .main-content {
                padding: 10px;
            }

            /* التعديل لجعل الجداول تحت بعضها في وضعية الهاتف */
            .data-tables {
                flex-direction: column; /* تحويل الجداول إلى عمودي */
                width: 100%;
                gap: 20px; /* إضافة مسافة بين الجداول */
                margin: 0;
                padding: 0;
            }

            .data-table, .user-table {
                width: 100%; /* جعل كل جدول يملأ العرض الكامل */
                margin-bottom: 20px; /* مسافة بين الجداول */
                box-shadow: none; /* إزالة الظل إذا لزم الأمر */
            }

            .table-header {
                padding: 10px 15px;
            }

            .table-content {
                padding: 0 15px 15px;
            }

            .table-row, .table-columns {
                padding: 10px 0;
            }

            .table-row:hover {
                transform: none;
                box-shadow: none;
                background-color: #f9f9f9;
            }

        .table-row .service-type {
           
            display: flex;
            align-items: center;
            margin-left: 100px;
        }
       
        .data-table .table-titl, .data-table .table-tit {
        margin: 0; /* إزالة أي هوامش غير ضرورية */
        }

        .data-table .table-tit{
            margin-right: 95px;
            
        }

        .table-row .service-type{
            margin-left: 50px;
            
        }

         
        }



      
    </style>
</head>
<body>
    <?php renderSidebar(); ?>
    <div class="main-content">
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-info">
                    <div class="stat-number"><?php echo $result->num_rows; ?></div>
                    <div class="stat-label">Servis sağlayıcılar</div>
                </div>
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-info">
                    <div class="stat-number"><?php echo $use ->num_rows; ?></div>
                    <div class="stat-label">Müşteriler</div>
                </div>
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
            </div>

            <div class="stat-box">
                <div class="stat-info">
                    <div class="stat-number"><?php echo $result->num_rows - 13; ?></div>
                    <div class="stat-label">İstekler</div>
                </div>
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M17.21 9l-4.38-6.56c-.19-.28-.51-.42-.83-.42-.32 0-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1h-4.79zM9 9l3-4.4L15 9H9zm3 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="search-bar">
            <span class="search-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </span>
            <input type="text" id="mainSearch" placeholder="Ara">
        </div>
        <div class="data-tables">
            <div class="data-table">
                <div class="table-header">
                    <div class="table-title">Servis sağlayıcılar</div>
                    <a href="hizmetciler.php"> <div class="view-all">  Tümünü görüntüle</div>   </a>
                </div>  
            
                <div class="table-header">
                    <div class="table-titl">Adı-Soyadı</div>
                    <div class="table-tit">Hizmetler</div>
                </div>
                <div class="table-content" id="serviceProviders">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagePath = "../dashboard/" . htmlspecialchars($row['profile_image']);
                    ?>
                    <div class="table-row">
                        <div class="col">
                            <img src="<?php echo $imagePath; ?>" class="user-avatar" alt="<?php echo htmlspecialchars($row['adi'] . " " . $row['soyadi']); ?>"> 
                            <?php echo htmlspecialchars($row['adi'] . " " . $row['soyadi']); ?>
                            <div class="service-type"> <?php echo htmlspecialchars($row['profession_name'] . " / " . $row['profession_n']); ?> </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                    ?>
                    <div class="table-row">No clients found</div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="user-table">
                <div class="table-header">
                    <div class="table-title">Müşteriler</div>
                    <a href="kullanicilar.php"> <div class="view-all">  Tümü</div>   </a>
                </div>
                <div class="table-header">
                    <div class="table-titl">Adı-Soyadı</div>
                </div>

                <div class="table-content" id="customers">
                    <?php
                    if ($use->num_rows > 0) {
                        while ($row = $use->fetch_assoc()) {
                            $imagePath = "../user_dashboard/" . htmlspecialchars($row['profile_image']);
                            $fullName = htmlspecialchars($row['adi'] . " " . $row['soyadi']);
                    ?>
                    <div class="table-row">
                        <div class="col">
                            <img src="<?php echo $imagePath; ?>" class="user-avatar" alt="<?php echo $fullName; ?>">
                            <?php echo $fullName; ?>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                    ?>
                    <div class="no-results">Hiçbir sonuç bulunamadı</div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="search.js"></script>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('mainSearch');
    const serviceProvidersTable = document.getElementById('serviceProviders');
    const customersTable = document.getElementById('customers');
    let timeoutId;

    // دالة لتأخير التنفيذ (debounce) لتحسين الأداء
    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // دالة لإنشاء رسالة "لا يوجد نتائج"
    function createNoResultsMessage(container) {
        const message = document.createElement('div');
        message.className = 'no-results';
        message.textContent = 'Hiçbir sonuç bulunamadı';
        message.style.padding = '15px 20px';
        message.style.textAlign = 'center';
        message.style.color = '#666';
        container.appendChild(message);
        return message;
    }

    // دالة لإزالة رسالة "لا يوجد نتائج" إذا وجدت
    function removeNoResultsMessage(container) {
        const existingMessage = container.querySelector('.no-results');
        if (existingMessage) {
            existingMessage.remove();
        }
    }

    // دالة البحث
    function performSearch(query) {
        query = query.toLowerCase().trim();

        // جلب جميع صفوف الجدولين
        const serviceRows = document.querySelectorAll('#serviceProviders .table-row');
        const customerRows = document.querySelectorAll('#customers .table-row');

        let hasServiceResults = false;
        let hasCustomerResults = false;

        // البحث في جدول Servis sağlayıcılar
        serviceRows.forEach(row => {
            const name = row.querySelector('.col')?.textContent.toLowerCase() || '';
            if (name.includes(query) || query === '') {
                row.style.display = 'flex';
                hasServiceResults = true;
            } else {
                row.style.display = 'none';
            }
        });

        // البحث في جدول Müşteriler
        customerRows.forEach(row => {
            const name = row.querySelector('.col')?.textContent.toLowerCase() || '';
            if (name.includes(query) || query === '') {
                row.style.display = 'flex';
                hasCustomerResults = true;
            } else {
                row.style.display = 'none';
            }
        });

        // إضافة/إزالة رسالة "لا يوجد نتائج" لكل جدول
        if (!hasServiceResults) {
            removeNoResultsMessage(serviceProvidersTable);
            createNoResultsMessage(serviceProvidersTable);
        } else {
            removeNoResultsMessage(serviceProvidersTable);
        }

        if (!hasCustomerResults) {
            removeNoResultsMessage(customersTable);
            createNoResultsMessage(customersTable);
        } else {
            removeNoResultsMessage(customersTable);
        }
    }

    // استدعاء البحث عند الكتابة مع تأخير 300ms لتحسين الأداء
    searchInput.addEventListener('input', debounce(function(e) {
        performSearch(e.target.value);
    }, 300));

    // عرض كل النتائج عند تحميل الصفحة
    performSearch('');
});
</script>
</html>