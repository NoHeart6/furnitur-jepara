<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil semua pesanan
$orders = $OrdersCollection->find();
?>

<style>
    :root {
        --dark-gradient: linear-gradient(to bottom, #000000, #141414);
        --card-bg: rgba(15, 15, 15, 0.9);
        --accent: #C5A880;
        --text-primary: rgba(255, 255, 255, 0.9);
        --text-secondary: rgba(255, 255, 255, 0.7);
        --blur-effect: blur(10px);
        --table-header: rgba(10, 10, 10, 0.95);
        --table-body: rgba(15, 15, 15, 0.9);
        --table-hover: rgba(20, 20, 20, 0.95);
    }

    body {
        background: #000000;
        color: var(--text-primary);
    }

    .orders-container {
        padding: 3rem 0;
        background: var(--dark-gradient);
        min-height: 100vh;
    }

    /* Header Container */
    .header-container {
        background: var(--card-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    .header-container h2 {
        color: var(--text-primary);
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Table Container */
    .table-responsive {
        background: var(--card-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    /* Table Styles */
    .table {
        margin-bottom: 0;
    }

    .table th {
        background: var(--table-header);
        color: var(--accent);
        font-weight: 600;
        padding: 1.2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table td {
        background: var(--table-body);
        color: var(--text-secondary);
        padding: 1rem 1.2rem;
        border-color: rgba(255, 255, 255, 0.05);
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover td {
        background: var(--table-hover);
        color: var(--text-primary);
    }

    /* Status Badge */
    .badge {
        padding: 0.6rem 1rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        border-radius: 8px;
    }

    .badge.bg-warning {
        background: rgba(255, 193, 7, 0.2) !important;
        color: #ffd43b;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .badge.bg-success {
        background: rgba(40, 167, 69, 0.2) !important;
        color: #51cf66;
        border: 1px solid rgba(40, 167, 69, 0.3);
    }

    .badge.bg-info {
        background: rgba(23, 162, 184, 0.2) !important;
        color: #3bc9db;
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    /* Button Styles */
    .btn {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .btn-primary {
        background: var(--accent) !important;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: #b89670 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Action Buttons */
    .btn-group {
        display: flex;
        gap: 0.5rem;
    }

    .btn-group .btn {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    .btn-info {
        background: rgba(23, 162, 184, 0.2) !important;
        color: #3bc9db !important;
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    .btn-warning {
        background: rgba(255, 193, 7, 0.2) !important;
        color: #ffd43b !important;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .btn-danger {
        background: rgba(220, 53, 69, 0.2) !important;
        color: #ff6b6b !important;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .btn i {
        margin-right: 0.5rem;
    }

    /* Price Column */
    .price-column {
        color: var(--accent);
        font-weight: 600;
    }

    /* Customer Name */
    .customer-name {
        font-weight: 500;
        color: var(--text-primary);
    }
</style>

<div class="orders-container">
    <div class="container">
        <div class="header-container d-flex justify-content-between align-items-center">
            <h2>Daftar Pesanan</h2>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pesanan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total Items</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    foreach ($orders as $order): 
                        try {
                            // Mengambil informasi pelanggan
                            $customer = $CustomersCollection->findOne(['email' => $order->customer_id]);
                            
                            // Menghitung total items dengan cara yang aman
                            $totalItems = 0;
                            if (isset($order->items) && is_object($order->items)) {
                                foreach ($order->items as $item) {
                                    if (isset($item->quantity)) {
                                        $totalItems += (int)$item->quantity;
                                    }
                                }
                            }
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo isset($order->order_date) ? $order->order_date->toDateTime()->format('d/m/Y H:i') : '-'; ?></td>
                        <td><?php echo $customer ? $customer->name : 'Pelanggan tidak ditemukan'; ?></td>
                        <td><?php echo $totalItems; ?> item</td>
                        <td>Rp <?php echo number_format($order->total ?? 0, 0, ',', '.'); ?></td>
                        <td>
                            <span class="badge bg-<?php 
                                echo isset($order->status) ? (
                                    $order->status === 'pending' ? 'warning' : 
                                    ($order->status === 'completed' ? 'success' : 
                                    ($order->status === 'processing' ? 'info' : 'secondary'))
                                ) : 'secondary'; 
                            ?>">
                                <?php echo isset($order->status) ? ucfirst($order->status) : 'Tidak ada status'; ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="detail.php?id=<?php echo $order->_id; ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="edit.php?id=<?php echo $order->_id; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="delete.php?id=<?php echo $order->_id; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        } catch (Exception $e) {
                            // Log error jika perlu
                            continue;
                        }
                    endforeach; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 