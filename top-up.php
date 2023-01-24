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

	<title>Isi Ulang Saldo - syiMaya</title>

	<link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
	<link rel = "stylesheet" href = "./assets/css/styles/top-up.css" type = "text/css">
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
				<a class = "navbar-brand" href = "./index.html">
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

	<div class = "main-content" id = "panel">
		<!-- Header -->
		<div class = "" id = "banner">
			<div class = "container-fluid">
				<div class = "row row-banner">
					<div class = "col-md-6 title-banner">
						<h1>Isi Ulang Saldo</h1>
						<p>Pastikan saldomu selalu terisi, agar dapat mengikuti arisan bersama teman-teman.</p>
					</div>
					<div class = "col-md-6 image-banner">
						<img src = "./assets/img/illustrations/reading-woman.svg" alt = "">
					</div>
				</div>
			</div>
		</div>

		<!-- Digital Wallet -->
		<div id = "atm-section">
			<div class = "container-fluid">
				<h2>Dompet Digital</h2>
				<div class = "row">
					<div class = "col-xl-2 col-md-4 minimarket-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=GoPay">
								<div class = "card-body minimarket-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/gopay.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 minimarket-title" style = "text-align: center;">GoPay</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 minimarket-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=DANA">
								<div class = "card-body minimarket-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/dana.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 minimarket-title" style = "text-align: center;">DANA</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 minimarket-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=OVO">
								<div class = "card-body minimarket-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/ovo.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 minimarket-title" style = "text-align: center;">OVO</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 minimarket-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=ShopeePay">
								<div class = "card-body minimarket-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/shopeepay.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 minimarket-title" style = "text-align: center;">ShopeePay</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- ATM -->
		<div id = "atm-section">
			<div class = "container-fluid">
				<h2>ATM</h2>
				<div class = "row justify-content-center">
					<div class = "col-xl-2 col-md-4 atm-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=BRI">
								<div class = "card-body atm-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/bri.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 atm-title" style = "text-align: center;">BRI</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 atm-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=BNI">
								<div class = "card-body atm-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/bni.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 atm-title" style = "text-align: center;">BNI</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 atm-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=Mandiri">
								<div class = "card-body atm-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/mandiri.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 atm-title" style = "text-align: center;">Mandiri</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 atm-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=BCA">
								<div class = "card-body atm-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/bca.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 atm-title" style = "text-align: center;">BCA</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 atm-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=CIMB Niaga">
								<div class = "card-body atm-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/cimbniaga.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 atm-title" style = "text-align: center;">CIMB Niaga</p>
								</div>
							</a>
						</div>
					</div>
					<div class = "col-xl-2 col-md-4 atm-card">
						<div class = "card card-stats">
							<a href = "virtual-account.php?via=BTN">
								<div class = "card-body atm-card-body">
									<div class = "" style = "text-align: center;">
										<img src = "./assets/img/icons/btn.png" alt = "">
									</div>
									<p class = "mt-3 mb-0 atm-title" style = "text-align: center;">BTN</p>
								</div>
							</a>
						</div>
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