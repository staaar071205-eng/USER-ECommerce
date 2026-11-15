<h2>Input User</h2>

<form action="<?php echo URL; ?>/user/simpan" method="post">
    <table class="table table-hover">
        <tr>
            <td>NAMA</td>
            <td><input type="text" name="user_nama" class="form-control" maxlength="100" required></td>
        </tr>
        <tr>
            <td>EMAIL</td>
            <td><input type="email" name="user_email" class="form-control" maxlength="50" required></td>
        </tr>
        <tr>
            <td>PASSWORD</td>
            <td><input type="password" name="user_password" class="form-control" minlength="6" required></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="btn_simpan" value="SIMPAN" class="btn btn-primary">
                <a href="<?php echo URL; ?>/user" class="btn btn-secondary">KEMBALI</a>
            </td>
        </tr>
    </table>
</form>
