<?php
require_once __DIR__ . "/../config/config.php";

if (isset($_GET['id'])) {
    $productId = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Hapus produk
    $ProductsCollection->deleteOne(['_id' => $productId]);
}

// Redirect kembali ke halaman daftar produk
header('Location: index.php');
exit;
?> 