<?php
/**
 * api/products.php
 * RESTful API لإدارة المنتجات (عرض، إضافة، تعديل، حذف) عبر PDO
 */

session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json; charset=utf-8');

$pdo = getDBConnection();
$method = $_SERVER['REQUEST_METHOD'];

// ==========================================
// 1. معالجة طلبات الجلب (GET)
// ==========================================
if ($method === 'GET') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

    if ($pdo === null) {
        // Fallback to JSON file if DB unavailable
        $jsonPath = __DIR__ . '/../data/products.json';
        $products = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];
        if ($id) {
            foreach ($products as $p) {
                if ($p['id'] == $id) sendJSONResponse($p);
            }
            sendJSONResponse(['error' => 'المنتج غير موجود'], 404);
        }
        sendJSONResponse($products);
    }

    if ($id) {
        $stmt = $pdo->prepare("
            SELECT p.*, c.name AS category, m.name AS model_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN models m ON p.model_id = m.id
            WHERE p.id = :id AND p.is_active = 1
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        if ($product) {
            sendJSONResponse($product);
        } else {
            sendJSONResponse(['error' => 'المنتج غير موجود'], 404);
        }
    }

    // جلب جميع المنتجات مع الفلترة
    $query     = isset($_GET['q']) ? trim($_GET['q']) : '';
    $category  = isset($_GET['category']) ? trim($_GET['category']) : 'all';
    $modelId   = isset($_GET['model_id']) ? (int)$_GET['model_id'] : 0;
    $sort      = isset($_GET['sort']) ? trim($_GET['sort']) : 'default';

    $sql = "
        SELECT p.id, p.name, p.description, p.price, p.image, p.created_at,
               COALESCE(c.name, 'غير محدد') AS category,
               p.category_id, p.model_id,
               m.name AS model_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN models m ON p.model_id = m.id
        WHERE p.is_active = 1
    ";

    $params = [];

    if (!empty($query)) {
        $sql .= " AND (p.name LIKE :q OR p.description LIKE :q)";
        $params['q'] = '%' . $query . '%';
    }

    if ($category !== 'all' && !empty($category)) {
        $sql .= " AND c.name = :cat";
        $params['cat'] = $category;
    }

    if ($modelId > 0) {
        $sql .= " AND p.model_id = :mid";
        $params['mid'] = $modelId;
    }

    if ($sort === 'price-asc') {
        $sql .= " ORDER BY p.price ASC";
    } elseif ($sort === 'price-desc') {
        $sql .= " ORDER BY p.price DESC";
    } elseif ($sort === 'newest') {
        $sql .= " ORDER BY p.id DESC";
    } else {
        $sql .= " ORDER BY p.id ASC";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();

    sendJSONResponse($products);
}

// ==========================================
// فحص الصلاحية لبقية العمليات (POST, PUT, DELETE)
// ==========================================
function checkAdminAuth() {
    if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
        sendJSONResponse(['error' => 'غير مصرح للوصول، يرجى تسجيل الدخول'], 401);
    }
}

// ==========================================
// 2. معالجة الإضافة والتعديل والحذف (POST / PUT / DELETE)
// ==========================================
$input  = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$action = $_GET['action'] ?? ($input['action'] ?? '');

// -- حذف منتج --
if ($method === 'DELETE' || $action === 'delete') {
    checkAdminAuth();
    $deleteId = (int)($_GET['id'] ?? ($input['id'] ?? 0));

    if (!$deleteId) {
        sendJSONResponse(['error' => 'معرف المنتج غير محدد'], 400);
    }

    if ($pdo !== null) {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $deleteId]);
    }

    sendJSONResponse(['success' => true, 'message' => 'تم حذف المنتج بنجاح']);
}

// -- إضافة أو تعديل منتج --
if ($method === 'POST' || $method === 'PUT') {
    checkAdminAuth();

    $id          = isset($input['id']) ? (int)$input['id'] : null;
    $name        = trim($input['name'] ?? '');
    $price       = (float)($input['price'] ?? 0);
    $categoryName= trim($input['category'] ?? '');
    $modelId     = !empty($input['model_id']) ? (int)$input['model_id'] : null;
    $description = trim($input['description'] ?? '');
    $image       = trim($input['image'] ?? '');

    if (empty($name) || $price <= 0 || empty($description)) {
        sendJSONResponse(['error' => 'يرجى استكمال جميع الحقول المطلوبة بالشكل الصحيح'], 400);
    }

    if ($pdo !== null) {
        // البحث عن ID القسم
        $catId = null;
        if (!empty($categoryName)) {
            $stmtCat = $pdo->prepare("SELECT id FROM categories WHERE name = :name LIMIT 1");
            $stmtCat->execute(['name' => $categoryName]);
            $catId = $stmtCat->fetchColumn() ?: null;
        }

        if (empty($image)) {
            $image = "https://picsum.photos/400/530?random=" . rand(100, 999);
        }

        if ($id) {
            // تحديث منتج قائم
            $stmt = $pdo->prepare("
                UPDATE products
                SET category_id = :cat_id, model_id = :model_id, name = :name,
                    description = :desc, price = :price, image = :image
                WHERE id = :id
            ");
            $stmt->execute([
                'cat_id'   => $catId,
                'model_id' => $modelId,
                'name'     => $name,
                'desc'     => $description,
                'price'    => $price,
                'image'    => $image,
                'id'       => $id
            ]);
            sendJSONResponse(['success' => true, 'message' => 'تم تحديث العباية بنجاح']);
        } else {
            // إضافة منتج جديد
            $slug = 'abaya-' . time();
            $stmt = $pdo->prepare("
                INSERT INTO products (category_id, model_id, name, slug, description, price, image)
                VALUES (:cat_id, :model_id, :name, :slug, :desc, :price, :image)
            ");
            $stmt->execute([
                'cat_id'   => $catId,
                'model_id' => $modelId,
                'name'     => $name,
                'slug'     => $slug,
                'desc'     => $description,
                'price'    => $price,
                'image'    => $image
            ]);
            sendJSONResponse(['success' => true, 'message' => 'تمت إضافة العباية بنجاح', 'id' => $pdo->lastInsertId()]);
        }
    }

    sendJSONResponse(['success' => true, 'message' => 'تم تنفيذ العملية في النمط المحلي']);
}

sendJSONResponse(['error' => 'طريقة الطلب غير مدعومة'], 405);
