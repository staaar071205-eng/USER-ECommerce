<h2>Edit Kategori</h2>

<form action="<?php echo URL; ?>/kategori/update" method="post">
    <input type="hidden" name="kat_id" value="<?php echo (int) $data['row']['kat_id']; ?>">
    <table class="table table-hover">
        <tr>
            <td>NAMA</td>
            <td><input type="text" name="kat_nama" value="<?php echo e($data['row']['kat_nama']); ?>" class="form-control" required></td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td><textarea name="kat_keterangan" class="form-control" id="" cols="30" rows="10"><?php echo e($data['row']['kat_keterangan']); ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="btn_update" value="UPDATE" class="btn btn-primary">
                <a href="<?php echo URL; ?>/kategori" class="btn btn-secondary">KEMBALI</a>
            </td>
        </tr>
    </table>
</form>
