<h2>Kategori</h2>

<a href="<?php echo URL; ?>/kategori/input" class="btn btn-primary mb-3">Input Kategori</a>

<table class="table table-bordered">
      <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>KETERANGAN</th>
            <th>AKSI</th>
      </tr>

      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo e($row['kat_id']); ?></td>
                  <td><?php echo e($row['kat_nama']); ?></td>
                  <td><?php echo e($row['kat_keterangan']); ?></td>
                  <td>
                        <a href="<?php echo URL; ?>/kategori/edit/<?php echo (int) $row['kat_id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                        <!-- Hapus dikirim lewat form POST -->
                        <form action="<?php echo URL; ?>/kategori/hapus" method="post" class="d-inline"
                              onsubmit="return confirm('Yakin hapus kategori ini?')">
                              <input type="hidden" name="kat_id" value="<?php echo (int) $row['kat_id']; ?>">
                              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                  </td>
            </tr>
      <?php } ?>

      <?php if (empty($data['rows'])) { ?>
            <tr>
                  <td colspan="4" class="text-center text-muted">Belum ada data kategori.</td>
            </tr>
      <?php } ?>

</table>
