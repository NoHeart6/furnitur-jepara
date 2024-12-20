<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

// Mengambil semua pelanggan
$customers = $CustomersCollection->find()->toArray();
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
    }

    .customers-container {
        padding: 3rem 0;
        background: var(--dark-gradient);
        min-height: 100vh;
        color: var(--text-primary);
    }

    /* Header Container */
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

    /* Table Styles */
    .table-responsive {
        background: var(--card-bg);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        color: var(--text-primary);
    }

    .table th {
        background: var(--table-header);
        color: var(--accent);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-weight: 600;
        padding: 1.2rem 1rem;
        white-space: nowrap;
    }

    .table td {
        background: var(--table-body);
        border-color: rgba(255, 255, 255, 0.05);
        color: var(--text-secondary);
        padding: 1rem;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover td {
        background: var(--table-hover);
    }

    /* Button Styles */
    .btn {
        padding: 0.5rem 1.2rem;
        font-size: 0.95rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: var(--accent) !important;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: #b89670 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    .btn-group .btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    .btn-group .btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .btn i {
        margin-right: 0.5rem;
    }
</style>

<div class="customers-container">
    <div class="container">
        <div class="header-container">
            <h2>Daftar Pelanggan</h2>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pelanggan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $customer->name; ?></td>
                        <td><?php echo $customer->email; ?></td>
                        <td><?php echo $customer->phone; ?></td>
                        <td><?php echo $customer->address; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="edit.php?id=<?php echo $customer->_id; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="delete.php?id=<?php echo $customer->_id; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 