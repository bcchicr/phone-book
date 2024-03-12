<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap.php';

$sqlPath = __DIR__ . '/db.sql';
$sql = file_get_contents($sqlPath);
if ($sql === false) {
    exit("Unable to read file {$sqlPath}\n");
}
/**
 * @var PDO
 */
$pdo = $app->get(PDO::class);

try {
    $pdo->exec($sql);
    echo "Successfully loaded sql dump\n";
} catch (PDOException $e) {
    exit("Unable to load sql dump: " . $e->getMessage() . "\n");
}
