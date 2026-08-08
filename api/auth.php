<?php
/**
 * api/auth.php
 * واجهة المصادقة وتسجيل الدخول بحماية PHP Sessions
 */

session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

if ($method === 'GET' && $action === 'check') {
    $isLogged = isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;
    sendJSONResponse([
        'authenticated' => $isLogged,
        'user'          => $isLogged ? ($_SESSION['admin_name'] ?? 'المشرف') : null
    ]);
}

if ($method === 'POST' && $action === 'login') {
    $input    = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $password = $input['password'] ?? '';

    if (empty($password)) {
        sendJSONResponse(['success' => false, 'message' => 'يرجى إدخال كلمة المرور'], 400);
    }

    $pdo = getDBConnection();
    if ($pdo !== null) {
        $stmt = $pdo->prepare("SELECT * FROM admins LIMIT 1");
        $stmt->execute();
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_logged'] = true;
            $_SESSION['admin_id']     = $admin['id'];
            $_SESSION['admin_name']   = $admin['name'];

            sendJSONResponse(['success' => true, 'message' => 'تم تسجيل الدخول بنجاح', 'user' => $admin['name']]);
        }
    }

    // fallback إذا كانت كلمة المرور هي المفتاح الافتراضي
    if ($password === 'lareen2026') {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_name']   = 'المشرف العام';
        sendJSONResponse(['success' => true, 'message' => 'تم تسجيل الدخول بنجاح', 'user' => 'المشرف العام']);
    }

    sendJSONResponse(['success' => false, 'message' => 'كلمة المرور غير صحيحة'], 401);
}

if ($action === 'logout') {
    session_destroy();
    sendJSONResponse(['success' => true, 'message' => 'تم تسجيل الخروج']);
}

sendJSONResponse(['success' => false, 'message' => 'طلب غير صالح'], 400);
