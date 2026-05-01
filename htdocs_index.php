<?php

/**
 * Redirect semua request ke folder public Laravel
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Cek apakah file statis ada langsung di public/
$publicPath = __DIR__ . '/website/public';

if ($uri !== '/' && file_exists($publicPath . $uri)) {
    return false;
}

// Teruskan semua request ke index.php Laravel
$_SERVER['SCRIPT_FILENAME'] = $publicPath . '/index.php';
$_SERVER['SCRIPT_NAME'] = '/website/public/index.php';

require_once $publicPath . '/index.php';
