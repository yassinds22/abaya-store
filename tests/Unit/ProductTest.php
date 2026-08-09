<?php
/**
 * tests/Unit/ProductTest.php
 * اختبار بنية بيانات المنتجات والملفات الاحتياطية
 */

require_once __DIR__ . '/../TestCase.php';

class ProductTest extends TestCase
{
    /**
     * اختبار وجود وقراءة ملف المنتجات الاحتياطي JSON
     */
    public function testProductJsonDataFile(): void
    {
        $jsonPath = __DIR__ . '/../../data/products.json';
        $this->assertTrue(file_exists($jsonPath), 'products.json file must exist');

        $content = file_get_contents($jsonPath);
        $products = json_decode($content, true);

        $this->assertTrue(is_array($products), 'Decoded JSON content should be an array');
        $this->assertTrue(count($products) > 0, 'Products list should not be empty');

        $firstProduct = $products[0];
        $this->assertArrayHasKey('id', $firstProduct, 'Product must have an id');
        $this->assertArrayHasKey('name', $firstProduct, 'Product must have a name');
        $this->assertArrayHasKey('price', $firstProduct, 'Product must have a price');
    }
}
