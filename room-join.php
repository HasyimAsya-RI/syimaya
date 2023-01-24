<?php
	// Init Database & Check If User is Not Logged In
	require_once __DIR__ . "/config/session.php";

	$k          = isset( $_GET["k"] ) ? $_GET["k"] : "Tidak dikenal!";
	$kelas      = findKelasByID( $k, $kelas_list );
	$kelas_name = ucfirst( $kelas["name"] );
?>


<!DOCTYPE html>
<html lang = "id">

<head>
	<meta charset    = "UTF-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	<meta name       = "viewport" content = "width=device-width, initial-scale=1.0">

	<title>Kelas <?= $kelas_name ?> - syiMaya</title>

	<link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
	<link rel = "stylesheet" href = "./assets/css/styles/join-success.css" type = "text/css">
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
					<img class = "navbar-brand-img" src = "./assets/img/brands/syimaya.png" alt = "...">
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
							<a class = "nav-link" href = "room.php">
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
	<div class = "main-content" id = "panel">
		<div class = "banner-<?= $kelas["color"] ?>" id = "banner">
			<div class = "container-fluid">
				<div class = "row description">
					<div class = "col-md-6 success-description">
						<h1 class = "title-description h1" style = "color:black">Selamat Anda telah bergabung </br> di Kelas <?= $kelas_name ?></h1>
						<a  class = "btn btn-primary" href = "room.php?k=<?= $k ?>">Mulai Arisan</a>
					</div>
					<div class = "col-md-6 div-banner-image">
						<img class = "banner-image" src = "./assets/img/illustrations/join-success.svg" alt = "">
					</div>
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