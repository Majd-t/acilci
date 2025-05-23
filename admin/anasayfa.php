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
        }

        body {
            display: flex;
            background-color: #f5f5f5;
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

        .data-tables {
            display: flex;
            justify-content: space-between;
            width: 100%;
            gap: 25px;
        }

        .data-table {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .data-table:first-child {
            width: 67.5%;
        }

        .data-table:last-child {
            width: 32.5%;
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

        .view-all {
            background-color: #ffd54f;
            color: #333;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 15px;
            cursor: pointer;
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

        .service-type {
            font-size: 15px;
        }
    </style>
</head>

<body>
    <?php renderSidebar(); ?>
    <div class="main-content">
        <!-- Stats boxes -->
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-info">
                    <div class="stat-number">1142</div>
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
                    <div class="stat-number">280</div>
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
                    <div class="stat-number">593</div>
                    <div class="stat-label">İstekler</div>
                </div>
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M17.21 9l-4.38-6.56c-.19-.28-.51-.42-.83-.42-.32 0-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1h-4.79zM9 9l3-4.4L15 9H9zm3 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Search bar -->
        <div class="search-bar">
            <span class="search-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </span>
            <input type="text" placeholder="Ara">
        </div>

        <!-- Data tables side by side -->
        <div class="data-tables">
            <!-- First table (Servis sağlayıcılar) -->
            <div class="data-table" style="width: 67.5%;">
                <div class="table-header">
                    <div class="table-title">Servis sağlayıcılar</div>
                    <div class="view-all">Tümünü görüntüle</div>
                </div>
                <div class="table-content">
                    <div class="table-columns">
                        <div class="col">Ad ve soyad</div>
                        <div class="col">Hizmet</div>
                    </div>

                    <!-- Backend developers: User data injection starts here -->
                    <div class="table-row">
                        <div class="col">
                            <div class="user-avatar">
                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt="Zeynep Yıldız" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="user-name">Zeynep Yıldız</div>
                        </div>
                        <div class="col service-type">Ev Temizliği</div>
                    </div>

                    <div class="table-row">
                        <div class="col">
                            <div class="user-avatar">
                                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg" alt="Ahmet Demir" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="user-name">Ahmet Demir</div>
                        </div>
                        <div class="col service-type">Boya Badana</div>
                    </div>
                    <!-- Backend developers: User data injection ends here -->
                </div>
            </div>

            <!-- Second table (Müşteriler) -->
            <div class="data-table" style="width: 32.5%;">
                <div class="table-header">
                    <div class="table-title">Müşteriler</div>
                    <div class="view-all">Tüm</div>
                </div>
                <div class="table-content">
                    <!-- Backend developers: Customer data injection starts here -->
                    <div class="table-row">
                        <div class="col">
                            <div class="user-avatar">
                                <img src="https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg" alt="Zeynep Yıldız" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="user-name">Zeynep Yıldız</div>
                        </div>
                    </div>

                    <div class="table-row">
                        <div class="col">
                            <div class="user-avatar">
                                <img src="https://images.pexels.com/photos/937481/pexels-photo-937481.jpeg" alt="Ahmet Demir" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="user-name">Ahmet Demir</div>
                        </div>
                    </div>
                    <!-- Backend developers: Customer data injection ends here -->
                </div>
            </div>
        </div>
    </div>

    <script src="search.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainSearchInput = document.querySelector('.search-bar input');

            // Search manager for service providers table
            const serviceProvidersSearch = new SearchManager({
                searchInput: mainSearchInput,
                itemsContainer: document.querySelector('.data-table:first-child .table-content'),
                itemSelector: '.table-row',
                searchFields: [{
                    selector: '.user-name',
                    weight: 2
                }, {
                    selector: '.service-type',
                    weight: 1
                }],
                noResultsMessage: 'Servis sağlayıcı bulunamadı'
            });

            // Search manager for customers table
            const customersSearch = new SearchManager({
                searchInput: mainSearchInput,
                itemsContainer: document.querySelector('.data-table:last-child .table-content'),
                itemSelector: '.table-row',
                searchFields: [{
                    selector: '.user-name',
                    weight: 2
                }],
                noResultsMessage: 'Müşteri bulunamadı'
            });
        });
    </script>
</body>

</html>