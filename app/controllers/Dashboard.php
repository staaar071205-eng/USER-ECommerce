<?php

namespace App\Controllers;

use App\Core\Controller;

class Dashboard extends Controller
{

	public function __construct()
	{
		parent::cekLogin();
	}

	public function index()
	{
		$data['jml_kategori'] = (new \App\Models\Kategori())->jumlah();
		$data['jml_produk']   = (new \App\Models\Produk())->jumlah();
		$data['jml_user']     = (new \App\Models\User())->jumlah();

		$this->dashboard('dashboard/index', $data);
	}

	public function logout()
	{
		$_SESSION = [];
		session_regenerate_id(true);

		$this->redirect('', 'Anda sudah keluar.', 'info');
	}
}
