<?php
	// Init Database & Check If User is Not Logged In
	require_once __DIR__ . "/config/session.php";
?>


<!DOCTYPE html>
<html lang = "id">

<head>
	<meta charset    = "UTF-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	<meta name       = "viewport" content = "width=device-width, initial-scale=1.0">

	<title>Akun Virtual - syiMaya </title>

	<link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
	<link rel = "stylesheet" href = "./assets/css/styles/invoice.css" type = "text/css">
	<link rel = "stylesheet" href = "https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<link rel = "stylesheet" href = "./assets/vendor/nucleo/css/nucleo.css" type = "text/css">
	<link rel = "stylesheet" href = "./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type = "text/css">
	<link rel = "stylesheet" href = "./assets/css/argon.css?v=1.2.0" type = "text/css">
</head>

<body>
	<!-- Side Navigation -->
	<nav class = "sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id = "sidenav-main">
		<div class = "scrollbar-inner">
			<div class = "sidenav-header align-items-center">
				<a class = "navbar-brand" href = "index.php">
					<img class = "navbar-brand-img" alt = "..." src = "./assets/img/brands/syimaya.png">
				</a>
			</div>
			<div class = "navbar-inner">
				<div class = "collapse navbar-collapse" id = "sidenav-collapse-main">
					<ul class = "navbar-nav">
						<li class = "nav-item">
							<a class = "nav-link active" href = "index.php">
								<i    class = "ni ni-tv-2 text-primary"></i>
								<span class = "nav-link-text">Beranda</span>
							</a>
						</li>
						<li class = "nav-item">
							<a class = "nav-link" href = "room.php?k=<?= findKelasLastID( $kelas_list ) ?>">
								<img  src   = "./assets/img/icons/ruangan.svg" alt = "" style = "width:20px; margin-right:13px">
								<span class = "nav-link-text">Ruangan</span>
							</a>
						</li>
						<li class = "nav-item">
							<a class = "nav-link" href = "profile.php">
								<i    class = "ni ni-single-02 text-yellow"></i>
								<span class = "nav-link-text">Profil</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<!-- Main Content -->
	<div class = "main-content">
		<div class = "container">
			<div class = "row justify-content-center mt-5">
				<div class = "col-lg-8">
					<form method = "POST">
						<div class = "card">
							<div class = "card-header text-center">
								<h2><b>Akun Virtual</b></h2>
							</div>
							<div class = "card-body">
								<div class = "px-3">
									<div class = "form-group mb-2">
										<label for   = "via">Rekening yang dipilih:</label>
										<input class = "form-control" type = "text" id = "via" name = "via"
											   value = "<?= $_GET["via"] ? ucwords( $_GET["via"] ) : "Tidak Ada" ?>" readonly>
									</div>
									<div class = "form-group">
										<label for   = "inputJumlah">Nominal saldo:</label>
										<input class = "form-control" type = "number" id = "inputJumlah" name = "inputJumlah"
											   placeholder = "Masukkan nominal saldo." min = "10000" value = "10000" required>
									</div>
								</div>
							</div>
						</div>
						
						<div class = "d-flex justify-content-between">
							<a      class = "btn btn-info" href = "./top-up.php">Kembali</a>
							<button class = "btn btn-primary" formaction = "./confirmation.php">Selanjutnya</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Core -->
	<script src = "./assets/vendor/jquery/dist/jquery.min.js"></script>
	<script src = "./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src = "./assets/vendor/js-cookie/js.cookie.js"></script>
	<script src = "./assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
	<script src = "./assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
	<script src = "./assets/vendor/chart.js/dist/Chart.min.js"></script>
	<script src = "./assets/vendor/chart.js/dist/Chart.extension.js"></script>
	<script src = "./assets/js/argon.js?v=1.2.0"></script>
</body>

</html>