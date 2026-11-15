<h2>Dashboard</h2>

<div class="alert alert-info">Selamat datang, <strong><?php echo e($_SESSION['user_nama'] ?? ''); ?></strong></div>

<div class="row g-3">
    <div class="col-12 col-md-4">
        <div class="card text-bg-primary">
            <div class="card-body">
                <div class="small">Jumlah Kategori</div>
                <div class="fs-2 fw-bold"><?php echo (int) $data['jml_kategori']; ?></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <div class="small">Jumlah Produk</div>
                <div class="fs-2 fw-bold"><?php echo (int) $data['jml_produk']; ?></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card text-bg-secondary">
            <div class="card-body">
                <div class="small">Jumlah User</div>
                <div class="fs-2 fw-bold"><?php echo (int) $data['jml_user']; ?></div>
            </div>
        </div>
    </div>
</div>
