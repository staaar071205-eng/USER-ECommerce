<?php

namespace App\Controllers;

use App\Core\Controller;

class Index extends Controller
{

	// Halaman login. Jika sudah login, langsung ke dashboard
	public function index()
	{
		if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
			$this->redirect('dashboard');
		}

		$this->login('login/index');
	}

	// Proses login (POST dari form login)
	public function proses()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			$this->redirect('');
		}

		$email    = trim($_POST['user_email'] ?? '');
		$password = $_POST['user_password'] ?? '';

		$model = new \App\Models\User();
		$user  = $model->login($email, $password);

		// Pesan sengaja dibuat umum agar tidak membocorkan email mana yang terdaftar
		if (!$user) {
			$this->redirect('', 'Email atau password salah.', 'danger');
		}

		// Ganti ID session setelah login (mencegah session fixation)
		session_regenerate_id(true);

		$_SESSION['login']      = true;
		$_SESSION['user_id']    = $user['user_id'];
		$_SESSION['user_nama']  = $user['user_nama'];
		$_SESSION['user_email'] = $user['user_email'];

		$this->redirect('dashboard');
	}
}
