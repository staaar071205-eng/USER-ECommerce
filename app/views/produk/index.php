<h2>Produk</h2>

<a href="<?php echo URL; ?>/produk/input" class="btn btn-primary mb-3">Input Produk</a>

<table class="table table-bordered align-middle">
      <tr>
            <th>NO</th>
            <th>FOTO</th>
            <th>KATEGORI</th>
            <th>KODE</th>
            <th>NAMA</th>
            <th>HARGA</th>
            <th>STOK</th>
            <th>PENGINPUT</th>
            <th>AKSI</th>
      </tr>

      <?php $no = 1; ?>
      <?php foreach ($data['rows'] as $row) { ?>
            <tr>
                  <td><?php echo $no++; ?></td>
                  <td>
                        <?php if (!empty($row['produk_photo'])) { ?>
                              <img src="<?php echo AST; ?>/images/produk/<?php echo e($row['produk_photo']); ?>"
                                   alt="<?php echo e($row['produk_nama']); ?>" width="60">
                        <?php } else { ?>
                              <span class="text-muted">-</span>
                        <?php } ?>
                  </td>
                  <td><?php echo e($row['ktgr'] ?? '-'); ?></td>
                  <td><?php echo e($row['produk_kode']); ?></td>
                  <td><?php echo e($row['produk_nama']); ?></td>
                  <td>Rp <?php echo number_format($row['produk_hrg'], 0, ',', '.'); ?></td>
                  <td><?php echo (int) $row['produk_stock']; ?></td>
                  <td><?php echo e($row['penginput'] ?? '-'); ?></td>
                  <td class="text-nowrap">
                        <a href="<?php echo URL; ?>/produk/detail/<?php echo (int) $row['produk_id']; ?>" class="btn btn-info btn-sm">Detail</a>
                        <a href="<?php echo URL; ?>/produk/edit/<?php echo (int) $row['produk_id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                        <form action="<?php echo URL; ?>/produk/hapus" method="post" class="d-inline"
                              onsubmit="return confirm('Yakin hapus produk ini?')">
                              <input type="hidden" name="produk_id" value="<?php echo (int) $row['produk_id']; ?>">
                              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                  </td>
            </tr>
      <?php } ?>

      <?php if (empty($data['rows'])) { ?>
            <tr>
                  <td colspan="9" class="text-center text-muted">Belum ada data produk.</td>
            </tr>
      <?php } ?>

</table>
