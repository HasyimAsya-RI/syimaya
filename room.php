<?php
	// Init Database & Check If User is Not Logged In
	require_once __DIR__ . "/config/session.php";

	$k              = isset( $_GET["k"] ) ? $_GET["k"] : NULL;
	$kelas          = findKelasByID( $k, $kelas_list );
	$kelas_name     = isset( $kelas ) ? ucfirst( $kelas["name"] ) : "";

	$quota          = isset( $kelas ) ? $kelas["quota"] : 10;

	$member_query   = mysqli_query( $conn, "SELECT * FROM user WHERE role = 'member' LIMIT $quota" );
	$members        = mysqli_fetch_all( $member_query, MYSQLI_ASSOC );

	$random_members = shuffle( $members );
?>


<!DOCTYPE html>
<html lang = "id">

<head>
	<meta charset    = "UTF-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	<meta name       = "viewport" content = "width=device-width, initial-scale=1.0">

	<title>Ruangan - syiMaya</title>

	<link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
	<link rel = "stylesheet" href = "./assets/css/styles/room.css" type = "text/css">
	<link rel = "stylesheet" href = "./assets/css/styles/chat.css">
	<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
							<a class = "nav-link" href = "index.php">
								<i    class = "ni ni-tv-2 text-primary"></i>
								<span class = "nav-link-text">Beranda</span>
							</a>
						</li>
						<li class = "nav-item">
							<a class = "nav-link active" href = "room.php?k=<?= findKelasLastID( $kelas_list ) ?>">
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
		<!-- Top Navigation -->
		<nav class = "navbar navbar-top navbar-expand navbar-dark bg-header-<?= $kelas['color'] ?> border-bottom">
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
		<?php if( isset( $k ) && strlen( $k ) >= 1 ) : ?>
			<div class = "header bg-header-<?= $kelas['color'] ?> pb-5" id = "header">
				<div class = "container-fluid">
					<div class = "header-body">
						<div class = "align-items-center py-4">
							<div class = "">
								<h1 class = "text-white mb-0 text-capitalize">Kelas <?= $kelas_name ?> <?= rupiah( $kelas["price"] ) ?> | <?= $kelas["quota"] ?> Peserta</h1>
								<h2 class = "text-white">Keuntungan <?= rupiah( $kelas["price"] * $kelas["quota"] ) ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class = "container" id = "chat-box">
			<!-- Winner -->
			<div class = "card">
				<div class = "card-header">
					<h2><b>Daftar Urutan Pemenang</b></h2>
				</div>
				<div class = "card-body">
					<ol>
						<?php foreach( $members as $member ) : ?>
							<li><?= $member["name"] ?></li>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>

			<div class = "panel messages-panel">
				<!-- Participant -->
				<div class = "contacts-list">
					<div class = "inbox-categories">
						<div class = "active" data-toggle = "tab" data-target = "#inbox">PESERTA</div>
					</div>
					<div class = "tab-content">
						<div class = "contacts-outter-wrapper tab-pane active" id = "inbox">
							<div class = "contacts-outter">
								<ul class = "list-unstyled contacts">
									<?php foreach( $members as $member ) : ?>
										<li data-toggle = "tab" data-target = "#inbox-message-<?= $member["id"] ?>">
											<img class = "img-circle medium-image" src = "./assets/img/photos/<?= $member["photo"] ?: "default.jpg" ?>" alt = "">
											<div class = "vcentered info-combo">
												<h2 class = "no-margin-bottom"><?= $member["name"] ?></h2>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Chat Box -->
				<div class = "tab-content">
					<div class = "tab-pane message-body active" id = "inbox-message-1">
						<div class = "message-top">
							<a class = "chat-head baru-message">OBROLAN</a>
							<div class = "new-message-wrapper">
								<div class = "form-group">
									<input class = "form-control" type = "text"
										   placeholder = "Kirim pesan ke...">
									<a     class = "btn btn-danger close-new-message" href = "#"><i class = "fa fa-times"></i></a>
								</div>
								<div class = "chat-footer new-message-textarea">
									<textarea class = "send-message-text"></textarea>
									<label    class = "upload-file">
										<input type  = "file" required = "">
										<i     class = "fa fa-paperclip"></i>
									</label>
									<button class = "send-message-button btn-info" type = "button"><i class = "fa fa-send"></i></button>
								</div>
							</div>
						</div>
						<div class = "message-chat">
							<div class = "chat-body">
								<div class = "message info">
									<img class = "img-circle medium-image" src = "./assets/img/icons/bot.svg" alt = "">
									<div class = "message-body">
										<div class = "message-info">
											<h4>syiMaya Bot</h4>
											<h5><i class = "fa fa-clock-o"></i><?= date( "H:i" ) ?></h5>
										</div>
										<hr>
										<div class = "message-text">
											Selamat datang, <?php echo $user['name']; ?>! Jangan lupa ajak temanmu untuk ikut arisan bersama.
										</div>
									</div>
									<br>
								</div>
							</div>
							<div class = "chat-footer">
								<textarea class = "send-message-text"></textarea>
								<label    class = "upload-file">
									<input type  = "file" required = "">
									<i     class = "fa fa-paperclip"></i>
								</label>
								<button class = "send-message-button btn-info" type = "button"><i class = "fa fa-send"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
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

	<!-- If kelas_name is Not Set -->
	<script>
		<?php if( !isset( $k ) || strlen( $k ) < 1 ) : ?>
			$( document ).ready(
				function() {
					alert( "Anda belum memilih kelas, silakan pilih kelas terlebih dahulu!" );
					window.location.href = "index.php";
				}
			);
		<?php endif; ?>
	</script>
</body>

</html>