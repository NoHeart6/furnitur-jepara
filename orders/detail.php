<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

$orderId = new MongoDB\BSON\ObjectId($_GET['id']);
$order = $OrdersCollection->findOne(['_id' => $orderId]);
$customer = $CustomersCollection->findOne(['email' => $order->customer_id]);
?>

<div class="container py-5">
    <div class="mb-4">
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <a href="print.php?id=<?php echo $order->_id; ?>" class="btn btn-primary" target="_blank">
            <i class="fas fa-print"></i> Cetak Nota
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title mb-0">Detail Pesanan</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informasi Pesanan</h5>
                    <p>
                        <strong>Tanggal:</strong> <?php echo $order->order_date->toDateTime()->format('d/m/Y H:i'); ?><br>
                        <strong>Status:</strong> 
                        <span class="badge bg-<?php 
                            echo $order->status === 'pending' ? 'warning' : 
                                 ($order->status === 'completed' ? 'success' : 'secondary'); 
                        ?>">
                            <?php echo ucfirst($order->status); ?>
                        </span><br>
                        <strong>Total:</strong> Rp <?php echo number_format($order->total, 0, ',', '.'); ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Pelanggan</h5>
                    <p>
                        <strong>Nama:</strong> <?php echo $customer->name; ?><br>
                        <strong>Email:</strong> <?php echo $customer->email; ?><br>
                        <strong>Telepon:</strong> <?php echo $customer->phone; ?><br>
                        <strong>Alamat:</strong> <?php echo $customer->address; ?>
                    </p>
                </div>
            </div>

            <h5>Detail Item</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($order->items as $item): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $item->product_name; ?></td>
                            <td>Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                            <td><?php echo $item->quantity; ?></td>
                            <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rp <?php echo number_format($order->total, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <?php if (!empty($order->notes)): ?>
            <div class="mt-4">
                <h5>Catatan</h5>
                <p><?php echo nl2br($order->notes); ?></p>
            </div>
            <?php endif; ?>

            <div class="mt-4">
                <a href="edit.php?id=<?php echo $order->_id; ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Pesanan
                </a>
                <a href="delete.php?id=<?php echo $order->_id; ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                    <i class="fas fa-trash"></i> Hapus Pesanan
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 