<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil daftar pelanggan dan produk untuk dropdown
$customers = $CustomersCollection->find()->toArray();
$products = $ProductsCollection->find()->toArray();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menghitung total harga
    $total = 0;
    $items = [];
    
    foreach ($_POST['items'] as $item) {
        if (!empty($item['product_id']) && !empty($item['quantity'])) {
            $product = $ProductsCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($item['product_id'])]);
            $subtotal = $product->price * (int)$item['quantity'];
            $total += $subtotal;
            
            $items[] = [
                'product_id' => $item['product_id'],
                'product_name' => $product->name,
                'quantity' => (int)$item['quantity'],
                'price' => $product->price,
                'subtotal' => $subtotal
            ];
        }
    }

    $order = [
        'customer_id' => $_POST['customer_id'],
        'order_date' => new MongoDB\BSON\UTCDateTime(),
        'items' => $items,
        'total' => $total,
        'status' => 'pending',
        'notes' => $_POST['notes']
    ];

    $OrdersCollection->insertOne($order);
    header('Location: index.php');
    exit;
}
?>

<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">Tambah Pesanan Baru</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Pelanggan</label>
                    <select class="form-select" id="customer_id" name="customer_id" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer->email; ?>">
                            <?php echo $customer->name; ?> (<?php echo $customer->email; ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="items-container">
                    <h4 class="mb-3">Item Pesanan</h4>
                    <div class="item-row mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-select" name="items[0][product_id]" required>
                                    <option value="">Pilih Produk</option>
                                    <?php foreach ($products as $product): ?>
                                    <option value="<?php echo $product->_id; ?>">
                                        <?php echo $product->name; ?> - Rp <?php echo number_format($product->price, 0, ',', '.'); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="items[0][quantity]" 
                                       placeholder="Jumlah" min="1" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-item" style="display: none;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-item">
                    <i class="fas fa-plus"></i> Tambah Item
                </button>

                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let itemCount = 1;

document.getElementById('add-item').addEventListener('click', function() {
    const container = document.getElementById('items-container');
    const newRow = document.createElement('div');
    newRow.className = 'item-row mb-3';
    newRow.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <select class="form-select" name="items[${itemCount}][product_id]" required>
                    <option value="">Pilih Produk</option>
                    <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product->_id; ?>">
                        <?php echo $product->name; ?> - Rp <?php echo number_format($product->price, 0, ',', '.'); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="items[${itemCount}][quantity]" 
                       placeholder="Jumlah" min="1" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-item">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newRow);
    itemCount++;

    // Show remove button for first item if there's more than one item
    if (itemCount > 1) {
        document.querySelector('.remove-item').style.display = 'block';
    }
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item') || 
        e.target.parentElement.classList.contains('remove-item')) {
        const row = e.target.closest('.item-row');
        row.remove();
        itemCount--;

        // Hide remove button for first item if only one item remains
        if (itemCount === 1) {
            document.querySelector('.remove-item').style.display = 'none';
        }
    }
});
</script>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 