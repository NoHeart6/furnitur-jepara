<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil ID produk dari URL
$productId = new MongoDB\BSON\ObjectId($_GET['id']);

// Mengambil detail produk
$product = $ProductsCollection->findOne(['_id' => $productId]);

// Mengambil informasi kategori
$category = $CategoriesCollection->findOne(['name' => $product->category_id]);
?>

<div class="container py-5">
    <div class="mb-4">
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php if (isset($product->image_path) && file_exists(__DIR__ . "/../" . $product->image_path)): ?>
                <img src="../<?php echo $product->image_path; ?>" 
                     class="img-fluid rounded shadow" 
                     alt="<?php echo $product->name; ?>"
                     style="width: 100%; max-height: 500px; object-fit: cover;">
            <?php else: ?>
                <img src="../assets/img/default-product.jpg" 
                     class="img-fluid rounded shadow" 
                     alt="Default Image"
                     style="width: 100%; max-height: 500px; object-fit: cover;">
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h1 class="mb-3"><?php echo $product->name; ?></h1>
            <p class="text-muted">Kategori: <?php echo $product->category_id; ?></p>
            
            <h2 class="text-primary mb-3">
                Rp <?php echo number_format($product->price, 0, ',', '.'); ?>
            </h2>
            
            <p class="mb-4">
                <span class="badge bg-<?php echo $product->stock > 0 ? 'success' : 'danger'; ?>">
                    <?php echo $product->stock > 0 ? 'Stok Tersedia' : 'Stok Habis'; ?>
                </span>
                <span class="ms-2"><?php echo $product->stock; ?> unit</span>
            </p>
            
            <div class="mb-4">
                <h4>Deskripsi Produk</h4>
                <p class="text-justify"><?php echo nl2br($product->description); ?></p>
            </div>

            <div class="d-grid gap-2">
                <?php if ($product->stock > 0): ?>
                    <button class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                    </button>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg" disabled>
                        <i class="fas fa-shopping-cart"></i> Stok Habis
                    </button>
                <?php endif; ?>
                
                <a href="https://wa.me/6281234567890?text=Saya tertarik dengan produk <?php echo urlencode($product->name); ?>" 
                   class="btn btn-success btn-lg">
                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian Spesifikasi Produk -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Spesifikasi Produk</h3>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th width="200">Nama Produk</th>
                        <td><?php echo $product->name; ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><?php echo $product->category_id; ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td><?php echo $product->stock; ?> unit</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp <?php echo number_format($product->price, 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 