<?php
/**
 * tests/Unit/DBTest.php
 * اختبارات الاتصال بقاعدة البيانات والإعدادات
 */

require_once __DIR__ . '/../TestCase.php';
require_once __DIR__ . '/../../includes/db.php';

class DBTest extends TestCase
{
    /**
     * اختبار وجود الثوابت الأساسية بقاعدة البيانات
     */
    public function testDatabaseConstantsDefined(): void
    {
        $this->assertTrue(defined('DB_HOST'), 'DB_HOST constant should be defined');
        $this->assertTrue(defined('DB_NAME'), 'DB_NAME constant should be defined');
        $this->assertTrue(defined('DB_USER'), 'DB_USER constant should be defined');
        $this->assertEquals('lareen_abaya', DB_NAME, 'Database name should be lareen_abaya');
    }

    /**
     * اختبار دالة الاتصال getDBConnection
     */
    public function testDBConnectionFunction(): void
    {
        $pdo = getDBConnection();
        // ينبغي أن تعيد إما كائن PDO أو null حمايةً للتراجع إلى JSON
        $this->assertTrue($pdo instanceof PDO || $pdo === null, 'getDBConnection should return PDO instance or null');
    }
}
