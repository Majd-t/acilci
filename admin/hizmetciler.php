<?php
// إعدادات الاتصال بقاعدة البيانات

include '../action.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../register/login.php");
    exit();
}

// معالجة الحذف إذا تم إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_service') {
    $service_id = isset($_POST['service_id']) ? intval($_POST['service_id']) : 0;
    $client_name = isset($_POST['client_name']) ? htmlspecialchars($_POST['client_name']) : '';
    $delete_message = "";

    $conn->begin_transaction();

    try {
        if ($service_id > 0) {
            // إذا كان هناك service_id، حذف الخدمة من جدول services
            $sql_delete_service = "DELETE FROM services WHERE id = ?";
            $stmt_delete_service = $conn->prepare($sql_delete_service);
            $stmt_delete_service->bind_param("i", $service_id);

            if ($stmt_delete_service->execute()) {
                // الحصول على client_id الذي تم حذفه
                $sql_get_client = "SELECT client_id FROM services WHERE id = ? LIMIT 1";
                $stmt_get_client = $conn->prepare($sql_get_client);
                $stmt_get_client->bind_param("i", $service_id);
                $stmt_get_client->execute();
                $result_client = $stmt_get_client->get_result();

                if ($result_client->num_rows > 0) {
                    $row = $result_client->fetch_assoc();
                    $client_id = $row['client_id'];

                    // التحقق إذا كان هناك أي خدمات أخرى لنفس العميل
                    $sql_check_services = "SELECT COUNT(*) as count FROM services WHERE client_id = ?";
                    $stmt_check_services = $conn->prepare($sql_check_services);
                    $stmt_check_services->bind_param("i", $client_id);
                    $stmt_check_services->execute();
                    $result_check = $stmt_check_services->get_result();
                    $count = $result_check->fetch_assoc()['count'];

                    // إذا لم يكن هناك خدمات أخرى، لا حاجة لفعل شيء (سيتم التعامل معه لاحقًا إذا حاول المستخدم الحذف مرة أخرى)
                    $delete_message = "Hizmet başarıyla silindi.";
                } else {
                    $delete_message = "Hizmet bulunamadı.";
                }
            } else {
                throw new Exception("Hizmet silme hatası: " . $stmt_delete_service->error);
            }
        } else {
            // إذا لم يكن هناك service_id (لا يوجد خدمات)، حذف العميل من جدول clients باستخدام اسمه
            if (!empty($client_name)) {
                $names = explode(" ", $client_name, 2); // تقسيم الاسم إلى أول اسم واسم العائلة
                $adi = $names[0];
                $soyadi = isset($names[1]) ? $names[1] : '';

                if (!empty($adi)) {
                    // البحث عن العميل في جدول clients
                    $sql_find_client = "SELECT id FROM clients WHERE adi = ? AND soyadi = ?";
                    $stmt_find_client = $conn->prepare($sql_find_client);
                    $stmt_find_client->bind_param("ss", $adi, $soyadi);
                    $stmt_find_client->execute();
                    $result_find = $stmt_find_client->get_result();

                    if ($result_find->num_rows > 0) {
                        $client = $result_find->fetch_assoc();
                        $client_id_to_delete = $client['id'];

                        // حذف العميل من جدول clients
                        $sql_delete_client = "DELETE FROM clients WHERE id = ?";
                        $stmt_delete_client = $conn->prepare($sql_delete_client);
                        $stmt_delete_client->bind_param("i", $client_id_to_delete);

                        if ($stmt_delete_client->execute()) {
                            $delete_message = "Müşteri başarıyla silindi (hiç hizmeti yoktu).";
                        } else {
                            throw new Exception("Müşteri silme hatası: " . $conn->error);
                        }
                    } else {
                        $delete_message = "Müşteri bulunamadı.";
                    }
                } else {
                    $delete_message = "Geçersiz müşteri adı.";
                }
            } else {
                $delete_message = "Müşteri adı eksik.";
            }
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        $delete_message = "Hata oluştu: " . $e->getMessage();
    }

    // إغلاق جميع الجمل
    if (isset($stmt_delete_service)) $stmt_delete_service->close();
    if (isset($stmt_get_client)) $stmt_get_client->close();
    if (isset($stmt_check_services)) $stmt_check_services->close();
    if (isset($stmt_find_client)) $stmt_find_client->close();
    if (isset($stmt_delete_client)) $stmt_delete_client->close();
}

// استعلام لجلب البيانات مع service_id
$sql = "SELECT c.adi, c.soyadi, c.profile_image, s.profession_name, c.id as client_id, s.id as service_id 
        FROM clients c 
        LEFT JOIN services s ON c.id = s.client_id";
$result = $conn->query($sql);

$conn->close();
?>

<?php require_once 'sidebar_include.php'; ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acilci - Hizmet Verenler</title>
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

        .delete-form {
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

        .no-results {
            text-align: center;
            color: #666;
            padding: 20px;
            display: none;
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
            display: block;
        }

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
                margin-top: 20px;
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
                padding: 10px; /* تقليل الحواف الداخلية */
                margin: 0 auto; /* توسيط الشبكة */
                width: 100%; /* اجعل الشبكة ممتدة بعرض الشاشة */
            }

            .service-card {
                padding: 15px;
                border-radius: 12px;
            }

            .service-image {
                width: 80px;
                height: 80px;
            }

            .service-name {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 8px;
            }

            .service-description {
                font-size: 14px;
            }

            .delete-form {
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
            <span class="page-indicator-text">Hizmet Verenler</span>
            <span class="page-indicator-badge">280 Kayıt</span>
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
                    $imagePath = "../dashboard/" . htmlspecialchars($row['profile_image']);
                    $fullName = htmlspecialchars($row['adi'] . " " . $row['soyadi']);
                    $profession = htmlspecialchars($row['profession_name'] ?? 'No Service');
                    $clientId = htmlspecialchars($row['client_id']);
                    $serviceId = htmlspecialchars($row['service_id'] ?? '');
            ?>
            <div class="service-card" data-id="<?php echo $clientId; ?>">
                <form method="POST" action="" class="delete-form" onsubmit="return confirm('Bu hizmeti silmek istediğinizden emin misiniz?');">
                    <input type="hidden" name="action" value="delete_service">
                    <input type="hidden" name="service_id" value="<?php echo $serviceId; ?>">
                    <input type="hidden" name="client_name" value="<?php echo $fullName; ?>">
                    <button type="submit">
                        <img src="image/delete.png" alt="Delete" width="20" height="20">
                    </button>
                </form>
                <div class="service-image">
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $fullName; ?>">
                </div>
                <div class="service-name"><?php echo $fullName; ?></div>
                <div class="service-description"><?php echo $profession; ?></div>
            </div>
            <?php
                }
            } else {
                echo '<div class="no-results">Hiçbir sonuç bulunamadı</div>';
            }
            ?>
        </div>

        <?php if (isset($delete_message)): ?>
            <div class="notification">
                <?php echo $delete_message; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }

        function performSearch(query) {
            const searchTerm = query.toLowerCase();
            const cards = document.querySelectorAll('.service-card');
            let hasResults = false;

            cards.forEach(card => {
                const name = card.querySelector('.service-name').textContent.toLowerCase();
                const description = card.querySelector('.service-description').textContent.toLowerCase();
                if (name.includes(searchTerm) || description.includes(searchTerm)) {
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