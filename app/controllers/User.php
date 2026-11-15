<?php

namespace App\Controllers;

use App\Core\Controller;

class User extends Controller
{
	public object $model;

	public function __construct()
	{
		parent::cekLogin();

		$this->model = new \App\Models\User();
	}

	public function index()
	{
		$data['rows'] = $this->model->tampil();
		$this->dashboard('user/index', $data);
	}

	public function input()
	{
		$this->dashboard('user/input');
	}

	public function simpan()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('user');
		}

		// Password wajib diisi saat tambah user baru
		$error = $this->validasi(true);
		if ($error) {
			$this->redirect('user/input', $error, 'danger');
		}

		try {
			$this->model->simpan();
		} catch (\PDOException $e) {
			// 23000 = unique key: email sudah terdaftar
			if ($e->getCode() === '23000') {
				$this->redirect('user/input', 'Email sudah terdaftar.', 'danger');
			}
			throw $e;
		}

		$this->redirect('user', 'User berhasil ditambahkan.');
	}

	public function edit($id = 0)
	{
		$row = $this->model->edit((int) $id);

		if (!$row) {
			$this->redirect('user', 'User tidak ditemukan.', 'danger');
		}

		$data['row'] = $row;
		$this->dashboard('user/edit', $data);
	}

	public function update()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('user');
		}

		$id = (int) ($_POST['user_id'] ?? 0);

		if (!$this->model->edit($id)) {
			$this->redirect('user', 'User tidak ditemukan.', 'danger');
		}

		// Saat edit, password boleh kosong (berarti tidak diganti)
		$error = $this->validasi(false);
		if ($error) {
			$this->redirect('user/edit/' . $id, $error, 'danger');
		}

		try {
			$this->model->update();
		} catch (\PDOException $e) {
			if ($e->getCode() === '23000') {
				$this->redirect('user/edit/' . $id, 'Email sudah terdaftar.', 'danger');
			}
			throw $e;
		}

		// Jika yang diedit adalah akun yang sedang dipakai, perbarui data di session
		if ($id === (int) $_SESSION['user_id']) {
			$_SESSION['user_nama']  = trim($_POST['user_nama']);
			$_SESSION['user_email'] = trim($_POST['user_email']);
		}

		$this->redirect('user', 'User berhasil diperbarui.');
	}

	public function hapus()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('user');
		}

		$id = (int) ($_POST['user_id'] ?? 0);

		// Akun yang sedang dipakai tidak boleh dihapus
		if ($id === (int) $_SESSION['user_id']) {
			$this->redirect('user', 'Anda tidak bisa menghapus akun yang sedang dipakai.', 'danger');
		}

		try {
			$this->model->hapus($id);
		} catch (\PDOException $e) {
			// 23000 = foreign key: user masih punya produk
			if ($e->getCode() === '23000') {
				$this->redirect('user', 'User tidak bisa dihapus karena masih memiliki produk.', 'danger');
			}
			throw $e;
		}

		$this->redirect('user', 'User berhasil dihapus.');
	}

	// Memeriksa isian form. Mengembalikan pesan error, atau null jika valid
	private function validasi(bool $passwordWajib): ?string
	{
		if (trim($_POST['user_nama'] ?? '') === '') {
			return 'Nama wajib diisi.';
		}

		if (!filter_var(trim($_POST['user_email'] ?? ''), FILTER_VALIDATE_EMAIL)) {
			return 'Format email tidak valid.';
		}

		$password = $_POST['user_password'] ?? '';

		if (($passwordWajib || $password !== '') && strlen($password) < 6) {
			return 'Password minimal 6 karakter.';
		}

		return null;
	}
}
