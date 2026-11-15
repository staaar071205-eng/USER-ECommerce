<?php

namespace App\Core;

class Controller
{
	// Layout halaman login (tanpa sidebar)
	protected function login($view, $data = [])
	{
		require_once ROOT . "layouts/login.php";
	}

	// Layout dashboard (dengan sidebar)
	protected function dashboard($view, $data = [])
	{
		require_once ROOT . "layouts/dashboard.php";
	}

	// Dipanggil di constructor controller yang wajib login
	protected static function cekLogin()
	{
		if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
			$_SESSION['pesan'] = 'Silakan login terlebih dahulu.';
			$_SESSION['tipe']  = 'warning';

			header('location:' . URL);
			exit();
		}
	}

	// Pindah halaman, opsional dengan pesan (flash message) yang disimpan di session
	// $tipe mengikuti warna alert Bootstrap: success, danger, warning, info
	protected function redirect(string $path, ?string $pesan = null, string $tipe = 'success'): never
	{
		if ($pesan !== null) {
			$_SESSION['pesan'] = $pesan;
			$_SESSION['tipe']  = $tipe;
		}

		header('Location: ' . URL . '/' . $path);
		exit;
	}
}
