<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لارين عباية | الفخامة والأناقة في عالم العبايات</title>
    <meta name="description" content="لارين عباية (Larin Abaya) - تشكيلة راقية وحصرية من العبايات الملكية، الكلاسيكية والحديثة في صنعاء، سوق شميلة.">
    <!-- مكتبة الأيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- ملفات التنسيق المخصصة -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

    <!-- شريط الإعلان العلوي -->
    <div class="top-bar" id="top-announcement-bar">
        <div class="top-bar-announce">
            <span>🌿</span>
            <p>تشكيلة جديدة مميزة كل خميس - تابعينا ليصلكِم كل جديد</p>
        </div>
        <div class="top-bar-info">
            <span><i class="fab fa-instagram"></i> 18K متابعة</span>
            <span><i class="fab fa-facebook"></i> 12K متابعة</span>
            <span><i class="fas fa-map-marker-alt"></i> صنعاء - شميلة</span>
        </div>
    </div>

    <!-- الهيدر الرئيسي -->
    <header class="main-header" id="main-navigation-header">
        <div class="logo-container">
            <a href="index.php">
                <img src="assets/images/logo.png" alt="شعار لارين عباية" class="logo" onerror="this.src='https://placehold.co/200x80/2c1810/d4af37?text=Lareen+Abaya'">
            </a>
        </div>
        
        <button class="menu-toggle" id="menu-mobile-btn" aria-label="قائمة التنقل">
            <i class="fas fa-bars"></i>
        </button>

        <nav class="nav-container">
            <ul class="nav-links" id="navigation-menu-links">
                <li class="active"><a href="index.php">الرئيسية</a></li>
                <li><a href="products.php">المنتجات</a></li>
                <li><a href="about.php">عن المحل</a></li>
                <li><a href="contact.php">اتصل بنا</a></li>
                <li><a href="qr-code.php">رمز QR</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="admin.php" class="admin-link-btn" id="go-to-admin-btn">
                <i class="fas fa-user-cog"></i>
                <span>لوحة التحكم</span>
            </a>
        </div>
    </header>

    <!-- البانر الرئيسي المتحرك (Hero Slider) -->
    <section class="hero-section" id="home-hero-slider">
        <div class="hero-slider">
            <!-- الشريحة الأولى -->
            <div class="slide active" style="background-image: url('assets/images/hero-banner.jpg');">
                <div class="hero-content">
                    <span class="hero-subtitle">تشكيلة جديدة وحصرية</span>
                    <h1>حيث تلتقي الفخامة بالأناقة الملكية</h1>
                    <p>عبايات مصممة خصيصاً لتناسب ذوقكِ الرفيع، تجمع بين الاحتشام، الراحة، وأحدث صيحات الموضة الخليجية الراقية.</p>
                    <div class="hero-buttons">
                        <a href="products.php" class="btn btn-primary">تسوقي الآن <i class="fas fa-shopping-bag"></i></a>
                        <a href="about.php" class="btn btn-secondary">اكتشفي المحل</a>
                    </div>
                </div>
            </div>
            <!-- الشريحة الثانية -->
            <div class="slide" style="background-image: url('assets/images/logo.png');">
                <div class="hero-content">
                    <span class="hero-subtitle">تطريز يدوي فاخر</span>
                    <h1>دقة بالتفاصيل وأرقى الأقمشة الكورية</h1>
                    <p>ننتقي خاماتنا بعناية فائقة لتشعري بالثقة والتميز في كل خطواتك. أسعارنا منافسة وجودتنا مضمونة.</p>
                    <div class="hero-buttons">
                        <a href="products.php" class="btn btn-primary">رؤية العبايات <i class="fas fa-arrow-left"></i></a>
                        <a href="contact.php" class="btn btn-secondary">تواصل معنا</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- نقاط تحكم السلايدر -->
        <div class="slider-controls" id="slider-dot-controls">
            <!-- سيتم توليدها تلقائياً بالـ JavaScript -->
        </div>
    </section>

    <!-- قسم آخر الوافدين -->
    <section class="section" id="latest-arrivals-section">
        <div class="section-header">
            <h2 class="section-title">آخر الوافدين</h2>
            <p class="section-desc">أحدث التصاميم والقصات المضافة حديثاً لمتجرنا لتكوني أول المتألقات</p>
        </div>
        
        <div class="products-grid" id="latest-arrivals-container">
            <!-- يتم تحميل المنتجات بالـ JavaScript -->
            <div class="loading-spinner" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>جاري تحميل العبايات الفاخرة...</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 50px;">
            <a href="products.php" class="btn btn-primary" style="padding: 15px 40px;">مشاهدة كل المنتجات <i class="fas fa-arrow-left"></i></a>
        </div>
    </section>

    <!-- قسم الأكثر طلباً -->
    <section class="section section-bg-alt" id="best-sellers-section">
        <div class="section-header">
            <h2 class="section-title">الأكثر طلباً</h2>
            <p class="section-desc">مجموعة العبايات الأكثر مبيعاً ونالت إعجاب زبائننا المتميزين</p>
        </div>

        <div class="products-grid" id="best-sellers-container">
            <!-- يتم تحميل المنتجات بالـ JavaScript -->
            <div class="loading-spinner" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>جاري تحميل المنتجات المفضلة...</p>
            </div>
        </div>
    </section>

    <!-- شريط التواصل السريع -->
    <div class="quick-contact-bar" id="home-quick-contact">
        <div class="quick-contact-text">
            <h3>هل تبحثين عن تصميم مخصص أو مقاس معين؟</h3>
            <p>يمكنكِ مراسلتنا فوراً عبر الواتساب أو تصفح حسابنا لمزيد من التفاصيل اليومية.</p>
        </div>
        <div class="quick-socials">
            <a href="#" onclick="openGeneralWhatsAppChat(); return false;" class="btn btn-whatsapp" style="width: auto; padding: 12px 25px;">
                <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i>
                <span>راسلنا الآن</span>
            </a>
        </div>
    </div>

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
                    <a href="https://facebook.com" target="_blank" class="social-icon-btn social-facebook" aria-label="فيسبوك لارين عباية"><i class="fab fa-facebook"></i></a>
                    <a href="https://tiktok.com" target="_blank" class="social-icon-btn social-tiktok" aria-label="تيك توك لارين عباية"><i class="fab fa-tiktok"></i></a>
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
            <p>جميع الحقوق محفوظة &copy; 2026 لمتجر <span>لارين عباية</span>.</p>
            <p>صنع بكل حب في صنعاء 🌸</p>
        </div>
    </footer>

    <!-- ملفات جافا سكريبت -->
    <script src="assets/js/whatsapp.js"></script>
    <script src="assets/js/products.js"></script>
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
