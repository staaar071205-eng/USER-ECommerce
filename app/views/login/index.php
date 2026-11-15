<h4 class="text-center mb-1">E-COMMERCE</h4>
<p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>

<form action="<?php echo URL; ?>/index/proses" method="post">
    <div class="mb-3">
        <label for="user_email" class="form-label">Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required autofocus>
    </div>

    <div class="mb-3">
        <label for="user_password" class="form-label">Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">LOGIN</button>
    </div>
</form>
