<?php
/**
 * api/settings.php
 * واجهة API لإدارة واسترجاع إعدادات المتجر (الشعار، شبكات التواصل الاجتماعي، بيانات الاتصال)
 */

session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$pdo = getDBConnection();
$method = $_SERVER['REQUEST_METHOD'];

// التأكد من توفر جدول site_settings
if ($pdo !== null) {
    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `site_settings` (
          `setting_key` VARCHAR(100) PRIMARY KEY,
          `setting_value` TEXT NULL,
          `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    } catch (Exception $e) {}
}

// الإعدادات الافتراضية للتراجع الآمن
$defaultSettings = [
    'site_logo'       => 'assets/images/logo.png',
    'site_name'       => 'لارين عباية (Lareen Abaya)',
    'phone_number'    => '773185534',
    'whatsapp_number' => '967773185534',
    'instagram_url'   => 'https://instagram.com',
    'facebook_url'    => 'https://facebook.com',
    'tiktok_url'      => 'https://tiktok.com',
    'snapchat_url'    => 'https://snapchat.com',
    'address_text'    => 'صنعاء - سوق شميلة - شارع 2 - جوار العلوي للعبايات',
    'work_hours'      => 'السبت - الخميس: 9:00 صباحاً - 9:30 مساءً'
];

// GET: جلب إعدادات المتجر
if ($method === 'GET') {
    if ($pdo === null) {
        sendJSONResponse($defaultSettings);
    }
    try {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
        $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        $merged = array_merge($defaultSettings, $rows);
        sendJSONResponse($merged);
    } catch (PDOException $e) {
        sendJSONResponse($defaultSettings);
    }
}

function checkAdminAuth() {
    if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
        sendJSONResponse(['error' => 'غير مصرح للوصول، يرجى تسجيل الدخول كآدمن'], 401);
    }
}

// POST / PUT: حفظ وتحديث الإعدادات والشعار
if ($method === 'POST' || $method === 'PUT') {
    checkAdminAuth();
    
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    // معالجة رفع صورة الشعار إن وجدت
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['logo_file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        
        if (in_array($ext, $allowed)) {
            $uploadDir = __DIR__ . '/../assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = 'logo_' . time() . '.' . $ext;
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $input['site_logo'] = 'assets/images/' . $filename;
            }
        }
    }

    $allowedKeys = [
        'site_logo', 'site_name', 'phone_number', 'whatsapp_number',
        'instagram_url', 'facebook_url', 'tiktok_url', 'snapchat_url',
        'address_text', 'work_hours'
    ];

    if ($pdo !== null) {
        try {
            $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (:key, :val) ON DUPLICATE KEY UPDATE setting_value = :val2");
            foreach ($allowedKeys as $key) {
                if (array_key_exists($key, $input)) {
                    $val = trim((string)$input[$key]);
                    $stmt->execute(['key' => $key, 'val' => $val, 'val2' => $val]);
                }
            }
            sendJSONResponse(['success' => true, 'message' => 'تم حفظ إعدادات الهوية والتواصل بنجاح 🌿']);
        } catch (PDOException $e) {
            sendJSONResponse(['error' => 'تعذر حفظ البيانات في قاعدة البيانات: ' . $e->getMessage()], 500);
        }
    }

    sendJSONResponse(['success' => true, 'message' => 'تم حفظ الإعدادات بنجاح']);
}

sendJSONResponse(['error' => 'طريقة الطلب غير مدعومة'], 405);
