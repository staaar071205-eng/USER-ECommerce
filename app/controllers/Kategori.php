<?php

// Update November 2024

namespace App\Controllers;

use App\Core\Controller;

class Kategori extends Controller
{
	public object $model;

	public function __construct()
	{
		parent::cekLogin();

		$this->model = new \App\Models\Kategori();
	}

	public function index()
	{
		$data['rows'] = $this->model->tampil();
		$this->dashboard('kategori/index', $data);
	}

	public function input()
	{
		$this->dashboard('kategori/input');
	}

	public function simpan()
	{
		// Data hanya boleh disimpan lewat form (POST), bukan dengan mengetik URL
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('kategori');
		}

		if (trim($_POST['kat_nama'] ?? '') === '') {
			$this->redirect('kategori/input', 'Nama kategori wajib diisi.', 'danger');
		}

		$this->model->simpan();
		$this->redirect('kategori', 'Kategori berhasil ditambahkan.');
	}

	public function edit($id)
	{
		$row = $this->model->edit($id);

		// Data tidak ditemukan
		if (!$row) {
			$this->redirect('kategori', 'Kategori tidak ditemukan.', 'danger');
		}

		$data['row'] = $row;
		$this->dashboard('kategori/edit', $data);
	}

	public function update()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('kategori');
		}

		if (trim($_POST['kat_nama'] ?? '') === '') {
			$this->redirect('kategori/edit/' . (int) ($_POST['kat_id'] ?? 0), 'Nama kategori wajib diisi.', 'danger');
		}

		$this->model->update();
		$this->redirect('kategori', 'Kategori berhasil diperbarui.');
	}

	public function hapus()
	{
		// Hapus wajib lewat POST: tautan GET bisa terpicu tanpa sengaja
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('kategori');
		}

		try {
			$this->model->hapus();
		} catch (\PDOException $e) {
			// 23000 = foreign key: kategori masih dipakai oleh produk
			if ($e->getCode() === '23000') {
				$this->redirect('kategori', 'Kategori tidak bisa dihapus karena masih dipakai produk.', 'danger');
			}
			throw $e;
		}

		$this->redirect('kategori', 'Kategori berhasil dihapus.');
	}
}
