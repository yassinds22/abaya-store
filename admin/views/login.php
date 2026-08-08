<?php
/**
 * views/login.php
 * -----------------------------------------------
 * واجهة HTML لشاشة تسجيل دخول المشرف
 * يتم تضمينها من admin/index.php عبر الـ Router
 * -----------------------------------------------
 */

// إعداد متغيرات الصفحة لملف header.php
$currentPage     = 'admin';
$pageTitle       = 'تسجيل الدخول | لارين عباية';
$pageDescription = 'صفحة تسجيل دخول المشرف للوصول إلى لوحة تحكم متجر لارين عباية.';
// ملاحظة: $basePath يُعرَّف تلقائياً من admin/index.php (الـ Router)

// تحديد المسار الجذري للمشروع (للوصول الصحيح لملف الهيدر)
require_once __DIR__ . '/../../includes/header.php';
?>

    <!-- شاشة تسجيل الدخول -->
    <div class="admin-login-overlay" id="admin-login-overlay" style="display: flex;">
        <div class="login-card">
            <h2>دخول المشرف</h2>
            <p>يرجى إدخال كلمة المرور للوصول إلى لوحة التحكم وإدارة المنتجات</p>
            <form id="login-form">
                <div class="form-group" style="text-align: right;">
                    <label for="admin-password" class="form-label">كلمة المرور *</label>
                    <input type="password" id="admin-password" class="form-control" placeholder="••••••••" required>
                </div>
                <div id="login-error" style="color: var(--color-wine); font-size: 0.85rem; margin-bottom: 15px; display: none; text-align: right; font-weight: bold;"></div>
                <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-sign-in-alt"></i> دخول</button>
            </form>
            <div style="margin-top: 20px;">
                <a href="../index.php" style="color: var(--color-gold); font-size: 0.9rem; font-weight: bold;"><i class="fas fa-arrow-right"></i> العودة للموقع الرئيسي</a>
            </div>
        </div>
    </div>

    <!-- لوحة التحكم الرئيسية (مخفية في صفحة الدخول) -->
    <div class="admin-dashboard-container" id="admin-dashboard" style="display: none;"></div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
