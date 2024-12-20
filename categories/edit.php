<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

$categoryId = new MongoDB\BSON\ObjectId($_GET['id']);
$category = $CategoriesCollection->findOne(['_id' => $categoryId]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [
        'name' => $_POST['name'],
        'description' => $_POST['description']
    ];

    $CategoriesCollection->updateOne(
        ['_id' => $categoryId],
        ['$set' => $updateData]
    );

    header('Location: index.php');
    exit;
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Edit Kategori</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo $category->name; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" required><?php echo $category->description; ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 