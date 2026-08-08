<?php
/**
 * admin/index.php — الـ Router الرئيسي
 * =====================================================
 * نقطة الدخول الوحيدة لكل صفحات لوحة التحكم.
 *
 * آلية العمل:
 *   http://localhost/lareen-abaya/admin/              → لوحة التحكم (أو شاشة الدخول)
 *   http://localhost/lareen-abaya/admin/?page=login   → شاشة تسجيل الدخول
 *   http://localhost/lareen-abaya/admin/?page=dashboard → لوحة التحكم
 * =====================================================
 */

// تحميل الـ Controller
require_once __DIR__ . '/controllers/AdminController.php';

/**
 * تعريف $basePath هنا لأن المتصفح يحسب المسارات النسبية
 * من موقع ملف admin/index.php وهو داخل مجلد admin/ واحد.
 * → admin/ (مستوى واحد) = '../'
 */
$basePath = '../';

// تشغيل الـ Router
$controller = new AdminController();
$controller->dispatch();
