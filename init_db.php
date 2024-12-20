<?php
require_once "config.php";

// Membuat collection Categories
$CategoriesCollection->insertMany([
    [
        'name' => 'Meja',
        'description' => 'Berbagai jenis meja'
    ],
    [
        'name' => 'Kursi',
        'description' => 'Berbagai jenis kursi'
    ],
    [
        'name' => 'Lemari',
        'description' => 'Berbagai jenis lemari'
    ]
]);

// Membuat collection Products
$ProductsCollection->insertMany([
    [
        'name' => 'Meja Makan',
        'category_id' => 'Meja',
        'price' => 2000000,
        'stock' => 10,
        'description' => 'Meja makan kayu jati'
    ],
    [
        'name' => 'Kursi Kantor',
        'category_id' => 'Kursi', 
        'price' => 1500000,
        'stock' => 15,
        'description' => 'Kursi kantor ergonomis'
    ]
]);

// Membuat collection Customers
$CustomersCollection->insertMany([
    [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '08123456789',
        'address' => 'Jl. Contoh No. 123'
    ]
]);

// Membuat collection Orders
$OrdersCollection->insertMany([
    [
        'customer_id' => 'john@example.com',
        'order_date' => new MongoDB\BSON\UTCDateTime(),
        'items' => [
            [
                'product_id' => 'Meja Makan',
                'quantity' => 1,
                'price' => 2000000
            ]
        ],
        'total' => 2000000,
        'status' => 'pending'
    ]
]);

echo "Database dan collections berhasil dibuat!";
?>
