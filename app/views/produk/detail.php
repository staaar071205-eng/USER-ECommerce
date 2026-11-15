<h2>Detail Produk</h2>

<div class="card" style="max-width: 36rem">
    <?php if (!empty($data['row']['produk_photo'])): ?>
        <img src="<?php echo AST; ?>/images/produk/<?php echo e($data['row']['produk_photo']); ?>"
             class="card-img-top" alt="<?php echo e($data['row']['produk_nama']); ?>">
    <?php endif; ?>

    <div class="card-body">
        <h5 class="card-title"><?php echo e($data['row']['produk_nama']); ?></h5>
        <h6 class="card-subtitle mb-3 text-body-secondary"><?php echo e($data['row']['produk_kode']); ?></h6>

        <table class="table table-sm">
            <tr>
                <td>Kategori</td>
                <td><?php echo e($data['row']['ktgr'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>Rp <?php echo number_format($data['row']['produk_hrg'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><?php echo (int) $data['row']['produk_stock']; ?></td>
            </tr>
            <tr>
                <td>Diinput oleh</td>
                <td><?php echo e($data['row']['penginput'] ?? '-'); ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td><?php echo nl2br(e($data['row']['produk_keterangan'])); ?></td>
            </tr>
        </table>
    </div>
</div>

<a href="<?php echo URL; ?>/produk" class="btn btn-secondary mt-3">KEMBALI</a>
