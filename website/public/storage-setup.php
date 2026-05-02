<?php
/**
 * Storage Link Setup Script
 * Akses: https://tportfolio.wuaze.com/storage-setup.php?key=setup123
 * HAPUS FILE INI SETELAH DIPAKAI!
 */

$secret = $_GET['key'] ?? '';
if ($secret !== 'setup123') {
    http_response_code(403);
    die('Forbidden');
}

$htdocsDir  = __DIR__;                                    // htdocs/
$storageDir = dirname(__DIR__) . '/laravel_app/storage/app/public';
$linkPath   = $htdocsDir . '/storage';

echo '<style>body{font-family:monospace;background:#111;color:#0f0;padding:20px}
pre{background:#222;padding:15px;border-radius:5px}
.ok{color:#0f0}.err{color:red}.warn{color:orange}</style>';
echo '<h2>🔗 Storage Setup</h2>';

// Cek apakah sudah ada
if (is_link($linkPath)) {
    $target = readlink($linkPath);
    if ($target === $storageDir) {
        echo "<p class='ok'>✅ Symlink sudah ada dan benar → $target</p>";
    } else {
        echo "<p class='warn'>⚠️ Symlink ada tapi salah arah: $target</p>";
        unlink($linkPath);
        echo "<p>Menghapus symlink lama...</p>";
    }
}

if (is_dir($linkPath) && !is_link($linkPath)) {
    echo "<p class='warn'>⚠️ /storage adalah folder biasa (bukan symlink)</p>";
    echo "<p>Folder ini mungkin berisi file yang diupload sebelumnya.</p>";
    echo "<p>File-file ini akan dipindah ke laravel_app/storage/app/public/</p>";

    // Pindahkan file dari htdocs/storage ke laravel_app/storage/app/public
    if (!is_dir($storageDir)) {
        mkdir($storageDir, 0775, true);
    }
    
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($linkPath, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    $moved = 0;
    foreach ($files as $file) {
        $relativePath = substr($file->getRealPath(), strlen($linkPath));
        $destination  = $storageDir . $relativePath;
        $destDir      = dirname($destination);
        if (!is_dir($destDir)) {
            mkdir($destDir, 0775, true);
        }
        if (rename($file->getRealPath(), $destination)) {
            $moved++;
        }
    }
    echo "<p class='ok'>✅ Dipindah $moved file ke laravel_app/storage/app/public/</p>";

    // Hapus folder lama
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object !== '.' && $object !== '..') {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object)) {
                        rrmdir($dir . DIRECTORY_SEPARATOR . $object);
                    } else {
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }
    rrmdir($linkPath);
}

// Buat symlink
if (!file_exists($linkPath) && !is_link($linkPath)) {
    if (!is_dir($storageDir)) {
        mkdir($storageDir, 0775, true);
    }

    if (symlink($storageDir, $linkPath)) {
        echo "<p class='ok'>✅ Symlink berhasil dibuat!</p>";
        echo "<pre>$linkPath → $storageDir</pre>";
    } else {
        echo "<p class='err'>❌ Gagal buat symlink. Coba buat manual di File Manager.</p>";
        echo "<pre>Dari: $linkPath\nKe:   $storageDir</pre>";
    }
}

echo '<hr>';
echo '<h3>📁 Status Storage:</h3>';
echo '<pre>';
echo 'htdocs/storage  : ' . (is_link($linkPath) ? '✅ symlink ke ' . readlink($linkPath) : (is_dir($linkPath) ? '📁 folder' : '❌ tidak ada')) . "\n";
echo 'Target path     : ' . (is_dir($storageDir) ? '✅ ada' : '❌ tidak ada') . "\n";
echo 'Isi storage     : ' . (is_dir($storageDir) ? count(glob($storageDir . '/*')) . ' item' : '-') . "\n";
echo '</pre>';
echo '<p style="color:red">⚠️ HAPUS FILE INI SETELAH SELESAI!</p>';
