<?php
	// Init Database & Check If User is Not Logged In
	require_once __DIR__ . "/config/session.php";

	if( isset($_POST["inputJumlah"]) ) {
		$total       = $_POST["inputJumlah"];
		$user_id     = $user["id"];
		$total_saldo = $user["saldo"] + $total;

		$total = mysqli_real_escape_string( $conn, $total );

		// Saldo User Update Saldo 
		$update = mysqli_query( $conn, "UPDATE user SET saldo = $total_saldo WHERE id = $user_id" );
	}
?>


<!DOCTYPE html>
<html lang = "id">

<head>
	<meta charset    = "UTF-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	<meta name       = "viewport" content = "width=device-width, initial-scale=1.0">

	<title>Konfirmasi Pembayaran - syiMaya </title>

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

	<!-- Main Content -->
	<div class = "main-content">
		<div class = "container">
			<div class = "row justify-content-center mt-5">
				<div class = "col-lg-8">
					<div class = "card">
						<div class = "card-header text-center">
							<h2>Konfirmasi Pembayaran</h2>
						</div>
						<div class = "card-body">
							<!-- Confirmation -->
							<div class = "table-responsive px-3">
								<table class = "table table-bordered">
									<tbody>
										<tr>
											<td>Nama</td>
											<td><?= $user["name"] ?></td>
										</tr>
										<tr>
											<td>Rekening Pembayaran</td>
											<td><?= isset( $_POST["via"] ) ? strtoupper( $_POST["via"] ) : "" ?></td>
										</tr>
										<tr>
											<td>Jumlah Nominal</td>
											<td><?= isset( $_POST["inputJumlah"] ) ? rupiah( $_POST["inputJumlah"] ) : "" ?></td>
										</tr>
										<tr>
											<td>Rekening Tujuan</td>
											<td>20121832 20121662</td>
										</tr>
									</tbody>
								</table>
							</div>

							<!-- Evidence -->
							<form class = "px-3 mt-3" id = "buktiTransfer">
								<div class = "form-group mb-2">
									<label class = "form-control-label" for = "input-proof">Bukti Transaksi</label>
									<input class = "form-control" type = "file" id = "input-proof">
								</div>
							</form>
						</div>
					</div>

					<div class = "d-flex justify-content-between">
						<button class = "btn btn-info" onclick = "history.go( -1 );">Kembali</button>
						<button class = "btn btn-primary" type = "button" id = "selesai">Selesai</button>
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

	<!-- Click #selesai and Hide #buktiTransfer -->
	<script>
		$( "#selesai" ).on(
			"click", function() {
				$( "#buktiTransfer" ).slideUp();
				$( ".card-header" ).html( "Status Pembayaran Berhasil" );
			}
		);
	</script>
</body>

</html>