<h2>Input Produk</h2>

<form action="<?php echo URL; ?>/produk/simpan" method="post" enctype="multipart/form-data">
    <table class="table table-hover">
        <tr>
            <td>Kategori</td>
            <td>
                <select name="produk_id_kat" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($data['listkategori'] as $kat): ?>
                        <option value="<?php echo (int) $kat['kat_id']; ?>">
                            <?php echo e($kat['kat_nama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kode Produk</td>
            <td><input type="text" name="produk_kode" class="form-control" maxlength="50" required></td>
        </tr>
        <tr>
            <td>Nama Produk</td>
            <td><input type="text" name="produk_nama" class="form-control" maxlength="256" required></td>
        </tr>
        <tr>
            <td>Harga Produk</td>
            <td><input type="number" name="produk_hrg" class="form-control" min="0" required></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td><textarea name="produk_keterangan" class="form-control" rows="4"></textarea></td>
        </tr>
        <tr>
            <td>Stok Produk</td>
            <td><input type="number" name="produk_stock" class="form-control" min="0" required></td>
        </tr>
        <tr>
            <td>Foto Produk</td>
            <td><input type="file" name="produk_photo" class="form-control" accept="image/*"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="btn_simpan" value="SIMPAN" class="btn btn-primary">
                <a href="<?php echo URL; ?>/produk" class="btn btn-secondary">KEMBALI</a>
            </td>
        </tr>
    </table>
</form>
