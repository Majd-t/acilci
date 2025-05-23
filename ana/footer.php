<?php
function includeFooter() {
    ?>
    
    <footer class="footer">
        <div class="footer-border"></div>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="img/thelogo.png" alt="Acılcı Gerçek Yardımcı Logo" class="logo-img">
            </div>
            <div class="footer-sections">
                <div class="footer-column hizmetler-column">
                    <h3>HIZMETLER</h3>
                    <div class="hizmetler-grid">
                        <ul class="hizmetler-list">
                            <li><span class="bullet">·</span> Temizlik</li>
                            <li><span class="bullet">·</span> Nakliyat</li>
                            <li><span class="bullet">·</span> Tamir</li>
                            <li><span class="bullet">·</span> Özel Ders</li>
                        </ul>
                        <ul class="hizmetler-list">
                            <li><span class="bullet">·</span> Sağlık</li>
                            <li><span class="bullet">·</span> Organizasyon</li>
                            <li><span class="bullet">·</span> Acil servis</li>
                            <li><span class="bullet">·</span> Diğer</li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>SAYFALAR</h3>
                    <ul class="sayfalar-list">
                     <a href="home.php" class="herf"> <li><span class="bullet">·</span> Ana sayfa</li> </a> 
                     <a href="hizmetler.php" class="herf">    <li><span class="bullet">·</span> Hizmetler</li>  </a> 
                     <a href="hakkinda.php" class="herf">   <li><span class="bullet">·</span> hakkında</li>  </a> 
                     <a href="bizeulas.php" class="herf">    <li><span class="bullet">·</span> Bize Ulaşın</li>  </a> 
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>ILETIŞIM</h3>
                    <ul>
                        <li class="contact-item">
                            <img src="img/3aykon.png" alt="Phone Icon" class="icon"> +90 551 123 92 67
                        </li>
                        <li class="contact-item">
                            <img src="img/5aykon.png" alt="Email Icon" class="icon"> info@acilci.co
                        </li>
                        <li class="social-media">
                            <h4>Bizi takip edin</h4>
                        </li>
                        <li>
                            <div class="social-icons">
                                <a href="#"><img src="img/6aykon.png" alt="Instagram" class="social-icon"></a>
                                <a href="#"><img src="img/7aykon.png" alt="Facebook" class="social-icon"></a>
                                <a href="#"><img src="img/8aykon.png" alt="YouTube" class="social-icon"></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?php echo date("Y"); ?> acılcı Tüm hakları saklıdır.</p>
        </div>
    </footer>

<style>
    .footer {
    background-color: #b51510;
    color: #FFFFFF;
    padding: 50px 0; /* زيادة من 40px إلى 50px */
    width: 90%;
    max-width: 1200px; /* زيادة من 1000px إلى 1200px */
    margin: 0 auto;
    position: relative;
    bottom: 0;
    font-family: Arial, sans-serif;
    transform: skewX(-15deg);
    border-top-left-radius: 12px; /* زيادة من 10px إلى 12px */
    border-top-right-radius: 12px;
}

.footer-border {
    position: absolute;
    top: 0;
    left: -12px; /* زيادة من -10px إلى -12px */
    right: 12px;
    bottom: 0;
    border: 1.5px solid #D4AF37; /* زيادة سمك الحدود من 1px إلى 1.5px */
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    pointer-events: none;
    border-top: 1.5px solid #D4AF37;
    transform: skewX(-15deg);
    border-bottom: 1.5px solid #D4AF37;
    transform: skewX(-5deg);
    transform: skewY(-1deg);
}

.footer-container {
    max-width: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 25px; /* زيادة من 20px إلى 25px */
    flex-wrap: wrap;
    transform: skewX(15deg);
}

.footer-logo {
    margin-top: 60px; /* زيادة من 50px إلى 60px */
}

.footer-logo .logo-img {
    max-width: 240px; /* زيادة من 200px إلى 240px */
    height: auto;
}

.footer-sections {
    display: flex;
    justify-content: space-between;
    gap: 50px; /* زيادة من 40px إلى 50px */
    flex: 1;
    margin-left: 60px; /* زيادة من 50px إلى 60px */
    align-items: flex-start;
}

.footer-column {
    flex: 1;
    min-width: 240px; /* زيادة من 200px إلى 240px */
    text-align: left;
}

.footer-column.hizmetler-column {
    flex: 2;
}

.footer-column h3 {
    font-size: 22px; /* زيادة من 18px إلى 22px */
    margin-bottom: 18px; /* زيادة من 15px إلى 18px */
    text-transform: uppercase;
    color: #D4AF37;
}

.hizmetler-grid {
    display: flex;
    gap: 25px; /* زيادة من 20px إلى 25px */
}

.hizmetler-list, .sayfalar-list {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 12px; /* زيادة من 10px إلى 12px */
    font-size: 16px; /* زيادة من 14px إلى 16px */
    display: flex;
    align-items: center;
}

.bullet {
    font-size: 24px; /* زيادة من 20px إلى 24px */
    margin-right: 6px; /* زيادة من 5px إلى 6px */
}

.herf {
    text-decoration: none;
    color: #FFFFFF;
}

.footer-column ul li.contact-item {
    display: flex;
    align-items: center;
    gap: 12px; /* زيادة من 10px إلى 12px */
}

.footer-column .icon {
    width: 28px; /* زيادة من 24px إلى 28px */
    height: 28px;
}

.social-media {
    margin-top: 18px; /* زيادة من 15px إلى 18px */
}

.social-media h4 {
    font-size: 16px; /* زيادة من 14px إلى 16px */
    margin-bottom: 12px; /* زيادة من 10px إلى 12px */
    color: #D4AF37;
}

.social-icons {
    display: flex;
    gap: 12px; /* زيادة من 10px إلى 12px */
    flex-direction: row;
    justify-content: flex-start;
}

.social-icon {
    width: 28px; /* زيادة من 24px إلى 28px */
    height: 28px;
}

.social-media a {
    color: #FFFFFF;
    text-decoration: none;
}

.social-media a:hover .social-icon {
    opacity: 0.8;
}

.footer-bottom {
    text-align: center;
    padding: 12px 0; /* زيادة من 10px إلى 12px */
    font-size: 14px; /* زيادة من 12px إلى 14px */
    transform: skewX(15deg);
}

.footer-bottom p {
    margin: 0;
}

@media (max-width: 768px) {
    .footer {
        width: 95%;
        padding: 18px; /* زيادة من 15px إلى 18px */
        transform: skewX(-0.5deg);
        border-radius: 5px; /* زيادة من 4px إلى 5px */
        background-color: #b51510;
    }

    .footer-border {
        left: 0;
        right: 0;
        transform: skewX(-3deg);
        border: 1.5px solid #D4AF37; /* زيادة سمك الحدود */
        border-radius: 5px;
    }

    .footer-container {
        flex-direction: column;
        align-items: center;
        gap: 25px; /* زيادة من 20px إلى 25px */
        padding: 12px; /* زيادة من 10px إلى 12px */
        transform: skewX(5deg);
    }

    .footer-logo {
        margin: 18px 0; /* زيادة من 15px إلى 18px */
        text-align: center;
    }

    .footer-logo .logo-img {
        max-width: 216px; /* زيادة من 180px إلى 216px */
    }

    .footer-sections {
        flex-direction: column;
        align-items: center;
        gap: 25px; /* زيادة من 20px إلى 25px */
        margin-left: 0;
        width: 100%;
    }

    .footer-column {
        text-align: center;
        min-width: 100%;
        margin-bottom: 18px; /* زيادة من 15px إلى 18px */
    }

    .footer-column.hizmetler-column {
        flex: 1;
    }

    .hizmetler-grid {
        flex-direction: column;
        gap: 12px; /* زيادة من 10px إلى 12px */
        align-items: center;
    }

    .hizmetler-list, .sayfalar-list {
        align-items: center;
        width: 100%;
    }

    .footer-column h3 {
        font-size: 26px; /* زيادة من 22px إلى 26px */
        margin-bottom: 12px; /* زيادة من 10px إلى 12px */
    }

    .footer-column ul li {
        font-size: 21px; /* زيادة من 18px إلى 21px */
        margin-bottom: 10px; /* زيادة من 8px إلى 10px */
        justify-content: center;
    }

    .bullet {
        font-size: 21px; /* زيادة من 18px إلى 21px */
    }

    .footer-column .icon {
        width: 28px; /* زيادة من 24px إلى 28px */
        height: 28px;
    }

    .social-icon {
        width: 33px; /* زيادة من 28px إلى 33px */
        height: 33px;
    }

    .social-icons {
        justify-content: center;
        gap: 18px; /* زيادة من 15px إلى 18px */
    }

    .footer-bottom {
        transform: skewX(5deg);
        padding: 12px 0; /* زيادة من 10px إلى 12px */
        font-size: 19px; /* زيادة من 16px إلى 19px */
    }
}

@media (max-width: 480px) {
    .footer {
        padding: 12px; /* زيادة من 10px إلى 12px */
        border-radius: 4px; /* زيادة من 3px إلى 4px */
        transform: skewX(0deg);
    }

    .footer-border {
        border-radius: 4px;
        transform: skewX(-3deg);
    }

    .footer-container {
        transform: skewX(3deg);
    }

    .footer-logo .logo-img {
        max-width: 180px; /* زيادة من 150px إلى 180px */
    }

    .footer-column h3 {
        font-size: 24px; /* زيادة من 20px إلى 24px */
    }

    .footer-column ul li {
        font-size: 24px; /* زيادة من 20px إلى 24px */
    }

    .bullet {
        font-size: 19px; /* زيادة من 16px إلى 19px */
    }

    .footer-column .icon {
        width: 26px; /* زيادة من 22px إلى 26px */
        height: 26px;
    }

    .social-icon {
        width: 31px; /* زيادة من 26px إلى 31px */
        height: 31px;
    }

    .social-icons {
        gap: 15px; /* زيادة من 12px إلى 15px */
    }

    .footer-bottom {
        transform: skewX(3deg);
        font-size: 17px; /* زيادة من 14px إلى 17px */
    }
}
</style>
    <?php
}
?>

