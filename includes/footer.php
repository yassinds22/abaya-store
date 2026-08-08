    <!-- الفوتر الرئيسي الموحد -->
    <footer class="main-footer" id="main-site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>لارين عباية (Lareen Abaya)</h3>
                <p class="footer-about-text">
                    علامة تجارية متخصصة في تصميم وبيع العبايات الخليجية والملكية الراقية. نتميز باستخدام أجود أنواع الأقمشة والتطريز اليدوي الدقيق الذي يمنحكِ حضوراً ملكياً في كل مناسبة.
                </p>
                <div class="social-links-row">
                    <a href="https://instagram.com" target="_blank" class="social-icon-btn social-instagram" aria-label="انستغرام لارين عباية"><i class="fab fa-instagram"></i></a>
                    <a href="https://facebook.com"  target="_blank" class="social-icon-btn social-facebook"  aria-label="فيسبوك لارين عباية"><i class="fab fa-facebook"></i></a>
                    <a href="https://tiktok.com"    target="_blank" class="social-icon-btn social-tiktok"    aria-label="تيك توك لارين عباية"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>روابط سريعة</h3>
                <ul class="footer-links">
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="products.php">المنتجات والعبايات</a></li>
                    <li><a href="about.php">عن المحل وقصتنا</a></li>
                    <li><a href="contact.php">تواصل معنا</a></li>
                    <li><a href="qr-code.php">رمز الـ QR الخاص بنا</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>معلومات التواصل</h3>
                <ul class="footer-contact-list">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>صنعاء - سوق شميلة - شارع 2 - جوار العلوي للعبايات</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>773185534</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>السبت - الخميس: 9:00 صباحاً - 9:30 مساءً<br>الجمعة: 4:00 عصراً - 9:30 مساءً</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>جميع الحقوق محفوظة &copy; <?= date('Y') ?> لمتجر <span>لارين عباية</span>.</p>
            <p>صنع بكل حب في صنعاء 🌸</p>
        </div>
    </footer>

    <!-- ملفات جافا سكريبت -->
    <script src="<?= BASE_URL ?>assets/js/whatsapp.js"></script>
    <script src="<?= BASE_URL ?>assets/js/products.js"></script>
    <script src="<?= BASE_URL ?>assets/js/admin.js"></script>
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>
    <?php if (!empty($extraScripts)) echo $extraScripts; ?>

</body>
</html>
