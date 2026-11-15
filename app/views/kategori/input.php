<h2>Input Kategori</h2>

<form action="<?php echo URL; ?>/kategori/simpan" method="post">
    <table class="table table-hover">
        <tr>
            <td>NAMA</td>
            <td><input type="text" name="kat_nama" class="form-control" maxlength="50" required></td>
        </tr>
        <tr>
            <td>KETERANGAN</td>
            <td><textarea name="kat_keterangan" class="form-control" id="" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="btn_simpan" value="SIMPAN" class="btn btn-primary">
                <a href="<?php echo URL; ?>/kategori" class="btn btn-secondary">KEMBALI</a>
            </td>
        </tr>
    </table>
</form>
