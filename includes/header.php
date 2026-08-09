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
            <a href="<?= BASE_URL ?>index.php">
                <img id="site-header-logo" src="<?= BASE_URL ?>assets/images/logo.png" alt="شعار لارين عباية" class="logo"
                     onerror="this.src='https://placehold.co/200x80/0b4f3a/c5a059?text=Lareen+Abaya'">
            </a>
        </div>

        <button class="menu-toggle" id="menu-mobile-btn" aria-label="قائمة التنقل">
            <i class="fas fa-bars"></i>
        </button>

        <nav class="nav-container">
            <ul class="nav-links" id="navigation-menu-links">
                <li<?= navClass('index',    $currentPage) ?>><a href="<?= BASE_URL ?>index.php">الرئيسية</a></li>
                <li<?= navClass('products', $currentPage) ?>><a href="<?= BASE_URL ?>products.php">المنتجات</a></li>
                <li<?= navClass('about',    $currentPage) ?>><a href="<?= BASE_URL ?>about.php">عن المحل</a></li>
                <li<?= navClass('contact',  $currentPage) ?>><a href="<?= BASE_URL ?>contact.php">اتصل بنا</a></li>
                <li<?= navClass('qr-code',  $currentPage) ?>><a href="<?= BASE_URL ?>qr-code.php">رمز QR</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="<?= BASE_URL ?>admin/" class="admin-link-btn" id="go-to-admin-btn">
                <i class="fas fa-user-cog"></i>
                <span>لوحة التحكم</span>
            </a>
        </div>
    </header>
