<?php

// Update November 2024

namespace App\Models;

use App\Core\Model;

class Produk extends Model
{
      // Menampilkan seluruh produk beserta nama kategori dan nama penginputnya (JOIN)
      public function tampil()
      {
            $sql = "SELECT p.*, k.kat_nama AS ktgr, u.user_nama AS penginput
            FROM tb_produk p
            LEFT JOIN tb_kategori k ON p.produk_id_kat=k.kat_id
            LEFT JOIN tb_users u ON p.produk_id_user=u.user_id
            ORDER BY p.produk_id DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $this->selects($stmt);
      }

      public function jumlah()
      {
            $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM tb_produk");
            $stmt->execute();

            return (int) $this->select($stmt)['total'];
      }

      // Daftar kategori untuk pilihan (select) pada form
      public function listKategori()
      {
            $query = "SELECT * FROM tb_kategori";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $this->selects($stmt);
      }

      // Menyimpan produk baru. $photo = nama file foto (atau null jika tidak ada)
      // Pemilik produk diambil dari user yang sedang login
      public function simpan($photo)
      {
            $sql = "INSERT INTO tb_produk SET
                        produk_id_kat=:produk_id_kat,
                        produk_id_user=:produk_id_user,
                        produk_kode=:produk_kode,
                        produk_nama=:produk_nama,
                        produk_hrg=:produk_hrg,
                        produk_keterangan=:produk_keterangan,
                        produk_stock=:produk_stock,
                        produk_photo=:produk_photo";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                  ":produk_id_kat"     => $_POST['produk_id_kat'],
                  ":produk_id_user"    => $_SESSION['user_id'],
                  ":produk_kode"       => trim($_POST['produk_kode']),
                  ":produk_nama"       => trim($_POST['produk_nama']),
                  ":produk_hrg"        => $_POST['produk_hrg'],
                  ":produk_keterangan" => $_POST['produk_keterangan'] ?? '',
                  ":produk_stock"      => $_POST['produk_stock'],
                  ":produk_photo"      => $photo,
            ]);
      }

      // Mengambil satu produk berdasarkan id (untuk form edit)
      public function edit($id)
      {
            $query = "SELECT * FROM tb_produk WHERE produk_id=:produk_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":produk_id", $id);
            $stmt->execute();

            return $this->select($stmt);
      }

      // Mengambil satu produk beserta nama kategori dan penginput (halaman detail)
      public function detail($id)
      {
            $sql = "SELECT p.*, k.kat_nama AS ktgr, u.user_nama AS penginput
            FROM tb_produk p
            LEFT JOIN tb_kategori k ON p.produk_id_kat=k.kat_id
            LEFT JOIN tb_users u ON p.produk_id_user=u.user_id
            WHERE p.produk_id=:produk_id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":produk_id", $id);
            $stmt->execute();

            return $this->select($stmt);
      }

      // Memperbarui produk. $photo = nama file foto yang dipakai sekarang
      public function update($photo)
      {
            $sql = "UPDATE tb_produk SET
                        produk_id_kat=:produk_id_kat,
                        produk_kode=:produk_kode,
                        produk_nama=:produk_nama,
                        produk_hrg=:produk_hrg,
                        produk_keterangan=:produk_keterangan,
                        produk_stock=:produk_stock,
                        produk_photo=:produk_photo,
                        updated_at=NOW()
                    WHERE produk_id=:produk_id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                  ":produk_id_kat"     => $_POST['produk_id_kat'],
                  ":produk_kode"       => trim($_POST['produk_kode']),
                  ":produk_nama"       => trim($_POST['produk_nama']),
                  ":produk_hrg"        => $_POST['produk_hrg'],
                  ":produk_keterangan" => $_POST['produk_keterangan'] ?? '',
                  ":produk_stock"      => $_POST['produk_stock'],
                  ":produk_photo"      => $photo,
                  ":produk_id"         => $_POST['produk_id'],
            ]);
      }

      // Menghapus produk berdasarkan id
      public function hapus($id)
      {
            $sql = "DELETE FROM tb_produk WHERE produk_id=:produk_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":produk_id", $id);
            $stmt->execute();
      }
}
