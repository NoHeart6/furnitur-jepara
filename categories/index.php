<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil semua kategori
$categories = $CategoriesCollection->find()->toArray();
?>

<style>
    :root {
        --dark-gradient: linear-gradient(to bottom, #000000, #141414);
        --card-bg: rgba(15, 15, 15, 0.9);
        --accent: #C5A880;
        --text-primary: rgba(255, 255, 255, 0.9);
        --text-secondary: rgba(255, 255, 255, 0.7);
        --blur-effect: blur(10px);
    }

    body {
        background: #000000;
    }

    .categories-container {
        padding: 3rem 0;
        background: var(--dark-gradient);
        min-height: 100vh;
    }

    .header-container {
        background: var(--card-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-container h2 {
        color: var(--text-primary);
        margin: 0;
        font-weight: 600;
    }

    .category-card {
        background: var(--card-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .category-name {
        color: var(--text-primary);
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .category-description {
        color: var(--text-secondary);
        margin-bottom: 1rem;
    }

    .btn {
        padding: 0.5rem 1.2rem;
        font-size: 0.95rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: var(--accent) !important;
        border: none;
    }

    .btn-primary:hover {
        background: #b89670 !important;
        transform: translateY(-2px);
    }

    .category-actions {
        display: flex;
        gap: 0.5rem;
    }

    .category-actions .btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    .category-actions .btn:hover {
        background: rgba(255, 255, 255, 0.2);
    }
</style>

<div class="categories-container">
    <div class="container">
        <div class="header-container">
            <h2>Daftar Kategori</h2>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="row">
            <?php foreach ($categories as $category): ?>
            <div class="col-md-6 mb-4">
                <div class="category-card">
                    <h3 class="category-name"><?php echo $category->name; ?></h3>
                    <p class="category-description"><?php echo $category->description; ?></p>
                    <div class="category-actions">
                        <a href="edit.php?id=<?php echo $category->_id; ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="delete.php?id=<?php echo $category->_id; ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 