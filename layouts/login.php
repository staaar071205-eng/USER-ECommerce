<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Suendri">
	<title>Login - Project 6 Pemrograman Berbasis Web Lanjutan</title>

	<link rel="icon" href="<?php echo AST; ?>/images/favicon.ico">
	<link href="<?php echo AST; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

	<div class="container">
		<div class="row justify-content-center align-items-center min-vh-100">
			<div class="col-12 col-sm-10 col-md-6 col-lg-4">

				<?php if (!empty($_SESSION['pesan'])): ?>
					<div class="alert alert-<?php echo e($_SESSION['tipe'] ?? 'info'); ?> alert-dismissible fade show" role="alert">
						<?php echo e($_SESSION['pesan']); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
					<?php unset($_SESSION['pesan'], $_SESSION['tipe']); ?>
				<?php endif; ?>

				<div class="card shadow-sm">
					<div class="card-body p-4">

						<?php require_once ROOT . "app/views/" . $view . ".php"; ?>

					</div>
				</div>

			</div>
		</div>
	</div>

	<script src="<?php echo AST; ?>/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
