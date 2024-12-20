<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil daftar kategori untuk dropdown
$categories = $CategoriesCollection->find()->toArray();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_path = null;
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $file_type = $_FILES['image']['type'];
        
        if (in_array($file_type, $allowed_types)) {
            $upload_dir = __DIR__ . "/../assets/img/products/";
            
            // Buat direktori jika belum ada
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Generate nama file yang unik
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $file_name = uniqid('product_') . '.' . $file_extension;
            $upload_path = $upload_dir . $file_name;

            // Upload gambar
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_path = "assets/img/products/" . $file_name;
            } else {
                echo "<script>alert('Gagal mengupload gambar!');</script>";
            }
        } else {
            echo "<script>alert('Tipe file tidak diizinkan! Gunakan JPG, JPEG, atau PNG.');</script>";
        }
    }

    $product = [
        'name' => $_POST['name'],
        'category_id' => $_POST['category_id'],
        'price' => (int) $_POST['price'],
        'stock' => (int) $_POST['stock'],
        'description' => $_POST['description'],
        'image_path' => $image_path
    ];

    $ProductsCollection->insertOne($product);
    header('Location: index.php');
    exit;
}
?>

<div class="container py-5">
    <h2 class="mb-4">Tambah Produk Baru</h2>

    <form action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->name; ?>">
                    <?php echo $category->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 