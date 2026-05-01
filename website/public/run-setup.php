<?php
/**
 * ⚠️ FILE SEMENTARA - HAPUS SETELAH SETUP SELESAI!
 * Akses via: https://tportfolio.wuaze.com/run-setup.php
 */

// Keamanan sederhana — ganti password ini
$secret = $_GET['key'] ?? '';
if ($secret !== 'setup123') {
    die('<h2>❌ Akses ditolak. Tambahkan ?key=setup123 di URL</h2>');
}

define('LARAVEL_START', microtime(true));
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo '<style>body{font-family:monospace;background:#111;color:#0f0;padding:20px}
pre{background:#222;padding:15px;border-radius:5px;white-space:pre-wrap}
h2{color:#ff0}button{background:#333;color:#0f0;border:1px solid #0f0;padding:10px 20px;cursor:pointer;margin:5px}</style>';
echo '<h1>🚀 Laravel Setup Runner</h1>';
echo '<p style="color:red">⚠️ HAPUS FILE INI SETELAH SELESAI!</p>';

$commands = [
    'migrate --force'      => '📦 Migrate Database',
    'storage:link'         => '🔗 Storage Link',
    'config:clear'         => '🗑️ Clear Config Cache',
    'cache:clear'          => '🗑️ Clear Cache',
    'view:clear'           => '🗑️ Clear View Cache',
    'route:clear'          => '🗑️ Clear Route Cache',
    'optimize'             => '⚡ Optimize (Cache Config+Routes)',
];

$run = $_GET['cmd'] ?? null;

if ($run && array_key_exists($run, $commands)) {
    echo "<h2>▶ Menjalankan: php artisan $run</h2><pre>";
    $exitCode = $kernel->call($run);
    echo $kernel->output();
    echo "Exit code: $exitCode";
    echo "</pre>";
} else {
    echo '<h2>Pilih Perintah yang Ingin Dijalankan:</h2>';
    foreach ($commands as $cmd => $label) {
        $url = "?key=$secret&cmd=" . urlencode($cmd);
        echo "<a href='$url'><button>$label</button></a><br><br>";
    }
    echo '<hr><h3>📋 Urutan yang Disarankan:</h3>';
    echo '<ol style="color:#ccc">
        <li>migrate --force (buat tabel DB)</li>
        <li>storage:link (link folder storage)</li>
        <li>config:clear</li>
        <li>cache:clear</li>
        <li>view:clear</li>
        <li>route:clear</li>
    </ol>';
}

$kernel->terminate(new \Symfony\Component\Console\Input\ArgvInput(), new \Symfony\Component\Console\Output\ConsoleOutput());
