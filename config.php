<?php

require_once __DIR__ . "/vendor/autoload.php";

//memilih database mongoDB yang bernama furniture
$db = (new MongoDB\Client)->furniture;

//memilih collection bernama categories di database bernama furniture
$CategoriesCollection = $db->Categories;

//memilih collection bernama customers di database bernama furniture
$CustomersCollection = $db->Customers;

//memilih collection bernama orders di database bernama furniture
$OrdersCollection = $db->Orders;

//memilih collection bernama Product di database bernama furniture
$ProductsCollection = $db->Products;

?>