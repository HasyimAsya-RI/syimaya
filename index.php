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

	<title>Beranda - syiMaya</title>

	<link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
	<link rel = "stylesheet" href = "./assets/css/styles/dashboard.css" type = "text/css">
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
							<a class = "nav-link" href = "room.php?k=<?= findKelasLastID( $kelas_list ) ?>">
								<img  src   = "./assets/img/icons/ruangan.svg" alt = "" style = "width:20px; margin-right:13px">
								<span class = "nav-link-text">Ruangan</span>
							</a>
						</li>
						<li class = "nav-item">
							<a class = "nav-link" href = "profile.php">
								<i class    = "ni ni-single-02 text-yellow"></i>
								<span class = "nav-link-text">Profil</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<div class = "main-content" id = "panel">
		<!-- Top Navigation -->
		<nav class = "navbar navbar-top navbar-expand navbar-dark bg-header border-bottom">
			<div class = "container-fluid">
				<div class = "collapse navbar-collapse" id = "navbarSupportedContent">
					<ul class = "navbar-nav align-items-center ml-md-auto ">
						<li class = "nav-item d-xl-none">
							<div class = "pr-3 sidenav-toggler sidenav-toggler-dark" data-action = "sidenav-pin" data-target = "#sidenav-main">
								<div class = "sidenav-toggler-inner">
									<i class = "sidenav-toggler-line"></i>
									<i class = "sidenav-toggler-line"></i>
									<i class = "sidenav-toggler-line"></i>
								</div>
							</div>
						</li>
						<li class = "nav-item dd-xl-none">
							<a class = "nav-link text-white" href = "./logout.php">
								<i    class = "ni ni-spaceship"></i>
								<span class = "nav-link-text">Keluar</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Header -->
		<div class = "header bg-header pb-6" id = "header">
			<div class = "container-fluid">
				<div class = "header-body">
					<div class = "row align-items-center py-4">
						<div class = "photo-profile">
							<img src = "./assets/img/photos/<?= empty( $user["photo"] ) ? "default.jpg" : $user["photo"] ?>" alt = "User Photos">
						</div>
						<div class = "col-lg-6 col-6 description-profile">
							<h1 style = "color:white">
								<?php echo $user['name'] ?>
							</h1>
							<h2 style = "color:white">
								<?php echo $user['address'] ?>
							</h2>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class = "container-fluid mt--6">
			<!-- Wallet -->
			<div class = "row justify-content-center" id = "wallet">
				<div class = "col-xl-3 col-md-4 wallet-card">
					<div class = "card card-stats">
						<div class = "card-body wallet-body">
							<div class = "row">
								<div class = "col-auto">
									<img class = "wallet-image" src = "./assets/img/icons/saldo.svg" alt = "">
								</div>
								<div class = "col align-self-center wallet-value">
									<h1 class = "mb-0"><?= rupiah( $user["saldo"] ) ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Exchange -->
			<div class = "row justify-content-center" id = "exchange">
				<?php if( $user["role"] === "admin" ) : ?>
					<div class = "col-xl-2 col-md-3 exchange-card">
						<div class = "card card-stats">
							<a href = "#">
								<div class = "card-body exchange-card-body">
									<div class = "col-auto" style = "text-align: center;">
										<img src = "./assets/img/icons/buat-ruangan.svg" alt = "">
									</div>
									<p class = "mt-3 mb-0 exchange-title" style = "text-align: center;">Buat Ruangan</p>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<div class = "col-xl-2 col-md-3 exchange-card">
					<div class = "card card-stats">
						<a href = "top-up.php">
							<div class = "card-body exchange-card-body">
								<div class = "col-auto" style = "text-align: center;">
									<img src = "./assets/img/icons/isi.svg" alt = "">
								</div>
								<p class = "mt-3 mb-0 exchange-title" style = "text-align: center;">Isi Ulang</p>
							</div>
						</a>
					</div>
				</div>
				<div class = "col-xl-2 col-md-3 exchange-card">
					<div class = "card card-stats">
						<a href = "#">
							<div class = "card-body exchange-card-body">
								<div class = "col-auto" style = "text-align: center;">
									<img src = "./assets/img/icons/tarik.svg" alt = "">
								</div>
								<p class = "mt-3 mb-0 exchange-title" style = "text-align: center;">Tarik Tunai</p>
							</div>
						</a>
					</div>
				</div>
				<div class = "col-xl-2 col-md-3 exchange-card">
					<div class = "card card-stats">
						<a href = "#">
							<div class = "card-body exchange-card-body">
								<div class = "col-auto" style = "text-align: center;">
									<img src = "./assets/img/icons/pulsa.svg" alt = "">
								</div>
								<p class = "mt-3 mb-0 exchange-title" style = "text-align: center;">Pulsa</p>
							</div>
						</a>
					</div>
				</div>
			</div>

			<!-- Room -->
			<div id = "room">
				<div class = "col-xl-3 col-md-6 class-title"><p>Ruangan Arisan</p></div>
				<div class = "row">
					<?php foreach( $kelas_list as $kelas ) : ?>
						<div class = "col-xl-3 col-md-6">
							<div class = "card card-stats">
								<a href = "room-join.php?k=<?= $kelas["id"] ?>">
									<div class = "card-body <?= $kelas["color"] ?>-card text-white">
										<div class = "row">
											<div class = "col">
												<span>Kelas <?= ucfirst( $kelas["name"] ) ?></span></br>
												<span class = "h1 font-weight-bold mb-0 text-white"><?= rupiah( $kelas["price"] ) ?></span>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Footer -->
			<footer class = "footer pt-0">
				<div class = "row align-items-center justify-content-lg-between">
					<div class = "col-lg-6">
						<div class = "copyright text-center text-lg-left text-muted">
							&copy; 2022 <a class = "font-weight-bold ml-1" href = "index.php" target = "_blank" style = "color:#0088cf!important;">Hasyim dan Mayada</a>
						</div>
					</div>
					<div class = "col-lg-6">
						<ul class = "nav nav-footer justify-content-center justify-content-lg-end">
							<li class = "nav-item">
								<a class = "nav-link" href = "https://www.instagram.com/hasyimasya_ri/" target = "_blank">Tentang Hasyim</a>
							</li>
							<li class = "nav-item">
								<a class = "nav-link" href = "https://www.instagram.com/mydzzh/" target = "_blank">Tentang Mayada</a>
							</li>
						</ul>
					</div>
				</div>
			</footer>
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