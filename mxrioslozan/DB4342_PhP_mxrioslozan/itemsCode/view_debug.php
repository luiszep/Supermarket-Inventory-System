<?php
$path = __DIR__ . '/create_item_debug.txt';
if (!file_exists($path)) { echo 'Debug file not found: ' . htmlspecialchars($path); exit; }
echo '<pre>' . htmlspecialchars(file_get_contents($path)) . '</pre>';
?>