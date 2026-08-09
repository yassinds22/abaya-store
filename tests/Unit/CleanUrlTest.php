<?php
/**
 * tests/Unit/CleanUrlTest.php
 * اختبار قواعد إعادة التوجيه وروابط الصفحات النظيفة (.htaccess Clean URLs)
 */

require_once __DIR__ . '/../TestCase.php';

class CleanUrlTest extends TestCase
{
    /**
     * اختبار وجود ملف .htaccess وقواعد mod_rewrite
     */
    public function testHtaccessFileExists(): void
    {
        $htaccessPath = __DIR__ . '/../../.htaccess';
        $this->assertTrue(file_exists($htaccessPath), '.htaccess file must exist in project root');

        $content = file_get_contents($htaccessPath);
        $this->assertStringContains('RewriteEngine On', $content, '.htaccess must enable RewriteEngine');
        $this->assertStringContains('RewriteCond %{REQUEST_FILENAME}.php -f', $content, '.htaccess must rewrite clean URLs to .php files');
    }

    /**
     * اختبار خلو الروابط في القائمة الرئيسية من ملحق .php
     */
    public function testHeaderLinksAreClean(): void
    {
        $headerPath = __DIR__ . '/../../includes/header.php';
        $content = file_get_contents($headerPath);

        $this->assertStringContains('href="<?= BASE_URL ?>products"', $content, 'Products link in header should be clean (without .php)');
        $this->assertStringContains('href="<?= BASE_URL ?>about"', $content, 'About link in header should be clean (without .php)');
        $this->assertStringContains('href="<?= BASE_URL ?>contact"', $content, 'Contact link in header should be clean (without .php)');
        $this->assertStringContains('href="<?= BASE_URL ?>qr-code"', $content, 'QR code link in header should be clean (without .php)');
    }
}
