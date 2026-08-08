<?php
/**
 * admin/controllers/ModelController.php
 * المتحكم الخاص بإدارة الموديلات والتصاميم (Models)
 */

class ModelController
{
    /**
     * عرض صفحة أو مكون إدارة الموديلات
     */
    public function render(): void
    {
        $viewPath = __DIR__ . '/../views/models/index.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo '<p style="color: red;">تعذر العثور على واجهة الموديلات</p>';
        }
    }
}
