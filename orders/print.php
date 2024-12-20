<?php
require_once __DIR__ . "/../config/config.php";

$orderId = new MongoDB\BSON\ObjectId($_GET['id']);
$order = $OrdersCollection->findOne(['_id' => $orderId]);
$customer = $CustomersCollection->findOne(['email' => $order->customer_id]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan #<?php echo $order->_id; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .nota-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .nota-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .company-info {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .customer-info {
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 8px;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                margin: 15mm;
            }
        }
    </style>
</head>
<body>
    <div class="nota-header">
        <div class="nota-title">SETIA FURNITURE</div>
        <div class="company-info">
            Jl. Contoh No. 123, Kota Contoh<br>
            Telp: (021) 1234567<br>
            Email: info@setiafurniture.com
        </div>
    </div>

    <div class="row">
        <div class="col-6 customer-info">
            <strong>Informasi Pelanggan:</strong><br>
            Nama: <?php echo $customer->name; ?><br>
            Email: <?php echo $customer->email; ?><br>
            Telepon: <?php echo $customer->phone; ?><br>
            Alamat: <?php echo $customer->address; ?>
        </div>
        <div class="col-6 text-end">
            <strong>No. Pesanan:</strong> #<?php echo substr($order->_id, -8); ?><br>
            <strong>Tanggal:</strong> <?php echo $order->order_date->toDateTime()->format('d/m/Y H:i'); ?><br>
            <strong>Status:</strong> <?php echo ucfirst($order->status); ?>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th class="text-end">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($order->items as $item): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $item->product_name; ?></td>
                <td class="text-end">Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                <td class="text-center"><?php echo $item->quantity; ?></td>
                <td class="text-end">Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                <td class="text-end"><strong>Rp <?php echo number_format($order->total, 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <?php if (!empty($order->notes)): ?>
    <div class="mt-4">
        <strong>Catatan:</strong><br>
        <?php echo nl2br($order->notes); ?>
    </div>
    <?php endif; ?>

    <div class="footer">
        <p>Terima kasih telah berbelanja di Setia Furniture</p>
        <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
    </div>

    <div class="mt-4 no-print">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Cetak
        </button>
        <button onclick="window.close()" class="btn btn-secondary">
            <i class="fas fa-times"></i> Tutup
        </button>
    </div>

    <script>
        // Otomatis memunculkan dialog cetak saat halaman dimuat
        window.onload = function() {
            // Tunggu sebentar agar CSS dimuat dengan sempurna
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html> 