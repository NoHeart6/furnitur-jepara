<?php
require_once __DIR__ . "/../config/config.php";

if (isset($_GET['id'])) {
    $orderId = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Hapus pesanan
    $OrdersCollection->deleteOne(['_id' => $orderId]);
}

// Redirect kembali ke halaman daftar pesanan
header('Location: index.php');
exit;
?> 