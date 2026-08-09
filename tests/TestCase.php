<?php
/**
 * tests/TestCase.php
 * إطار عمل بسيط للاختبارات الأحادية (Simple PHP Unit Test Framework)
 */

abstract class TestCase
{
    private int $passed = 0;
    private int $failed = 0;
    private array $failures = [];

    /**
     * تشغيل جميع الدوال الفردية المخولة بالاختبار (التي تبدأ باسم test)
     */
    public function run(): array
    {
        $methods = get_class_methods($this);
        echo "\n\033[1;36m▶ Running " . get_class($this) . "\033[0m\n";

        foreach ($methods as $method) {
            if (strpos($method, 'test') === 0) {
                try {
                    $this->$method();
                    $this->passed++;
                    echo "  \033[32m✔ " . $method . "\033[0m\n";
                } catch (Throwable $e) {
                    $this->failed++;
                    $this->failures[] = [
                        'method' => $method,
                        'message' => $e->getMessage(),
                        'trace' => $e->getFile() . ':' . $e->getLine()
                    ];
                    echo "  \033[31m✖ " . $method . " - " . $e->getMessage() . "\033[0m\n";
                }
            }
        }

        return [
            'class' => get_class($this),
            'passed' => $this->passed,
            'failed' => $this->failed,
            'failures' => $this->failures,
        ];
    }

    /**
     * التأكد من صحة الشرط (Assert True)
     */
    protected function assertTrue(bool $condition, string $message = 'Assertion failed: condition is not true'): void
    {
        if (!$condition) {
            throw new Exception($message);
        }
    }

    /**
     * التأكد من تساوي قيمتين (Assert Equals)
     */
    protected function assertEquals($expected, $actual, string $message = ''): void
    {
        if ($expected !== $actual) {
            $msg = $message ?: sprintf("Expected %s, but got %s", var_export($expected, true), var_export($actual, true));
            throw new Exception($msg);
        }
    }

    /**
     * التأكد من أن القيمة ليست Null (Assert Not Null)
     */
    protected function assertNotNull($actual, string $message = 'Value is null'): void
    {
        if ($actual === null) {
            throw new Exception($message);
        }
    }

    /**
     * التأكد من أن المصفوفة تحتوي على مفتاح معين (Assert Array Has Key)
     */
    protected function assertArrayHasKey(string $key, array $array, string $message = ''): void
    {
        if (!array_key_exists($key, $array)) {
            $msg = $message ?: sprintf("Array does not contain key '%s'", $key);
            throw new Exception($msg);
        }
    }

    /**
     * التأكد من وجود نص معين داخل نص آخر (Assert String Contains)
     */
    protected function assertStringContains(string $needle, string $haystack, string $message = ''): void
    {
        if (strpos($haystack, $needle) === false) {
            $msg = $message ?: sprintf("String '%s' not found in target text", $needle);
            throw new Exception($msg);
        }
    }
}
