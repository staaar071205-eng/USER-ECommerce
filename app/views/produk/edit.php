<h2>Edit Produk</h2>

<form action="<?php echo URL; ?>/produk/update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="produk_id" value="<?php echo (int) $data['row']['produk_id']; ?>">
    <table class="table table-hover">
        <tr>
            <td>Kategori</td>
            <td>
                <select name="produk_id_kat" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($data['listkategori'] as $kat): ?>
                        <option value="<?php echo (int) $kat['kat_id']; ?>"
                            <?php echo ($kat['kat_id'] == $data['row']['produk_id_kat']) ? 'selected' : ''; ?>>
                            <?php echo e($kat['kat_nama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kode Produk</td>
            <td><input type="text" name="produk_kode" value="<?php echo e($data['row']['produk_kode']); ?>" class="form-control" maxlength="50" required></td>
        </tr>
        <tr>
            <td>Nama Produk</td>
            <td><input type="text" name="produk_nama" value="<?php echo e($data['row']['produk_nama']); ?>" class="form-control" maxlength="256" required></td>
        </tr>
        <tr>
            <td>Harga Produk</td>
            <td><input type="number" name="produk_hrg" value="<?php echo (int) $data['row']['produk_hrg']; ?>" class="form-control" min="0" required></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td><textarea name="produk_keterangan" class="form-control" rows="4"><?php echo e($data['row']['produk_keterangan']); ?></textarea></td>
        </tr>
        <tr>
            <td>Stok Produk</td>
            <td><input type="number" name="produk_stock" value="<?php echo (int) $data['row']['produk_stock']; ?>" class="form-control" min="0" required></td>
        </tr>
        <tr>
            <td>Foto Produk</td>
            <td>
                <?php if (!empty($data['row']['produk_photo'])): ?>
                    <img src="<?php echo AST; ?>/images/produk/<?php echo e($data['row']['produk_photo']); ?>" alt="Foto produk" width="120" class="mb-2 d-block">
                <?php endif; ?>
                <input type="file" name="produk_photo" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="btn_update" value="UPDATE" class="btn btn-primary">
                <a href="<?php echo URL; ?>/produk" class="btn btn-secondary">KEMBALI</a>
            </td>
        </tr>
    </table>
</form>
