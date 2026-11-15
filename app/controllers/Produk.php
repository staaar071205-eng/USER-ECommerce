<?php

// Update November 2024

namespace App\Controllers;

use App\Core\Controller;

class Produk extends Controller
{
     public object $model;

     public function __construct()
     {
          parent::cekLogin();

          $this->model = new \App\Models\Produk();
     }

     // Daftar produk
     public function index()
     {
          $data['rows'] = $this->model->tampil();
          $this->dashboard('produk/index', $data);
     }

     // Form tambah produk
     public function input()
     {
          $data['listkategori'] = $this->model->listkategori();
          $this->dashboard('produk/input', $data);
     }

     // Proses simpan (POST)
     public function simpan()
     {
          if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
               $this->redirect('produk');
          }

          $error = $this->validasi();
          if ($error) {
               $this->redirect('produk/input', $error, 'danger');
          }

          $photo = null;

          try {
               $photo = $this->uploadFoto();
               $this->model->simpan($photo);
          } catch (\PDOException $e) {
               $this->hapusFile($photo); // batalkan foto yang sudah terlanjur diunggah

               // 23000 = pelanggaran constraint: 1062 = kode produk kembar (unique key),
               // selain itu berarti kategori yang dipilih tidak ada (foreign key)
               if ($e->getCode() === '23000') {
                    $pesan = (($e->errorInfo[1] ?? 0) == 1062)
                         ? 'Kode produk sudah digunakan.'
                         : 'Kategori yang dipilih tidak valid.';
                    $this->redirect('produk/input', $pesan, 'danger');
               }
               throw $e;
          } catch (\Exception $e) {
               $this->redirect('produk/input', $e->getMessage(), 'danger');
          }

          $this->redirect('produk', 'Produk berhasil ditambahkan.');
     }

     // Halaman detail satu produk
     public function detail($id = 0)
     {
          $row = $this->model->detail((int) $id);

          if (!$row) {
               $this->redirect('produk', 'Produk tidak ditemukan.', 'danger');
          }

          $data['row'] = $row;
          $this->dashboard('produk/detail', $data);
     }

     // Form edit produk
     public function edit($id = 0)
     {
          $row = $this->model->edit((int) $id);

          if (!$row) {
               $this->redirect('produk', 'Produk tidak ditemukan.', 'danger');
          }

          $data['row'] = $row;
          $data['listkategori'] = $this->model->listkategori();
          $this->dashboard('produk/edit', $data);
     }

     // Proses update (POST)
     public function update()
     {
          if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
               $this->redirect('produk');
          }

          $id = (int) ($_POST['produk_id'] ?? 0);
          $lama = $this->model->edit($id);

          if (!$lama) {
               $this->redirect('produk', 'Produk tidak ditemukan.', 'danger');
          }

          $error = $this->validasi();
          if ($error) {
               $this->redirect('produk/edit/' . $id, $error, 'danger');
          }

          $baru = null;

          try {
               // Jika tidak ada foto baru, pakai foto lama
               $baru = $this->uploadFoto();
               $this->model->update($baru ?? $lama['produk_photo']);
          } catch (\PDOException $e) {
               $this->hapusFile($baru);

               if ($e->getCode() === '23000') {
                    $pesan = (($e->errorInfo[1] ?? 0) == 1062)
                         ? 'Kode produk sudah digunakan.'
                         : 'Kategori yang dipilih tidak valid.';
                    $this->redirect('produk/edit/' . $id, $pesan, 'danger');
               }
               throw $e;
          } catch (\Exception $e) {
               $this->redirect('produk/edit/' . $id, $e->getMessage(), 'danger');
          }

          // Foto lama tidak terpakai lagi jika diganti
          if ($baru !== null) {
               $this->hapusFile($lama['produk_photo']);
          }

          $this->redirect('produk', 'Produk berhasil diperbarui.');
     }

     // Proses hapus (POST)
     public function hapus()
     {
          if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
               $this->redirect('produk');
          }

          $id = (int) ($_POST['produk_id'] ?? 0);
          $row = $this->model->edit($id);

          if ($row) {
               $this->model->hapus($id);
               $this->hapusFile($row['produk_photo']);
          }

          $this->redirect('produk', 'Produk berhasil dihapus.');
     }

     // ---------------------------------------------------------------
     // Method private: tidak bisa dipanggil lewat URL
     // ---------------------------------------------------------------

     // Memeriksa isian form. Mengembalikan pesan error, atau null jika valid
     private function validasi(): ?string
     {
          if (trim($_POST['produk_kode'] ?? '') === '') {
               return 'Kode produk wajib diisi.';
          }

          if (trim($_POST['produk_nama'] ?? '') === '') {
               return 'Nama produk wajib diisi.';
          }

          if (!ctype_digit((string) ($_POST['produk_id_kat'] ?? ''))) {
               return 'Kategori wajib dipilih.';
          }

          if (!ctype_digit((string) ($_POST['produk_hrg'] ?? ''))) {
               return 'Harga harus berupa angka bulat (0 atau lebih).';
          }

          if (!ctype_digit((string) ($_POST['produk_stock'] ?? ''))) {
               return 'Stok harus berupa angka bulat (0 atau lebih).';
          }

          return null;
     }

     // Memproses foto yang diunggah. Mengembalikan nama file, atau null jika tidak ada foto
     private function uploadFoto(): ?string
     {
          $file = $_FILES['produk_photo'] ?? null;

          // Tidak ada file yang dipilih
          if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
               return null;
          }

          if ($file['error'] !== UPLOAD_ERR_OK) {
               throw new \Exception('Foto gagal diunggah.');
          }

          if ($file['size'] > 2 * 1024 * 1024) {
               throw new \Exception('Ukuran foto maksimal 2 MB.');
          }

          // Periksa isi file yang sebenarnya, bukan hanya ekstensinya
          $info = @getimagesize($file['tmp_name']);
          $tipe = [
               IMAGETYPE_JPEG => 'jpg',
               IMAGETYPE_PNG  => 'png',
               IMAGETYPE_GIF  => 'gif',
               IMAGETYPE_WEBP => 'webp',
          ];

          if ($info === false || !isset($tipe[$info[2]])) {
               throw new \Exception('Foto harus berformat JPG, PNG, GIF, atau WEBP.');
          }

          $folder = ROOT . 'layouts/assets/images/produk/';
          if (!is_dir($folder)) {
               mkdir($folder, 0777, true);
          }

          // Nama baru yang unik agar tidak menimpa file lain
          $nama = uniqid('produk_') . '.' . $tipe[$info[2]];

          if (!move_uploaded_file($file['tmp_name'], $folder . $nama)) {
               throw new \Exception('Foto gagal disimpan di server.');
          }

          return $nama;
     }

     // Menghapus file foto dari folder
     private function hapusFile(?string $nama): void
     {
          if ($nama === null || $nama === '') {
               return;
          }

          $path = ROOT . 'layouts/assets/images/produk/' . basename($nama);

          if (is_file($path)) {
               unlink($path);
          }
     }
}
