<?php
require_once __DIR__ . "/../config/config.php";

if (isset($_GET['id'])) {
    $categoryId = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Hapus kategori
    $CategoriesCollection->deleteOne(['_id' => $categoryId]);
}

// Redirect kembali ke halaman daftar kategori
header('Location: index.php');
exit;