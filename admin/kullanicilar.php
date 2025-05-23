<?php
// إعدادات الاتصال بقاعدة البيانات (مفترض أنها في action.php)
include '../action.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../register/login.php");
    exit();
}

// معالجة طلب حذف المستخدم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = intval($_POST['user_id']); // معرف المستخدم (id) الذي سيتم حذفه

    // استعلام لحذف المستخدم من جدول users
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // استجابة نجاح مع تفاصيل الإشعار
        $response = [
            'status' => 'success',
            'message' => 'تم حذف المستخدم بنجاح',
            'notification' => [
                'type' => 'success',
                'text' => 'تم حذف المستخدم بنجاح',
                'duration' => 3000,
                'backgroundColor' => '#4CAF50'
            ]
        ];
    } else {
        // استجابة فشل مع تفاصيل الإشعار
        $response = [
            'status' => 'error',
            'message' => 'حدث خطأ أثناء الحذف: ' . $conn->error,
            'notification' => [
                'type' => 'error',
                'text' => 'حدث خطأ أثناء الحذف',
                'duration' => 3000,
                'backgroundColor' => '#d81c1c'
            ]
        ];
    }

    $stmt->close();
    // إغلاق الاتصال إذا لم يتم إغلاقه مسبقًا
    $conn->close();

    // إرسال الاستجابة كـ JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// استعلام لجلب البيانات من جدول users
$sql = "SELECT id, adi, soyadi, profile_image FROM users";
$result = $conn->query($sql);

// إغلاق الاتصال إذا لم يتم إغلاقه
$conn->close();
?>

