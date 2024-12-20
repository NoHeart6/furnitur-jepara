<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil ID produk dari URL
$productId = new MongoDB\BSON\ObjectId($_GET['id']);

// Mengambil data produk yang akan diedit
$product = $ProductsCollection->findOne(['_id' => $productId]);

// Mengambil daftar kategori untuk dropdown
$categories = $CategoriesCollection->find()->toArray();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle image upload
    $image_path = $product->image_path ?? null; // Keep existing image if no new upload
    
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

            // Hapus gambar lama jika ada
            if (isset($product->image_path) && file_exists(__DIR__ . "/../" . $product->image_path)) {
                unlink(__DIR__ . "/../" . $product->image_path);
            }

            // Upload gambar baru
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_path = "assets/img/products/" . $file_name;
            } else {
                echo "<script>alert('Gagal mengupload gambar!');</script>";
            }
        } else {
            echo "<script>alert('Tipe file tidak diizinkan! Gunakan JPG, JPEG, atau PNG.');</script>";
        }
    }

    $updateData = [
        'name' => $_POST['name'],
        'category_id' => $_POST['category_id'],
        'price' => (int) $_POST['price'],
        'stock' => (int) $_POST['stock'],
        'description' => $_POST['description'],
        'image_path' => $image_path
    ];

    $ProductsCollection->updateOne(
        ['_id' => $productId],
        ['$set' => $updateData]
    );

    header('Location: index.php');
    exit;
}
?>

<div class="container py-5">
    <h2 class="mb-4">Edit Produk</h2>

    <form action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="<?php echo $product->name; ?>" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->name; ?>" 
                        <?php echo ($category->name === $product->category_id) ? 'selected' : ''; ?>>
                    <?php echo $category->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" 
                   value="<?php echo $product->price; ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" 
                   value="<?php echo $product->stock; ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" 
                      rows="3" required><?php echo $product->description; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <?php if (isset($product->image_path)): ?>
            <div class="mb-2">
                <img src="../<?php echo $product->image_path; ?>" 
                     alt="Current image" class="img-thumbnail" style="max-height: 200px">
                <p class="text-muted">Gambar saat ini</p>
            </div>
            <?php endif; ?>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 