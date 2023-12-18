<?php
require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

define('DEBUG', true);
// Konfigurasi Database
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_DATABASE']);

define('UPLOAD_DIR', 'uploads/');

// Folder penyimpanan cover buku
define('COVER_DIR', 'uploads/cover/');

// Jumlah maksimal Buku/Skripsi yang bisa ditampilkan dalam 1 halaman katalog.
define('MAX_NUMS_ITEM', 10);

// Jumlah maksimal baris tiap tabel
define('LIMIT_ROWS_PER_PAGE', 8);

?>
