<?php
// متغيرات افتراضية إن لم تُعرَّف في الصفحة
$pageTitle       = $pageTitle       ?? 'لارين عباية | الفخامة والأناقة في عالم العبايات';
$pageDescription = $pageDescription ?? 'لارين عباية (Lareen Abaya) - تشكيلة راقية وحصرية من العبايات الملكية، الكلاسيكية والحديثة في صنعاء، سوق شميلة.';
$currentPage     = $currentPage     ?? 'index';

/**
 * BASE_URL: الرابط المطلق لجذر المشروع محسوب تلقائياً من PHP.
 * يعمل بشكل صحيح من أي مجلد داخل المشروع بدون الحاجة لتعريف $basePath يدوياً.
 * مثال: http://localhost/lareen-abaya/
 */
if (!defined('BASE_URL')) {
    // جذر المشروع هو مجلد includes/ منه - مستوي واحد للأعلى
    $projectRoot = dirname(__DIR__);
    // تحويل المسار المادي للمشروع إلى URL مطلق
    $scriptPath  = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']);
    $rootPath    = str_replace('\\', '/', $projectRoot);
    $webRoot     = str_replace($rootPath, '', $scriptPath);
    $scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host        = $_SERVER['HTTP_HOST'];
    // حساب الجزء الخاص بالمشروع من الـ document root
    $docRoot     = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    $urlPath     = str_replace($docRoot, '', $rootPath);
    define('BASE_URL', $scheme . '://' . $host . rtrim($urlPath, '/') . '/');
}

// دالة مساعدة لإضافة class="active" على رابط القائمة الحالي
function navClass(string $page, string $current): string {
    return $page === $current ? ' class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">

    <!-- إعدادات SEO الشاملة ومحركات الذكاء الاصطناعي (SEO & GEO & Local SEO) -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?= BASE_URL . ($currentPage === 'index' ? '' : $currentPage) ?>">

    <!-- Geo Local SEO (استهداف البحث المحلي في صنعاء) -->
    <meta name="geo.region" content="YE-SN">
    <meta name="geo.placename" content="صنعاء">
    <meta name="geo.position" content="15.3278;44.2081">
    <meta name="ICBM" content="15.3278, 44.2081">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= BASE_URL ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta property="og:image" content="<?= BASE_URL ?>assets/images/hero-banner.jpg">
    <meta property="og:locale" content="ar_YE">
    <meta property="og:site_name" content="لارين عباية - Lareen Abaya">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
    <meta name="twitter:image" content="<?= BASE_URL ?>assets/images/hero-banner.jpg">

    <!-- Schema.org JSON-LD Structured Data (لـ GEO & Google Rich Snippets) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ClothingStore",
        "@id": "<?= BASE_URL ?>#store",
        "name": "لارين عباية | Lareen Abaya",
        "alternateName": ["Lareen Abaya", "متجر لارين عباية صنعاء"],
        "url": "<?= BASE_URL ?>",
        "logo": "<?= BASE_URL ?>assets/images/logo.png",
        "image": "<?= BASE_URL ?>assets/images/hero-banner.jpg",
        "description": "علامة تجارية يمنية راقية متخصصة في تصميم وبيع العبايات الخليجية والملكية، التطريز اليدوي والأقمشة الفاخرة في صنعاء، سوق شميلة.",
        "telephone": "+967773185534",
        "priceRange": "$$",
        "currenciesAccepted": "YER",
        "paymentAccepted": "Cash, Bank Transfer, Mobile Wallet",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "سوق شميلة - شارع 2 - جوار العلوي للعبايات",
            "addressLocality": "صنعاء",
            "addressRegion": "أمانة العاصمة",
            "addressCountry": "YE"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 15.3278,
            "longitude": 44.2081
        },
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday"],
                "opens": "09:00",
                "closes": "21:30"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Friday"],
                "opens": "16:00",
                "closes": "21:30"
            }
        ],
        "sameAs": [
            "https://instagram.com",
            "https://facebook.com",
            "https://tiktok.com",
            "https://snapchat.com"
        ]
    }
    </script>

    <!-- تسريع تحميل خطوط Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- مكتبة الأيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- ملفات التنسيق المخصصة -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/animations.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/responsive.css">
    <?php if (!empty($extraHead)) echo $extraHead; ?>
</head>
<body>

    <!-- شريط الإعلان العلوي -->
    <div class="top-bar" id="top-announcement-bar">
        <div class="top-bar-announce">
            <span>🌿</span>
            <p>تشكيلة جديدة مميزة كل خميس - تابعينا ليصلكِم كل جديد</p>
        </div>
        <div class="top-bar-info" id="top-bar-info-container">
            <a href="https://instagram.com" id="top-instagram-link" target="_blank" style="color:inherit;"><i class="fab fa-instagram"></i> انستغرام</a>
            <a href="https://facebook.com" id="top-facebook-link" target="_blank" style="color:inherit;"><i class="fab fa-facebook"></i> فيسبوك</a>
            <span id="top-address-text"><i class="fas fa-map-marker-alt"></i> صنعاء - شميلة</span>
        </div>
    </div>

    <!-- الهيدر الرئيسي الموحد -->
    <header class="main-header" id="main-navigation-header">
        <div class="logo-container">
            <a href="<?= BASE_URL ?>">
                <img id="site-header-logo" src="<?= BASE_URL ?>assets/images/logo.png" alt="شعار لارين عباية" class="logo"
                     onerror="this.src='https://placehold.co/200x80/0b4f3a/c5a059?text=Lareen+Abaya'">
            </a>
        </div>

        <button class="menu-toggle" id="menu-mobile-btn" aria-label="قائمة التنقل">
            <i class="fas fa-bars"></i>
        </button>

        <nav class="nav-container">
            <ul class="nav-links" id="navigation-menu-links">
                <li<?= navClass('index',    $currentPage) ?>><a href="<?= BASE_URL ?>">الرئيسية</a></li>
                <li<?= navClass('products', $currentPage) ?>><a href="<?= BASE_URL ?>products">المنتجات</a></li>
                <li<?= navClass('about',    $currentPage) ?>><a href="<?= BASE_URL ?>about">عن المحل</a></li>
                <li<?= navClass('contact',  $currentPage) ?>><a href="<?= BASE_URL ?>contact">اتصل بنا</a></li>
                <li<?= navClass('qr-code',  $currentPage) ?>><a href="<?= BASE_URL ?>qr-code">رمز QR</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="<?= BASE_URL ?>admin/" class="admin-link-btn" id="go-to-admin-btn">
                <i class="fas fa-user-cog"></i>
                <span>لوحة التحكم</span>
            </a>
        </div>
    </header>
