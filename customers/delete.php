<?php
require_once __DIR__ . "/../config/config.php";

if (isset($_GET['id'])) {
    $customerId = new MongoDB\BSON\ObjectId($_GET['id']);
    
    // Hapus pelanggan
    $CustomersCollection->deleteOne(['_id' => $customerId]);
}

// Redirect kembali ke halaman daftar pelanggan
header('Location: index.php');
exit;
?> 