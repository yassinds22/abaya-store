<?php
$currentPage     = 'index';
$pageTitle       = 'لارين عباية | الفخامة والأناقة في عالم العبايات';
$pageDescription = 'لارين عباية (Lareen Abaya) - تشكيلة راقية وحصرية من العبايات الملكية، الكلاسيكية والحديثة في صنعاء، سوق شميلة.';
require_once 'includes/header.php';
?>

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

<?php require_once 'includes/footer.php'; ?>
