<?php
include '..\action.php';

// معالجة البيانات عند الإرسال
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // الحصول على القيم من النموذج
    $adi = $_POST['adi'];
    $soyadi = $_POST['soyadi'];
    $email = $_POST['email'];
    @$numara = $_POST['numara'];
    $sifre = $_POST['sifre'];
    @$il = $_POST['il'];
    @$ilce = $_POST['ilce'];
    @$adress = $_POST['adres'];

    @$profile_image = $_FILES['profile_image']['name'];  // _FILE يتم اتسخدامها للصور
    @$profimg_tmp = $_FILES['profile_image']['tmp_name'];

    $clients = "SELECT id FROM clients WHERE email=?";
    $bit = $conn->prepare($clients);
    $bit->bind_param('s', $email);
    $bit->execute();
    $bit->store_result();

    if ($bit->num_rows > 0) {
        //echo "<p style='color: red;'>Bu kullanıcı e-posta mevcut!</p>";
        // echo "<div style='padding: 10px; background-color: red; color: white; border-radius: 5px;'>$mass</div>";
        echo "<div style='padding: 10px; background-color: red; color: white; border-radius: 5px; text-align: center; width: 50%; margin: 20px auto;'>
        Bu kullanıcı e-posta mevcut! <br> Lütfen başka bir e-posta adresi deneyin.
        </div>";
        echo '<meta http-equiv="refresh" content="5">';
        
    } 
    else {

        $profile_image = rand(0, 1000) . "_" . $profile_image;
        move_uploaded_file($profimg_tmp, "image/$profile_image");

        $clients = "INSERT INTO clients (adi, soyadi, email, numara, sifre, il, ilce, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $bit = $conn->prepare($clients);
        $bit->bind_param('ssssssss', $adi, $soyadi, $email, $numara, $sifre, $il, $ilce, $profile_image);
        
        if ($bit->execute()) {
            echo "<p style='color: green;'> Kayıt başarılı! </p>";
            header("Location:../dashboard/profil.php");
        } 
        else {
            echo "<p style='color: red;'> Kayıt başarısız! </p>";
            header("Location: web.php");
            
        }



     }
    }

