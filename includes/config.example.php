<?php
/**
 * includes/config.local.php (نسخة نموذج الاستضافة - Example Config)
 * قم بنسخ هذا الملف وتسميته config.local.php وضع بيانات قاعدة البيانات الخاصة بالاستضافة (cPanel / Hosting)
 */

define('DB_HOST', 'localhost');              // غالباً تكون localhost في cPanel
define('DB_NAME', 'your_cpanel_dbname');     // اسم قاعدة البيانات في الاستضافة (مثال: u123456_lareen)
define('DB_USER', 'your_cpanel_dbuser');     // اسم مستخدم قاعدة البيانات (مثال: u123456_lareen_user)
define('DB_PASS', 'your_strong_password');   // كلمة سر قاعدة البيانات في الاستضافة
