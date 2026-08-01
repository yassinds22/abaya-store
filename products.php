<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تشكيلة العبايات | لارين عباية</title>
    <meta name="description" content="تصفحي أحدث تشكيلات متجر لارين عباية، وقومي بفلترة العبايات بالأسعار والتصنيفات واطلبي مباشرة عبر الواتساب.">
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
            <p>تشكيلة جديدة مميزة كل خميس - تابعينا ليصلكِ كل جديد</p>
        </div>
        <div class="top-bar-info">
            <span><i class="fab fa-instagram"></i> 18K متابعة</span>
            <span><i class="fab fa-facebook"></i> 12K متابعة</span>
            <span><i class="fas fa-map-marker-alt"></i> صنعاء - شميلة</span>
        </div>
    </div>

    <!-- الهيدر الرئيسي الموحد -->
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
                <li><a href="index.php">الرئيسية</a></li>
                <li class="active"><a href="products.php">المنتجات</a></li>
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

    <!-- عنوان الصفحة -->
    <section class="section" style="padding-bottom: 20px;">
        <div class="section-header" style="margin-bottom: 20px;">
            <h1 class="section-title">تشكيلة العبايات</h1>
            <p class="section-desc">مجموعتنا الفاخرة المصممة خصيصاً لتناسب شتى الأذواق والمناسبات</p>
        </div>
    </section>

    <!-- شريط الفلترة والبحث -->
    <div class="filter-bar" id="products-filter-bar">
        <div class="search-box">
            <input type="text" id="search-input" class="search-input" placeholder="ابحثي عن عباية بالاسم أو الوصف...">
            <i class="fas fa-search search-icon"></i>
        </div>
        
        <div class="filters-group">
            <select id="category-filter" class="filter-select">
                <option value="all">جميع الأقسام</option>
                <option value="الأكثر طلباً">الأكثر طلباً</option>
                <option value="آخر الوافدين">آخر الوافدين</option>
                <option value="الكلاسيكية">الكلاسيكية</option>
            </select>
            
            <select id="price-filter" class="filter-select">
                <option value="default">ترتيب بحسب</option>
                <option value="newest">الأحدث أولاً</option>
                <option value="price-asc">السعر: من الأقل للأعلى</option>
                <option value="price-desc">السعر: من الأعلى للأقل</option>
            </select>
        </div>
    </div>

    <!-- شبكة المنتجات -->
    <section class="section" style="padding-top: 0; min-height: 400px;">
        <div class="products-grid" id="all-products-container">
            <!-- سيتم تعبئة المنتجات تلقائياً عبر JS -->
            <div class="loading-spinner" style="grid-column: 1/-1; text-align: center; padding: 40px; color: var(--color-text-muted);">
                <i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>جاري جلب أحدث تصاميم العبايات...</p>
            </div>
        </div>
    </section>

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
