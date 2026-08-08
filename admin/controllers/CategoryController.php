<?php
/**
 * admin/controllers/CategoryController.php
 * المتحكم الخاص بإدارة الأقسام (Categories)
 */

class CategoryController
{
    /**
     * عرض صفحة أو مكون إدارة الأقسام
     */
    public function render(): void
    {
        $viewPath = __DIR__ . '/../views/categories/index.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo '<p style="color: red;">تعذر العثور على واجهة الأقسام</p>';
        }
    }
}
