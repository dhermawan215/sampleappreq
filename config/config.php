<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sampleapp');

$conn = mysqli_connect('localhost', 'root', '', 'sampleapp') or die(mysqli_error($conn));

if (mysqli_connect_errno()) {
    echo "koneksi database gagal! : " . mysqli_connect_error();
}
