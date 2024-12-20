<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = [
        'name' => $_POST['name'],
        'description' => $_POST['description']
    ];

    $CategoriesCollection->insertOne($category);
    header('Location: index.php');
    exit;
}
?>

<style>
    :root {
        --dark-gradient: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.9));
        --card-bg: rgba(255, 255, 255, 0.1);
        --accent: #C5A880;
        --text-primary: rgba(255, 255, 255, 0.9);
        --text-secondary: rgba(255, 255, 255, 0.7);
        --blur-effect: blur(10px);
    }

    body {
        background: var(--dark-gradient);
        min-height: 100vh;
        color: var(--text-primary);
    }

    .form-container {
        padding: 3rem 0;
    }

    .card {
        background: rgba(28, 28, 28, 0.7);
        backdrop-filter: var(--blur-effect);
        -webkit-backdrop-filter: var(--blur-effect);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    .card-header {
        background: linear-gradient(to bottom, rgba(32, 32, 32, 0.9), rgba(24, 24, 24, 0.9));
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        color: var(--text-primary);
        font-weight: 500;
    }

    .form-control {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: rgba(0, 0, 0, 0.4);
        border-color: var(--accent);
        box-shadow: 0 0 0 0.2rem rgba(197, 168, 128, 0.25);
        color: var(--text-primary);
    }

    .form-control::placeholder {
        color: var(--text-secondary);
    }

    .btn {
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: var(--accent);
        border: none;
    }

    .btn-primary:hover {
        background: #b89670;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: rgba(108, 117, 125, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-primary);
    }

    .btn-secondary:hover {
        background: rgba(108, 117, 125, 0.3);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
</style>

<div class="form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Tambah Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="create_process.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../includes/footer.php"; ?> 