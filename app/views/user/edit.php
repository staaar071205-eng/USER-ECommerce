<h2>Edit User</h2>

<form action="<?php echo URL; ?>/user/update" method="post">
    <input type="hidden" name="user_id" value="<?php echo (int) $data['row']['user_id']; ?>">
    <table class="table table-hover">
        <tr>
            <td>NAMA</td>
            <td><input type="text" name="user_nama" value="<?php echo e($data['row']['user_nama']); ?>" class="form-control" maxlength="100" required></td>
        </tr>
        <tr>
            <td>EMAIL</td>
            <td><input type="email" name="user_email" value="<?php echo e($data['row']['user_email']); ?>" class="form-control" maxlength="50" required></td>
        </tr>
        <tr>
            <td>PASSWORD</td>
            <td>
                <input type="password" name="user_password" class="form-control" minlength="6">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="btn_update" value="UPDATE" class="btn btn-primary">
                <a href="<?php echo URL; ?>/user" class="btn btn-secondary">KEMBALI</a>
            </td>
        </tr>
    </table>
</form>
