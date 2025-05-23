<?php
include "../action.php";

// Get service_id from URL
$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : 0;

// Retrieve service and client data
$query = $conn->prepare("
    SELECT 
        services.id AS service_id,
        services.profession_image, 
        services.profession_name, 
        services.profession_n, 
        services.explanation, 
        services.urgent_service,
        clients.adi, 
        clients.soyadi, 
        clients.id,
        clients.numara,
        clients.profile_image 
    FROM 
        services  
    INNER JOIN 
        clients ON services.client_id = clients.id 
    WHERE 
        services.id = ?
");
$query->bind_param("i", $service_id);
$query->execute();
$result = $query->get_result();
$service = $result->fetch_assoc();

// Check if service exists
if (!$service) {
    echo "<p>Hizmet bulunamadı.</p>";
    exit;
}

// Construct paths and escape output
$clientid = htmlspecialchars($service['id']);

$clientName = htmlspecialchars($service['adi'] . ' ' . $service['soyadi']);
$clientImage = '../dashboard/' . htmlspecialchars($service['profile_image']);
$serviceImage = '../dashboard/image/' . htmlspecialchars($service['profession_image']);
$serviceName = htmlspecialchars($service['profession_name']);
$serviceType = htmlspecialchars($service['profession_n']);
$serviceExplanation = htmlspecialchars($service['explanation']);

// Retrieve 4 random services for the cards section
$query = $conn->prepare("
    SELECT 
        services.id AS service_id,
        services.profession_image, 
        services.profession_name, 
        clients.adi, 
        clients.numara,
        clients.soyadi, 
       
        clients.profile_image 
    FROM 
        services  
    INNER JOIN 
        clients ON services.client_id = clients.id
    ORDER BY RAND() LIMIT 8
");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $serviceName; ?> Hizmetleri</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            width: 100%;
            max-width: 1280px;
            height: auto;
            margin: 30px auto;
            padding: 0 20px;
            position: relative;
        }
        
        .main-container {
            position: relative;
            width: 100%;
            height: auto;
            padding: 0;
            top: 0;
            left: 0;
            right: 0;
            
        }

        .qw{
            text-decoration: none;
        }
        
        .profile-image-container {
            position: relative;
            top: 80px;
            left: 0;
            width: 100%;
            max-width: 720px;
            height: 252px;
            overflow: hidden;
            border-radius: 18px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto 50px;
            
        }
        
        .profile-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: right;
                border: 2px solid ; /* إضافة إطار أسود */
                border-radius: 20px; /* إضافة حواف دائرية للإطار */

        }

        
        .profile-avatar {
            position: absolute;
            width: 84px;
            height: 84px;
            border-radius: 50%;
            left: 25px;
            top: 282px;
            border: 4px solid white;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        
        .profile-name {
            position: absolute;
            left: 25px;
            top: 372px;
            font-size: 22px;
            font-weight: bold;
        }
        
        .profile-content {
            position: relative;
            top: 162px;
            left: 0;
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
            
        }
        
        .service-title {
            font-size: 34px;
            font-weight: bold;
            color: #e12e1c;
            display: inline;
        }
        
        .service-subtitle {
            font-size: 34px;
            font-weight: bold;
            color: #333;
            display: inline;
        }
        
        .rating-container {
            display: flex;
            align-items: center;
            margin: 18px 0;
            flex-wrap: wrap;
        }
        
        .star {
            width: 45px;
            height: 45px;
            margin-right: 0;
            display: inline-block;
        }
        
        .rating-count {
            background-color: #ffc107;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 22px;
            margin-right: 18px;
            display: flex;
            align-items: center;
        }
        
        .user-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 6px;
            position: relative;
        }
        
        .user-icon::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
        }
        
        .user-icon::after {
            content: "";
            position: absolute;
            top: 11px;
            left: 50%;
            transform: translateX(-50%);
            width: 17px;
            height: 9px;
            background-color: white;
            border-radius: 9px 9px 0 0;
        }
        
        .rating-stars {
            color: #ffc107;
            font-size: 35px;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            margin-bottom: 10px;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            margin: 18px 0;
            flex-wrap: wrap;
            text-decoration: none;
        }
        
        .btn {
            padding: 15px;
            border-radius: 6px;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            font-size: 20px;
            width: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        
        .btn-call {
            background-color: #e12e1c;
            font-size: 30px;
            width: 30%;
            height: 70px;
            border-radius: 20px;
            text-decoration: none;
        }
        
        .btn-appointment {
            background-color: #ffc107;
            font-size: 30px;
            border-radius: 20px;
            width: 40%;
            height: 70px;
            text-decoration: none;
        }
        
        .btn-call .icon {
            width: 40px;
            height: 40px;
        }
        
        .service-description {
            margin-top: 18px;
        }
        
        .service-description h3 {
            font-size: 30px;
            margin-bottom: 12px;
        }
        
        .service-description p {
            color: #555;
            line-height: 1.6;
            max-width: 100%;
            font-size: 22px;
        }
        
        .similar-services-title {
            position: relative;
            top: 192px;
            left: 0;
            font-size: 29px;
            margin-bottom: 24px;
            text-align: center;
        }

        .cards-container {
            position: relative;
            top: 192px;
            left: 0;
            width: 100%;
            max-width: 516px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .card {
            width: 245px;
            height: 274px;
            border: 1px solid #000;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            position: relative;
            background: linear-gradient(180deg, #fff 70%, #f9f9f9 100%);
            outline: 0.6px solid #fff;
            outline-offset: -1.8px;
            border-radius: 20px;
        }

        .card .main-image {
            width: 90%;
            height: 108px;
            object-fit: cover;
            border-radius: 9px;
            margin: 6px auto 0;
            display: block;
        }

        .profile-container {
            position: absolute;
            top: 80px;
            left: 12px;
            text-align: center;
        }

        .card .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2.5px solid #fff;
        }

        .profile-container .name {
            font-size: 16px;
            color: #333;
            margin: 3px 0 0 0;
            font-weight: 600;
            text-shadow: 0 0.6px 1.2px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            padding: 32px 18px 8px 18px;
            text-align: center;
        }

        .card-content h3 {
            color: #d32f2f;
            margin: 6px 0;
            padding-top: 12px;
            font-weight: 900;
            letter-spacing: 0.9px;
            position: relative;
            text-shadow: 0 1.2px 2.4px rgba(0, 0, 0, 0.15);
            text-align: left;
            font-family: 'Arial', sans-serif;
            width: 90%;
            height: 100%;
        }

        .card-info {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin: 3px 0;
            font-size: 11px;
            gap: 9px;
        }

        .card-info .people {
            color: #d32f2f;
            display: flex;
            align-items: center;
            font-weight: 600;
            margin-right: 10px;
        }

        .card-info .people i {
            margin-right: 3.6px;
            font-size: 13px;
            animation: pulse 1.5s infinite;
        }

        .card-info .rating {
            display: flex;
            align-items: center;
            position: relative;
        }

        .card-info .rating i {
            margin: 10 0.6px;
            font-size: 12px;
            color: #f5c518;
            animation: sparkle 1.5s infinite;
        }

        .card-info .rating .rating-value {
            margin-left: 3.6px;
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .card-buttons {
            display: flex;
            justify-content: center;
            margin-top: 24px;
            font-weight: bold;
        }

        .card-buttons .view-btn {
            padding: 8.6px 0;
            width: 100%;
            border: none;
            border-radius: 10px;
            background-color: #f5c518;
            color: #333;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: -10px;
            text-decoration: none;
            text-align: center;
        }

        .card-content img {
            width: 8%;
            height: 8%;
            margin-right: -5px;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes sparkle {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        /* Media Query للهواتف */
        @media (max-width: 768px) {
            body {
                padding: 0 12px;
            }
            
            .profile-image-container {
                height: 216px;
            }
            
            .profile-avatar {
                left: 18px;
                top: 246px;
            }
            
            .profile-name {
                left: 18px;
                top: 336px;
            }
            
            .profile-content {
                top: 120px;
            }
            
            .service-title, .service-subtitle {
                font-size: 27px;
            }
            
            .btn {
                width: 100%;
                max-width: 360px;
            }
            
            .service-description h3 {
                font-size: 24px;
            }
            
            .service-description p {
                font-size: 19px;
            }
            
            .similar-services-title {
                top: 144px;
                margin-top: 24px;
            }
            
            .cards-container {
                top: 144px;
                justify-content: space-around;
            }
            
            @media (max-width: 430px) {
                .card {
                    width: 100%;
                    max-width: 300px;
                }
            }
        }
        
        /* Media Query لسطح المكتب */
        @media (min-width: 769px) {
            .main-container {
                position: absolute;
                width: 100%;
                height: 1080px;
            }
            
            .profile-image-container {
                position: absolute;
                top: 80px;
                left: 0;
                width: 720px;
                height: 252px;
                margin: 0;
            }
            
            .profile-content {
                position: absolute;
                top: 402px;
                left: 0;
                width: 720px;
                margin: 0;
            }
            
            .service-description p {
                max-width: 600px;
            }
            
            .vertical-line {
                display: block;
                position: absolute;
                top: 80px;
                left: 804px;
                width: 1px;
                height: 936px;
                background-color: #ddd;
            }
            
            .similar-services-title {
                position: absolute;
                top: 80px;
                left: 840px;
                text-align: left;
                margin-bottom: 0;
            }
            
            .cards-container {
                position: absolute;
                top: 120px;
                left: 840px;
                width: 516px;
                justify-content: flex-start;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Main Profile Section -->
        <div class="profile-image-container">
            <img src="<?php echo $serviceImage; ?>" alt="<?php echo $serviceName; ?>" class="profile-image">
        </div>

        <img src="<?php echo $clientImage; ?>" alt="<?php echo $clientName; ?>" class="profile-avatar">
        <h2 class="profile-name"><?php echo $clientName; ?></h2>

        <div class="profile-content">
            <div>
                <h1 class="service-title"><?php echo $serviceName; ?></h1>
                <span class="service-subtitle">/ <?php echo $serviceType; ?></span>
            </div>
            <div class="rating-container">
                <div class="rating-count"><span class="user-icon"></span></div>
                <img class="star" src="image/14.png" alt="">
                <div class="rating-stars">★★★★☆ </div>
            </div>
            <div class="action-buttons">

            <?php if ($service['urgent_service'] == 1) { ?>

                <a href="tel:<?php $service['numara']?>" class="btn btn-call">
                <img src="image/15.png" alt="Phone" class="icon">Arama
                </a>

            <?php  } ?>

            <a href="../gpt/chat.php?client_id=<?=$clientid?>" class="btn btn-appointment">Mesaj Gönder </a>
        </div>

            <div class="service-description">
                <h3>Hizmet açıklaması</h3>
                <p><?php echo $serviceExplanation; ?></p>
            </div>
        </div>  

        <!-- Vertical dividing line -->
        <div class="vertical-line"></div>

        <!-- Similar Services Section -->
        <h2 class="similar-services-title">Benzer hizmetler</h2>
        <div class="cards-container">
            <?php
            // Loop through the results
            while ($row = $result->fetch_assoc()) {
                // Construct paths correctly
                $cardClientName = htmlspecialchars($row['adi'] . ' ' . $row['soyadi']);
                $cardClientImage = '../dashboard/' . htmlspecialchars($row['profile_image']);
                $cardServiceImage = '../dashboard/image/' . htmlspecialchars($row['profession_image']);
                $cardServiceName = htmlspecialchars($row['profession_name']);
                $cardServiceId = $row['service_id'];
            ?>
                <div class="card">
                    <!-- Service image from external file -->
                    <img class="main-image" src="<?php echo $cardServiceImage; ?>" alt="Service Image">

                    <div class="profile-container">
                        <!-- Client image from external file -->
                        <img class="profile-image" src="<?php echo $cardClientImage; ?>" alt="Profile">
                        <p class="name"><?php echo $cardClientName; ?></p>
                    </div>

                    <div class="card-content">
                        <h3><?php echo $cardServiceName; ?></h3>
                        <div class="card-info">
                            <img class="star" src="image/31.png" alt="">
                            <span class="people">350</span>
                            <img src="image/32.png" alt="">
                            <span class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span class="rating-value"></span>
                            </span>
                        </div>
                        <div class="card-buttons">
                            <a href="?service_id=<?php echo $cardServiceId; ?>" class="view-btn">Daha</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


</body>
</html>