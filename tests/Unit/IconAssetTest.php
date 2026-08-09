<?php
/**
 * tests/Unit/IconAssetTest.php
 * اختبار وجود وقواعد نظام الأيقونات المحلي (Offline SVG Icons System)
 */

require_once __DIR__ . '/../TestCase.php';

class IconAssetTest extends TestCase
{
    /**
     * اختبار وجود ملف التنسيق الأيقوني وقواعد الـ SVG الاحتياطية
     */
    public function testIconStyleRulesExist(): void
    {
        $cssPath = __DIR__ . '/../../assets/css/style.css';
        $this->assertTrue(file_exists($cssPath), 'style.css file must exist');

        $cssContent = file_get_contents($cssPath);

        // التأكد من وجود قواعد الـ SVG Data URI للأيقونات الرئيسية
        $this->assertStringContains('OFFLINE ICON FALLBACK SYSTEM', $cssContent, 'Offline icon fallback system section must exist in style.css');
        $this->assertStringContains('i.fa-whatsapp', $cssContent, 'WhatsApp icon CSS rule must exist');
        $this->assertStringContains('i.fa-instagram', $cssContent, 'Instagram icon CSS rule must exist');
        $this->assertStringContains('i.fa-facebook', $cssContent, 'Facebook icon CSS rule must exist');
        $this->assertStringContains('i.fa-tiktok', $cssContent, 'TikTok icon CSS rule must exist');
        $this->assertStringContains('i.fa-snapchat', $cssContent, 'Snapchat icon CSS rule must exist');
        $this->assertStringContains('i.fa-shopping-bag', $cssContent, 'Shopping Bag icon CSS rule must exist');
        $this->assertStringContains('i.fa-search', $cssContent, 'Search icon CSS rule must exist');
    }

    /**
     * اختبار وجود وسوم الـ SVG المضمنة في الواجهة الرئيسية index.php
     */
    public function testIndexInlineSvgIcons(): void
    {
        $indexPath = __DIR__ . '/../../index.php';
        $this->assertTrue(file_exists($indexPath), 'index.php must exist');

        $indexContent = file_get_contents($indexPath);

        $this->assertStringContains('hero-social-bar-section', $indexContent, 'Hero social bar section must exist in index.php');
        $this->assertStringContains('<svg', $indexContent, 'Inline SVG icons must be present in index.php');
        $this->assertStringContains('hero-social-whatsapp', $indexContent, 'WhatsApp social link ID must exist');
        $this->assertStringContains('hero-social-instagram', $indexContent, 'Instagram social link ID must exist');
    }
}
