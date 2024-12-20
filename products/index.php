<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil semua produk
$products = $ProductsCollection->find()->toArray();
?>

<style>
    :root {
        --dark-gradient: linear-gradient(to bottom, rgba(0,0,0,0.95), rgba(0,0,0,0.98));
        --card-bg: rgba(255, 255, 255, 0.05);
        --accent: #C5A880;
    }

    .products-container {
        padding: 3rem 0;
        background: var(--dark-gradient);
        min-height: 100vh;
        color: white;
    }

    .product-card {
        background: var(--card-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .product-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .product-content {
        padding: 1.5rem;
    }

    .product-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 0.75rem;
    }

    .product-description {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .product-price {
        color: var(--accent);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .product-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .product-actions .btn {
        flex: 1;
        padding: 0.5rem;
        font-size: 0.9rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }

    .product-actions .btn:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .btn-primary {
        background: var(--accent) !important;
        border: none;
    }

    .btn-primary:hover {
        background: #b89670 !important;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        backdrop-filter: blur(5px);
        background: rgba(255, 255, 255, 0.1);
    }
</style>

<div class="products-container">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Produk</h2>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="product-card">
                    <?php if (isset($product->image_path) && file_exists(__DIR__ . "/../" . $product->image_path)): ?>
                        <img src="../<?php echo $product->image_path; ?>" 
                             class="product-image" 
                             alt="<?php echo $product->name; ?>">
                    <?php else: ?>
                        <img src="../assets/img/default-product.jpg" 
                             class="product-image" 
                             alt="Default Image">
                    <?php endif; ?>
                    
                    <div class="product-content">
                        <h5 class="product-title"><?php echo $product->name; ?></h5>
                        <p class="product-description"><?php echo substr($product->description ?? '', 0, 100) . '...'; ?></p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-price">
                                Rp <?php echo number_format($product->price ?? 0, 0, ',', '.'); ?>
                            </span>
                            <span class="badge bg-<?php echo ($product->stock > 0) ? 'success' : 'danger'; ?>">
                                <?php echo ($product->stock > 0) ? 'Stok: ' . $product->stock : 'Stok Habis'; ?>
                            </span>
                        </div>
                        
                        <div class="product-actions">
                            <a href="detail.php?id=<?php echo $product->_id; ?>" class="btn btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="edit.php?id=<?php echo $product->_id; ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="delete.php?id=<?php echo $product->_id; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 