?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kayıt</title>
    <style>
         button:hover {
            background-color: #c10510;
        }

        .error-message {
            color: red;
            display: none;
            font-size: 24px;
        }
    </style>
    <link rel="stylesheet" href="styl.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="left">
            <i class="fas fa-user-edit icon"></i>
            <img src="resimler/hizmet.png" alt="">
            <h1>Hizmet Veren Kaydı</h1>
            <p>Daha fazla müşteriye ulaşmak ve
                kazancını artırmak için hemen
                kaydol!</p>
        </div>
        <div class="right">
            <form action="clients.php" method="post" enctype="multipart/form-data">
                <div class="input-row">
                    <input type="text" placeholder="Adı" name="adi" required>
                    <input type="text" placeholder="Soyad" name="soyadi" required>
                </div>
                <input type="email" placeholder="Email" name="email" required>

                <input type="number"placeholder="Telefon Numarası" id="number" name="numara" required>

                <input type="password" id="password" name="sifre" placeholder="Şifre" required>

               
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Şifreyi Onayla" onkeyup="checkPasswords()" required>
                <div id="passwordError" class="error-message">Şifreler eşleşmiyor!</div>

        

                <div class="input-row"> 
                    <label for="ilceler"></label>
                    <select name="il" id="iller" onchange="updateDistricts()" required>
                        <option value="">  İl seçeniz </option>
                        <option value="Adana">Adana</option>
                        <option value="Adıyaman">Adıyaman</option>
                        <option value="Afyonkarahisar">Afyonkarahisar</option>
                        <option value="Ağrı">Ağrı</option>
                        <option value="Amasya">Amasya</option>
                        <option value="Ankara">Ankara</option>
                        <option value="Antalya">Antalya</option>
                        <option value="Artvin">Artvin</option>
                        <option value="Aydın">Aydın</option>
                        <option value="Balıkesir">Balıkesir</option>
                        <option value="Bilecik">Bilecik</option>
                        <option value="Bingöl">Bingöl</option>
                        <option value="Bitlis">Bitlis</option>
                        <option value="Bolu">Bolu</option>
                        <option value="Burdur">Burdur</option>
                        <option value="Bursa">Bursa</option>
                        <option value="Çanakkale">Çanakkale</option>
                        <option value="Çankırı">Çankırı</option>
                        <option value="Çorum">Çorum</option>
                        <option value="Denizli">Denizli</option>
                        <option value="Diyarbakır">Diyarbakır</option>
                        <option value="Edirne">Edirne</option>
                        <option value="Elazığ">Elazığ</option>
                        <option value="Erzincan">Erzincan</option>
                        <option value="Erzurum">Erzurum</option>
                        <option value="Eskişehir">Eskişehir</option>
                        <option value="Gaziantep">Gaziantep</option>
                        <option value="Giresun">Giresun</option>
                        <option value="Gümüşhane">Gümüşhane</option>
                        <option value="Hakkâri">Hakkâri</option>
                        <option value="Hatay">Hatay</option>
                        <option value="Isparta">Isparta</option>
                        <option value="Mersin">Mersin</option>
                        <option value="İstanbul">İstanbul</option>
                        <option value="İzmir">İzmir</option>
                        <option value="Kars">Kars</option>
                        <option value="Kastamonu">Kastamonu</option>
                        <option value="Kayseri">Kayseri</option>
                        <option value="Kırklareli">Kırklareli</option>
                        <option value="Kırşehir">Kırşehir</option>
                        <option value="Kocaeli">Kocaeli</option>
                        <option value="Konya">Konya</option>
                        <option value="Kütahya">Kütahya</option>
                        <option value="Malatya">Malatya</option>
                        <option value="Manisa">Manisa</option>
                        <option value="Kahramanmaraş">Kahramanmaraş</option>
                        <option value="Mardin">Mardin</option>
                        <option value="Muğla">Muğla</option>
                        <option value="Muş">Muş</option>
                        <option value="Nevşehir">Nevşehir</option>
                        <option value="Niğde">Niğde</option>
                        <option value="Ordu">Ordu</option>
                        <option value="Rize">Rize</option>
                        <option value="Sakarya">Sakarya</option>
                        <option value="Samsun">Samsun</option>
                        <option value="Siirt">Siirt</option>
                        <option value="Sinop">Sinop</option>
                        <option value="Sivas">Sivas</option>
                        <option value="Tekirdağ">Tekirdağ</option>
                        <option value="Tokat">Tokat</option>
                        <option value="Trabzon">Trabzon</option>
                        <option value="Tunceli">Tunceli</option>
                        <option value="Şanlıurfa">Şanlıurfa</option>
                        <option value="Uşak">Uşak</option>
                        <option value="Van">Van</option>
                        <option value="Yozgat">Yozgat</option>
                        <option value="Zonguldak">Zonguldak</option>
                        <option value="Aksaray">Aksaray</option>
                        <option value="Bayburt">Bayburt</option>
                        <option value="Karaman">Karaman</option>
                        <option value="Kırıkkale">Kırıkkale</option>
                        <option value="Batman">Batman</option>
                        <option value="Şırnak">Şırnak</option>
                        <option value="Bartın">Bartın</option>
                        <option value="Ardahan">Ardahan</option>
                        <option value="Iğdır">Iğdır</option>
                        <option value="Yalova">Yalova</option>
                        <option value="Karabük">Karabük</option>
                        <option value="Kilis">Kilis</option>
                        <option value="Osmaniye">Osmaniye</option>
                        <option value="Düzce">Düzce</option>
                    </select>
                    
                    <label for="ilceler"></label>
                    <select id="ilceler" name="ilce" required>
                        <option value="">Önce İl Seçiniz</option>
                    </select>
                    
                    <script>
                        function updateDistricts() {
                            const il = document.getElementById("iller").value;
                            const ilcelerSelect = document.getElementById("ilceler");
                    
                            // Clear existing options
                            ilcelerSelect.innerHTML = "<option value=''>Önce İl Seçiniz</option>";
                    
                            // Add districts based on selected city (il)
                            let districts = [];
                    
                            switch (il) {
                                case "Adana": districts = ["Seyhan", "Yüreğir", "Çukurova", "Sarıçam", "Aladağ"]; break;
                                case "Adıyaman": districts = ["Merkez", "Kahta", "Gerger", "Besni", "Çelikhan"]; break;
                                case "Afyonkarahisar": districts = ["Merkez", "Emirdağ", "Dinar", "Sandıklı", "Bolvadin"]; break;
                                case "Ağrı": districts = ["Merkez", "Doğubayazıt", "Patnos", "Tuzluca", "Hamur"]; break;
                                case "Amasya": districts = ["Merkez", "Göynücek", "Suluova", "Taşova", "Merzifon"]; break;
                                case "Ankara": districts = ["Çankaya", "Keçiören", "Mamak", "Sincan", "Yenimahalle"]; break;
                                case "Antalya": districts = ["Muradpaşa", "Kepez", "Konyaaltı", "Alanya", "Manavgat"]; break;
                                case "Artvin": districts = ["Merkez", "Ardanuç", "Şavşat", "Hopa", "Murgul"]; break;
                                case "Aydın": districts = ["Efeler", "Söke", "Nazilli", "Kuşadası", "Didim"]; break;
                                case "Balıkesir": districts = ["Merkez", "Edremit", "Ayvalık", "Bandırma", "Burhaniye"]; break;
                                case "Bilecik": districts = ["Merkez", "İnhisar", "Bozüyük", "Gölpazarı", "Osmaneli"]; break;
                                case "Bingöl": districts = ["Merkez", "Solhan", "Genç", "Kığı", "Adaklı"]; break;
                                case "Bitlis": districts = ["Merkez", "Tatvan", "Ahlat", "Adilcevaz", "Hizan"]; break;
                                case "Bolu": districts = ["Merkez", "Gerede", "Dörtdivan", "Mudurnu", "Yeniçağa"]; break;
                                case "Burdur": districts = ["Merkez", "Ağlasun", "Gölhisar", "Bucak", "Çavdır"]; break;
                                case "Bursa": districts = ["Osmangazi", "Nilüfer", "Yıldırım", "Gemlik", "İnegöl"]; break;
                                case "Çanakkale": districts = ["Merkez", "Ezine", "Çan", "Ayvacık", "Lapseki"]; break;
                                case "Çankırı": districts = ["Merkez", "Kurşunlu", "Çerkeş", "Kızılırmak", "Atkaracalar"]; break;
                                case "Çorum": districts = ["Merkez", "Sungurlu", "İskilip", "Osmancık", "Alaca"]; break;
                                case "Denizli": districts = ["Merkezefendi", "Pamukkale", "Çivril", "Acıpayam", "Bulgurlu"]; break;
                                case "Diyarbakır": districts = ["Sur", "Yenişehir", "Bağlar", "Kayapınar", "Çermik"]; break;
                                case "Edirne": districts = ["Merkez", "Keşan", "Lalapaşa", "Uzunköprü", "Havsa"]; break;
                                case "Elazığ": districts = ["Merkez", "Keban", "Karakocan", "Maden", "Palu"]; break;
                                case "Erzincan": districts = ["Merkez", "Sivasa", "İliç", "Erzincan", "Kemaliye"]; break;
                                case "Erzurum": districts = ["Merkez", "Yakutiye", "Palandöken", "Aziziye", "Tekman"]; break;
                                case "Eskişehir": districts = ["Tepebaşı", "Odunpazarı", "Alpu", "Beylikova", "Mahmudiye"]; break;
                                case "Gaziantep": districts = ["Şahinbey", "Şehitkamil", "Oğuzeli", "Nizip", "Karkamış"]; break;
                                case "Giresun": districts = ["Merkez", "Espiye", "Giresun Merkez", "Piraziz", "Yağlıdere"]; break;
                                case "Gümüşhane": districts = ["Merkez", "Şiran", "Torul", "Kürtün", "Kelkit"]; break;
                                case "Hakkâri": districts = ["Merkez", "Şırnak Merkez", "Cizre", "Silopi", "İdil"]; break;
                                case "Hatay": districts = ["Samandağ", "Antakya", "Defne", "İskenderun", "Belen"]; break;
                                case "Isparta": districts = ["Merkez", "Isparta Merkez", "Göle", "Göller", "Süleyman"]; break;
                                case "Mersin": districts = ["Yenişehir", "Akdeniz", "Toroslar", "Mezitli", "Tarsus"]; break;
                                case "İstanbul": districts = ["Fatih", "Kadıköy", "Üsküdar", "Maltepe", "Kartal"]; break;
                                // Add more cases as necessary for other cities
                            }
                    
                            // Add the district options to the select element
                            districts.forEach(function(district) {
                                const option = document.createElement("option");
                                option.value = district;
                                option.text = district;
                                ilcelerSelect.appendChild(option);
                            });
                        }
                    </script>
                    

                    
                    
                </body>
                </div>
                <div class="button-container">
                    <button type="submit" id="submitBtn" class="login-btn"><img src="resimler/hizmet.png" alt=""> <strong>Kayıt Ol</strong></button>
                    
                </div>
            </form>
        </div>
    </div>
</body>

 <!-- Şifre eşleşmeme kodu -->
<script>
    function checkPasswords() {
        var password = document.getElementById("password").value; // Şifre
        var confirmPassword = document.getElementById("confirmPassword").value;  // Şifre Tekrarı
        var submitButton = document.getElementById("submitBtn");
        var passwordError = document.getElementById("passwordError");

        if (password === confirmPassword) {
            passwordError.style.display = "none";
            submitButton.disabled = false;
        } else {
            passwordError.style.display = "block";
            submitButton.disabled = true;
        }
    }
</script>
</html>