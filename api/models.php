<?php
/**
 * api/models.php
 * واجهة CRUD الكاملة للموديلات والتصاميم (جلب، إضافة، تعديل، حذف)
 */

session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$pdo = getDBConnection();
$method = $_SERVER['REQUEST_METHOD'];

// GET: جلب الموديلات
if ($method === 'GET') {
    if ($pdo === null) {
        sendJSONResponse([
            ['id' => 1, 'name' => 'بشت ملكي',       'slug' => 'bisht',    'description' => 'قصة البشت الخليجي الواسعة'],
            ['id' => 2, 'name' => 'كلوش أنيق',      'slug' => 'cloche',   'description' => 'قصة الكلوش الواسعة الانسيابية'],
            ['id' => 3, 'name' => 'مستقيم كلاسيك', 'slug' => 'straight', 'description' => 'التصميم المستقيم العادي'],
            ['id' => 4, 'name' => 'فراشة واسع',     'slug' => 'farasha',  'description' => 'قصة الفراشة الفضفاضة'],
            ['id' => 5, 'name' => 'كم منفوخ',       'slug' => 'puffy',    'description' => 'أكمام منفوخة مزمومة']
        ]);
    }
    $stmt = $pdo->query("SELECT id, name, slug, description, is_active FROM models ORDER BY id ASC");
    sendJSONResponse($stmt->fetchAll());
}

function checkAdminAuth() {
    if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
        sendJSONResponse(['error' => 'غير مصرح للوصول، يرجى تسجيل الدخول'], 401);
    }
}

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$action = $_GET['action'] ?? ($input['action'] ?? '');

// DELETE: حذف موديل
if ($method === 'DELETE' || $action === 'delete') {
    checkAdminAuth();
    $id = (int)($_GET['id'] ?? ($input['id'] ?? 0));
    if (!$id) sendJSONResponse(['error' => 'معرف الموديل غير محدد'], 400);

    if ($pdo !== null) {
        $stmt = $pdo->prepare("DELETE FROM models WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    sendJSONResponse(['success' => true, 'message' => 'تم حذف الموديل بنجاح']);
}

// POST / PUT: إضافة أو تعديل موديل
if ($method === 'POST' || $method === 'PUT') {
    checkAdminAuth();
    $id          = isset($input['id']) && $input['id'] ? (int)$input['id'] : null;
    $name        = trim($input['name'] ?? '');
    $description = trim($input['description'] ?? '');

    if (empty($name)) {
        sendJSONResponse(['error' => 'يرجى إدخال اسم الموديل'], 400);
    }

    if ($pdo !== null) {
        $slug = 'mod-' . time();
        if ($id) {
            $stmt = $pdo->prepare("UPDATE models SET name = :name, description = :desc WHERE id = :id");
            $stmt->execute(['name' => $name, 'desc' => $description, 'id' => $id]);
            sendJSONResponse(['success' => true, 'message' => 'تم تحديث الموديل بنجاح']);
        } else {
            $stmt = $pdo->prepare("INSERT INTO models (name, slug, description) VALUES (:name, :slug, :desc)");
            $stmt->execute(['name' => $name, 'slug' => $slug, 'desc' => $description]);
            sendJSONResponse(['success' => true, 'message' => 'تمت إضافة الموديل بنجاح', 'id' => $pdo->lastInsertId()]);
        }
    }
    sendJSONResponse(['success' => true, 'message' => 'تمت العملية']);
}

sendJSONResponse(['error' => 'طريقة الطلب غير مدعومة'], 405);
