<h2>User</h2>

<a href="<?php echo URL; ?>/user/input" class="btn btn-primary mb-3">Input User</a>

<table class="table table-bordered align-middle">
      <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>AKSI</th>
      </tr>

      <?php $no = 1; ?>
      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo e($row['user_nama']); ?></td>
                  <td><?php echo e($row['user_email']); ?></td>
                  <td class="text-nowrap">
                        <a href="<?php echo URL; ?>/user/edit/<?php echo (int) $row['user_id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                        <?php if ((int) $row['user_id'] !== (int) $_SESSION['user_id']) { ?>
                              <form action="<?php echo URL; ?>/user/hapus" method="post" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    <input type="hidden" name="user_id" value="<?php echo (int) $row['user_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                              </form>
                        <?php } else { ?>
                              <span class="badge text-bg-secondary">Akun Anda</span>
                        <?php } ?>
                  </td>
            </tr>
      <?php } ?>

</table>