<?php require_once 'sidebar_include.php'; ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acilci - Kullanıcılar</title>
    <style>
        .main-content {
            margin-left: 360px;
            padding: 40px;
            width: calc(100% - 360px);
        }

        .page-indicator {
            background: linear-gradient(135deg, #d21f1f, #ff4444);
            color: white;
            padding: 15px 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(210, 31, 31, 0.2);
            display: flex;
            align-items: center;
            width: fit-content;
            margin: 0 auto 25px;
        }

        .page-indicator svg {
            width: 24px;
            height: 24px;
            margin-right: 12px;
            fill: rgb(255, 255, 255);
        }

        .page-indicator-text {
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .page-indicator-badge {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 12px;
            margin-left: 12px;
            font-size: 14px;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 25px;
            width: 100%;
        }

        .service-card {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .service-image {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 2px solid #d81c1c;
            margin: 0 auto 15px;
            overflow: hidden;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .service-name {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .service-description {
            color: #666;
            font-size: 16px;
        }

        .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            width: 20px;
            height: 20px;
        }

        .search-container {
            width: calc(67.5%);
            margin: 0 auto 25px;
            padding: 0 25px;
        }

        .search-bar {
            width: 100%;
            display: flex;
            align-items: center;
            height: 40px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 0;
            overflow: hidden;
        }

        .search-icon-container {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #d4d4d4;
            width: 40px;
            height: 40px;
            border-radius: 15px 0 0 15px;
            margin-right: 10px;
        }

        .search-icon {
            width: 20px;
            height: 20px;
            opacity: 0.6;
        }

        .search-input {
            flex-grow: 1;
            height: 100%;
            border: none;
            outline: none;
            font-size: 16px;
            color: #666;
            background: transparent;
            padding: 0 10px;
        }

        .search-input::placeholder {
            color: #aaa;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 10px;
            background-color: #d81c1c;
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

        /* Media Query for Mobile (max-width: 768px) */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
                width: 100%;
            }

            .page-indicator {
                width: 90%;
                margin: 15px auto;
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-indicator-text {
                font-size: 16px;
                font-weight: 500;
            }

            .page-indicator-badge {
                margin-left: 8px;
                padding: 3px 8px;
                border-radius: 12px;
                font-size: 12px;
            }

            .service-grid {
                grid-template-columns: repeat(2, 1fr); /* عرض بطاقتين بجانب بعضهما */
                gap: 15px; /* المسافة بين البطاقات */
                padding: 15px; /* تقليل الحواف الداخلية */
                
            }

            .service-card {
                padding: 20px; /* تقليل الحواف داخل البطاقة */
                border-radius: 10px; /* زوايا مستديرة */
            }

            .service-image {
                width: 70px; /* تقليل حجم الصورة */
                height: 70px;
            }

            .service-name {
                font-size: 14px; /* تقليل حجم النص */
                font-weight: bold;
                margin-bottom: 5px;
            }

            .service-description {
                font-size: 12px; /* تقليل حجم النص للوصف */
            }

            .delete-icon {
                width: 18px;
                height: 18px;
            }

            .search-container {
                width: 100%;
                padding: 0 15px;
                margin: 0 auto 15px;
            }

            .search-input {
                font-size: 14px;
            }

            .search-icon {
                width: 18px;
                height: 18px;
            }

            .notification {
                max-width: 80%;
                right: 10px;
                top: 10px;
            }

            .notification-message {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <?php renderSidebar(); ?>

    <div class="main-content">
        <div class="page-indicator">
            <svg viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <span class="page-indicator-text">Kullanıcılar</span>
            <span class="page-indicator-badge"><?php echo $result->num_rows; ?> Kayıt</span>
        </div>

        <div class="search-container">
            <div class="search-bar">
                <div class="search-icon-container">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" class="search-input" placeholder="Ara" aria-label="Search" onkeyup="performSearch(this.value)">
            </div>
        </div>

        <div class="service-grid" id="serviceGrid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = "../user_dashboard/" . htmlspecialchars($row['profile_image']);
                    $fullName = htmlspecialchars($row['adi'] . " " . $row['soyadi']);
            ?>
            <div class="service-card" data-id="<?php echo $row['id']; ?>">
                <button class="delete-icon" data-id="<?php echo $row['id']; ?>">
                    <img src="image/delete.png" alt="Delete" width="20" height="20">
                </button>
                <div class="service-image">
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $fullName; ?>">
                </div>
                <div class="service-name"><?php echo $fullName; ?></div>
                <div class="service-description"></div>
            </div>
            <?php
                }
            } else {
                echo '<div class="no-results">Hiçbir sonuç bulunamadı</div>';
            }
            ?>
        </div>
    </div>

    <div class="notification" id="notification">
        <div class="notification-icon">✓</div>
        <div class="notification-message" id="notification-message"></div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }

        function showNotification(options) {
            const notification = document.getElementById('notification');
            const notificationMessage = document.getElementById('notification-message');
            notificationMessage.textContent = options.text;
            notification.style.backgroundColor = options.backgroundColor || '#d81c1c';
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, options.duration || 3000);
        }

        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-icon')) {
                const button = e.target.closest('.delete-icon');
                const userId = button.getAttribute('data-id');
                const card = button.closest('.service-card');
                const providerName = card.querySelector('.service-name').textContent;

                // إرسال طلب AJAX للحذف
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "", true); // نفس الصفحة (يمكنك تغييرها إلى ملف PHP آخر إذا لزم الأمر)
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            showNotification(response.notification);

                            if (response.status === "success") {
                                // إزالة البطاقة من الواجهة بعد الحذف الناجح
                                card.remove();
                            }
                        } catch (e) {
                            console.error("خطأ في تحليل الاستجابة: " + e);
                            showNotification({
                                text: "حدث خطأ غير متوقع",
                                type: 'error',
                                duration: 3000,
                                backgroundColor: '#d81c1c'
                            });
                        }
                    } else {
                        console.error("فشل الطلب: " + xhr.status);
                        showNotification({
                            text: "فشل الاتصال بالسيرفر",
                            type: 'error',
                            duration: 3000,
                            backgroundColor: '#d81c1c'
                        });
                    }
                };

                xhr.onerror = function() {
                    console.error("خطأ في الاتصال بالسيرفر");
                    showNotification({
                        text: "خطأ في الاتصال بالسيرفر",
                        type: 'error',
                        duration: 3000,
                        backgroundColor: '#d81c1c'
                    });
                };

                const data = "delete_user=1&user_id=" + encodeURIComponent(userId);
                xhr.send(data);
            }
        });

        function performSearch(query) {
            const searchTerm = query.toLowerCase();
            const cards = document.querySelectorAll('.service-card');
            let hasResults = false;

            cards.forEach(card => {
                const name = card.querySelector('.service-name').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    card.style.display = 'block';
                    hasResults = true;
                } else {
                    card.style.display = 'none';
                }
            });

            const noResults = document.querySelector('.no-results');
            if (noResults) {
                noResults.style.display = hasResults ? 'none' : 'block';
            } else if (!hasResults && searchTerm) {
                const grid = document.getElementById('serviceGrid');
                const message = document.createElement('div');
                message.className = 'no-results';
                message.textContent = 'Hiçbir sonuç bulunamadı';
                grid.appendChild(message);
            } else if (hasResults && noResults) {
                noResults.remove();
            }
        }
    </script>
</body>
</html>