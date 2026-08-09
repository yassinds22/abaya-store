<?php
/**
 * tests/run_tests.php
 * مشغل الاختبارات الأحادية المتكامل (Unit Test Runner)
 * يعمل مباشرة من السطر البرمجي: php tests/run_tests.php
 */

echo "========================================================\n";
echo "       لارين عباية (Lareen Abaya) - Unit Test Suite       \n";
echo "========================================================\n";

require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/Unit/DBTest.php';
require_once __DIR__ . '/Unit/ProductTest.php';
require_once __DIR__ . '/Unit/IconAssetTest.php';

$testClasses = [
    'DBTest',
    'ProductTest',
    'IconAssetTest',
];

$totalPassed = 0;
$totalFailed = 0;
$allFailures = [];

foreach ($testClasses as $class) {
    /** @var TestCase $testInstance */
    $testInstance = new $class();
    $result = $testInstance->run();

    $totalPassed += $result['passed'];
    $totalFailed += $result['failed'];
    if (!empty($result['failures'])) {
        $allFailures = array_merge($allFailures, $result['failures']);
    }
}

echo "\n--------------------------------------------------------\n";
echo sprintf("RESULTS: Passed: \033[32m%d\033[0m | Failed: \033[31m%d\033[0m | Total: %d\n",
    $totalPassed,
    $totalFailed,
    $totalPassed + $totalFailed
);
echo "--------------------------------------------------------\n";

if ($totalFailed > 0) {
    echo "\033[1;31mFAILURES SUMMARY:\033[0m\n";
    foreach ($allFailures as $fail) {
        echo sprintf("  - %s: %s (at %s)\n", $fail['method'], $fail['message'], $fail['trace']);
    }
    exit(1);
} else {
    echo "\033[1;32m🎉 ALL UNIT TESTS PASSED SUCCESSFULLY!\033[0m\n\n";
    exit(0);
}
