<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

$customerId = new MongoDB\BSON\ObjectId($_GET['id']);
$customer = $CustomersCollection->findOne(['_id' => $customerId]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
    ];

    $CustomersCollection->updateOne(
        ['_id' => $customerId],
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
                    <h3 class="card-title mb-0">Edit Pelanggan</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php echo $customer->name; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo $customer->email; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?php echo $customer->phone; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" 
                                     rows="3" required><?php echo $customer->address; ?></textarea>
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