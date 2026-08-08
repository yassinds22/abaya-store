<?php
/**
 * api/categories.php
 * واجهة CRUD الكاملة للأقسام (جلب، إضافة، تعديل، حذف)
 */

session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$pdo = getDBConnection();
$method = $_SERVER['REQUEST_METHOD'];

// GET: جلب الأقسام
if ($method === 'GET') {
    if ($pdo === null) {
        sendJSONResponse([
            ['id' => 1, 'name' => 'الأكثر طلباً', 'slug' => 'best-sellers', 'description' => 'العبايات الأكثر مبيعاً'],
            ['id' => 2, 'name' => 'آخر الوافدين', 'slug' => 'new-arrivals', 'description' => 'أحدث التصاميم المضافة'],
            ['id' => 3, 'name' => 'الكلاسيكية',   'slug' => 'classics',     'description' => 'التصاميم الكلاسيكية']
        ]);
    }
    $stmt = $pdo->query("SELECT id, name, slug, description, is_active FROM categories ORDER BY id ASC");
    sendJSONResponse($stmt->fetchAll());
}

function checkAdminAuth() {
    if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
        sendJSONResponse(['error' => 'غير مصرح للوصول، يرجى تسجيل الدخول'], 401);
    }
}

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$action = $_GET['action'] ?? ($input['action'] ?? '');

// DELETE: حذف قسم
if ($method === 'DELETE' || $action === 'delete') {
    checkAdminAuth();
    $id = (int)($_GET['id'] ?? ($input['id'] ?? 0));
    if (!$id) sendJSONResponse(['error' => 'معرف القسم غير محدد'], 400);

    if ($pdo !== null) {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    sendJSONResponse(['success' => true, 'message' => 'تم حذف القسم بنجاح']);
}

// POST / PUT: إضافة أو تعديل قسم
if ($method === 'POST' || $method === 'PUT') {
    checkAdminAuth();
    $id          = isset($input['id']) && $input['id'] ? (int)$input['id'] : null;
    $name        = trim($input['name'] ?? '');
    $description = trim($input['description'] ?? '');

    if (empty($name)) {
        sendJSONResponse(['error' => 'يرجى إدخال اسم القسم'], 400);
    }

    if ($pdo !== null) {
        $slug = 'cat-' . time();
        if ($id) {
            $stmt = $pdo->prepare("UPDATE categories SET name = :name, description = :desc WHERE id = :id");
            $stmt->execute(['name' => $name, 'desc' => $description, 'id' => $id]);
            sendJSONResponse(['success' => true, 'message' => 'تم تحديث القسم بنجاح']);
        } else {
            $stmt = $pdo->prepare("INSERT INTO categories (name, slug, description) VALUES (:name, :slug, :desc)");
            $stmt->execute(['name' => $name, 'slug' => $slug, 'desc' => $description]);
            sendJSONResponse(['success' => true, 'message' => 'تمت إضافة القسم بنجاح', 'id' => $pdo->lastInsertId()]);
        }
    }
    sendJSONResponse(['success' => true, 'message' => 'تمت العملية']);
}

sendJSONResponse(['error' => 'طريقة الطلب غير مدعومة'], 405);
