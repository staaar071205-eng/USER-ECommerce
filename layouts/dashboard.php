<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Suendri">
	<title>Project 6 Pemrograman Berbasis Web Lanjutan</title>

	<link rel="icon" href="<?php echo AST; ?>/images/favicon.ico">
	<link href="<?php echo AST; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo AST; ?>/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
	<link href="<?php echo AST; ?>/css/style.css" rel="stylesheet">
</head>

<body>

	<div class="d-flex" id="wrapper">
		<div class="bg-primary border-right" id="sidebar-wrapper">
			<div class="sidebar-heading text-white">ECOMMERCE</div>

			<?php
			// Menu yang sedang dibuka (segmen pertama URL), untuk memberi class "active"
			$aktif = strtolower(strtok(trim($_GET['page'] ?? '', '/'), '/') ?: 'dashboard');
			?>
			<div class="list-group list-group-flush">
				<a href="<?php echo URL; ?>/dashboard" class="list-group-item list-group-item-action <?php echo $aktif == 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
				<a href="<?php echo URL; ?>/kategori" class="list-group-item list-group-item-action <?php echo $aktif == 'kategori' ? 'active' : ''; ?>">Kategori</a>
				<a href="<?php echo URL; ?>/produk" class="list-group-item list-group-item-action <?php echo $aktif == 'produk' ? 'active' : ''; ?>">Produk</a>
				<a href="<?php echo URL; ?>/user" class="list-group-item list-group-item-action <?php echo $aktif == 'user' ? 'active' : ''; ?>">User</a>
				<a href="<?php echo URL; ?>/dashboard/logout" class="list-group-item list-group-item-action">Logout</a>
			</div>
		</div>
		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<div class="container-fluid justify-content-between">
					<button class="btn btn-primary" id="menu-toggle">
						<i class="bi bi-list"></i>
					</button>
					<span class="navbar-text"><i class="bi bi-person-circle"></i> <?php echo e($_SESSION['user_nama'] ?? ''); ?></span>
				</div>
			</nav>

			<div class="container-fluid p-4">

				<?php if (!empty($_SESSION['pesan'])): ?>
					<div class="alert alert-<?php echo e($_SESSION['tipe'] ?? 'success'); ?> alert-dismissible fade show" role="alert">
						<?php echo e($_SESSION['pesan']); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
					<?php unset($_SESSION['pesan'], $_SESSION['tipe']); ?>
				<?php endif; ?>

				<?php require_once ROOT . "app/views/" . $view . ".php"; ?>

			</div>
		</div>
	</div>

	<script src="<?php echo AST; ?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo AST; ?>/js/app.js"></script>

</body>

</html>