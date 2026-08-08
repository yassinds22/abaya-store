<?php
/**
 * AdminController.php
 * -----------------------------------------------
 * يتحكم في منطق المصادقة والـ Routing وتحديد الـ View والمتحكمات الفرعية
 * لنظام لوحة تحكم متجر لارين عباية
 * -----------------------------------------------
 */

require_once __DIR__ . '/CategoryController.php';
require_once __DIR__ . '/ModelController.php';

class AdminController
{
    /**
     * الصفحات المتاحة وملفات الـ View الخاصة بها
     */
    private array $routes = [
        'login'      => __DIR__ . '/../views/login.php',
        'dashboard'  => __DIR__ . '/../views/dashboard.php',
        'categories' => __DIR__ . '/../views/categories/index.php',
        'models'     => __DIR__ . '/../views/models/index.php',
    ];

    /**
     * نقطة الدخول الرئيسية للـ Router
     */
    public function dispatch(): void
    {
        $page = $this->getRequestedPage();

        if ($page === 'login') {
            $this->renderView('login');
            return;
        }

        if ($page === 'categories') {
            $catController = new CategoryController();
            $catController->render();
            return;
        }

        if ($page === 'models') {
            $modelController = new ModelController();
            $modelController->render();
            return;
        }

        $this->renderView('dashboard');
    }

    /**
     * استخراج اسم الصفحة المطلوبة من الـ URL
     */
    private function getRequestedPage(): string
    {
        $page = $_GET['page'] ?? '';

        if (array_key_exists($page, $this->routes)) {
            return $page;
        }

        return 'dashboard';
    }

    /**
     * تحميل وعرض الـ View المطلوب
     */
    private function renderView(string $viewName): void
    {
        $viewPath = $this->routes[$viewName] ?? null;

        if ($viewPath && file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(404);
            echo '<p style="text-align:center; font-family: sans-serif; margin-top: 50px;">الصفحة غير موجودة.</p>';
        }
    }
}
