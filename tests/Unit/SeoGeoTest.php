<?php
/**
 * tests/Unit/SeoGeoTest.php
 * اختبارات الأرشفة والظهور في محركات البحث والذكاء الاصطناعي (SEO & GEO & Local SEO)
 */

require_once __DIR__ . '/../TestCase.php';

class SeoGeoTest extends TestCase
{
    /**
     * اختبار وجود وسوم SEO و GEO و Schema.org في الهيدر
     */
    public function testSeoAndGeoHeaderTags(): void
    {
        $headerPath = __DIR__ . '/../../includes/header.php';
        $content = file_get_contents($headerPath);

        $this->assertStringContains('geo.region', $content, 'Header must contain Geo Local SEO region tag');
        $this->assertStringContains('geo.placename', $content, 'Header must contain Geo placename tag');
        $this->assertStringContains('og:title', $content, 'Header must contain Open Graph title tag');
        $this->assertStringContains('twitter:card', $content, 'Header must contain Twitter card tag');
        $this->assertStringContains('application/ld+json', $content, 'Header must contain Schema.org JSON-LD structured data');
        $this->assertStringContains('ClothingStore', $content, 'Schema.org must classify store as ClothingStore');
    }

    /**
     * اختبار وجود ملف خريطة الموقع sitemap.xml
     */
    public function testSitemapFileExists(): void
    {
        $sitemapPath = __DIR__ . '/../../sitemap.xml';
        $this->assertTrue(file_exists($sitemapPath), 'sitemap.xml file must exist');

        $content = file_get_contents($sitemapPath);
        $this->assertStringContains('<urlset', $content, 'sitemap.xml must be valid XML urlset');
    }

    /**
     * اختبار وجود ملف الفهرسة robots.txt وعناكب الذكاء الاصطناعي
     */
    public function testRobotsFileExists(): void
    {
        $robotsPath = __DIR__ . '/../../robots.txt';
        $this->assertTrue(file_exists($robotsPath), 'robots.txt file must exist');

        $content = file_get_contents($robotsPath);
        $this->assertStringContains('Sitemap:', $content, 'robots.txt must point to sitemap');
        $this->assertStringContains('GPTBot', $content, 'robots.txt must allow AI crawler GPTBot');
    }
}
