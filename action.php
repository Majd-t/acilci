<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acilc";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else {
 //  echo "Connected successfully";
}


/*$db ="CREATE DATABASE acilci";
if ($conn->query($db) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: ";
} */

/*$client = "CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY, -- معرف فريد لكل مستخدم
    adi VARCHAR(50) NOT NULL,         -- الاسم (حتى 50 حرفًا)
    soyadi VARCHAR(50) NOT NULL,      -- اللقب (حتى 50 حرفًا)
    email VARCHAR(100) NOT NULL UNIQUE, -- البريد الإلكتروني (فريد)
    numara VARCHAR(50) NOT NULL,      -- الرقم (حتى 50 حرفًا)
    sifre VARCHAR(255) NOT NULL,      -- كلمة المرور (مشفرة، حتى 255 حرفًا)
    il VARCHAR(50) NOT NULL,          -- المدينة (حتى 50 حرفًا)
    ilce VARCHAR(50) NOT NULL         -- الحي (حتى 50 حرفًا)
)";
if ($conn->query($client) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: ";
 } */

 /*$users = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- معرف فريد لكل مستخدم
    adi VARCHAR(50) NOT NULL,         -- الاسم (حتى 50 حرفًا)
    soyadi VARCHAR(50) NOT NULL,      -- اللقب (حتى 50 حرفًا)
    email VARCHAR(100) NOT NULL UNIQUE, -- البريد الإلكتروني (فريد)
    numara VARCHAR(50) NOT NULL,      -- الرقم (حتى 50 حرفًا)
    sifre VARCHAR(255) NOT NULL,      -- كلمة المرور (مشفرة، حتى 255 حرفًا)
    il VARCHAR(50) NOT NULL,          -- المدينة (حتى 50 حرفًا)
    ilce VARCHAR(50) NOT NULL         -- الحي (حتى 50 حرفًا)
)";
if ($conn->query($users) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: ";
 }  */



;

// $pro= "CREATE TABLE professions (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(255) NOT NULL UNIQUE
// )";

// $sub = "CREATE TABLE sub_professions (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(255) NOT NULL,
//     profession_id INT,
//     FOREIGN KEY (profession_id) REFERENCES professions(id) ON DELETE CASCADE
// )";

// $sq = "CREATE TABLE services (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     service_image VARCHAR(255) NOT NULL,
//     user_id INT NOT NULL,
//     urgent TINYINT(1) DEFAULT 0,
//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
// )";


// $qq = "CREATE TABLE services (
//     id INT AUTO_INCREMENT PRIMARY KEY, -- المفتاح الأساسي التلقائي
//     service_name VARCHAR(255) NOT NULL, -- اسم الخدمة
//     service_image VARCHAR(255) NOT NULL, -- رابط صورة الخدمة
//     user_id INT NOT NULL, -- رابط إلى جدول الأشخاص
//     is_urgent TINYINT(1) DEFAULT 0, -- حالة التفعيل (0 للعادية، 1 للعاجلة)
//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE -- ربط مع جدول الأشخاص
// )";


// إنشاء جدول الخدمات إذا لم يكن موجودًا مسبقًا
// $sql = "CREATE TABLE IF NOT EXISTS services (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(255) NOT NULL,
//     profession_image VARCHAR(255) NOT NULL,
//     profession_name VARCHAR(255) NOT NULL,
//     urgent_service BOOLEAN NOT NULL DEFAULT 0
// )";
// $conn->query($sql);

// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: ";
//  }



?>