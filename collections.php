<?php
require_once "config/config.php";
require_once "includes/header.php";
require_once "includes/navbar.php";

// Mengambil semua produk
$products = $ProductsCollection->find();
?>

<div class="container py-5">
    <div class="mb-4">
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <h2 class="text-center mb-4">Koleksi Produk Kami</h2>
    
    <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if (isset($product->image_path) && file_exists($product->image_path)): ?>
                    <img src="<?php echo $product->image_path; ?>" 
                         class="card-img-top" 
                         alt="<?php echo $product->name; ?>"
                         style="height: 250px; object-fit: cover;">
                <?php else: ?>
                    <img src="assets/img/default-product.jpg" 
                         class="card-img-top" 
                         alt="Default Image"
                         style="height: 250px; object-fit: cover;">
                <?php endif; ?>
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo $product->name; ?></h5>
                    <p class="card-text text-muted">
                        <?php echo substr($product->description ?? '', 0, 100) . '...'; ?>
                    </p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-primary">
                                Rp <?php echo number_format($product->price ?? 0, 0, ',', '.'); ?>
                            </h6>
                            <span class="badge bg-<?php echo ($product->stock > 0) ? 'success' : 'danger'; ?>">
                                <?php echo ($product->stock > 0) ? 'Stok: ' . $product->stock : 'Stok Habis'; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once "includes/footer.php"; ?> 