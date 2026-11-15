<?php

namespace App\Core;

class Error
{

	public function fileNotFound()
	{
		http_response_code(404);

		echo "<h3>404 - Halaman tidak ditemukan</h3>";
		echo "<p><a href=\"" . URL . "\">Kembali ke beranda</a></p>";
	}
}
