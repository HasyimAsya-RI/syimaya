<?php
	// Init Database & Check If User is Not Logged In
	require_once __DIR__ . "/config/session.php";

	// Profile Update
	if( isset($_POST['update']) ) {
		$name    = $_POST['name'];
		$address = $_POST['domisili'] ? $domisili_list[$_POST['domisili']] : "Lokasi tidak diketahui!";
		$birth   = $_POST['birth'];

		$name    = mysqli_real_escape_string( $conn, $name );
		$address = mysqli_real_escape_string( $conn, $address );
		$birth   = mysqli_real_escape_string( $conn, $birth );

		if( file_exists( $_FILES["photo"]["tmp_name"] ) || is_uploaded_file( $_FILES["photo"]["tmp_name"]) ) {
			$photoName      = $_FILES["photo"]["name"];
			$photoTmpName   = $_FILES["photo"]["tmp_name"];
			$photoSize      = $_FILES["photo"]["size"];
			$photoExt       = explode( ".", $photoName );
			$photoActualExt = strtolower( end($photoExt) );
			$allowed        = array( "jpg", "jpeg", "png" );

			if( $photoSize < 5000000 && $photoSize > 0 ) {

				if( in_array($photoActualExt, $allowed) ) {
					$photoName        = uniqid( "", true ) . "." . $photoActualExt;
					$photoDestination = "assets/img/photos/" . $photoName;
					move_uploaded_file( $photoTmpName, $photoDestination );

					if( strlen( $user['photo'] ) > 0 ) {

						if( file_exists("assets/img/photos/" . $user['photo']) ) {
							unlink( "assets/img/photos/" . $user['photo'] );
						}
					}
					$user["photo"] = $photoName;
				}
				else {
					$msgError = "Jenis file tidak diizinkan!";
				}
			}
			else {
				$msgError = "Ukuran file terlalu besar!";
			}
		}
		else {
			$photoName = $user['photo'];
		}

		if( !isset($msgError) ) {
			$update = mysqli_query( $conn, "UPDATE user SET name = '$name', address = '$address', birth = '$birth', photo = '$photoName' WHERE email = '$email'" );
			$msgSuccess = "Profil berhasil diperbarui.";
			
			// Refresh Call Session
			require __DIR__ . "/config/session.php";
		}
		else {
			$msgError = $msgError ?? "Gagal memperbarui profil!";
		}
	}

	if( isset($_POST["updatepass"]) ) {
		$oldpass     = $_POST["oldpass"];
		$newpass     = $_POST["newpass"];
		$confirmpass = $_POST["confirmpass"];

		// Check If New Password is Empty or Min 8 Characters
		if( !$newpass or strlen( $newpass ) < 8 ) {
			$msgErrorPass = "Kata sandi baru minimal 8 karakter";
		}
		// Check If Old Password is Correct
		elseif( $oldpass !== $user["password"] ) {
			$msgErrorPass = "Kata sandi lama salah";
		}
		// Check If New Password is Same as Old Password
		elseif( $oldpass === $newpass ) {
			$msgErrorPass = "Kata sandi baru tidak boleh sama dengan kata sandi lama";
		}
		// Check If New Password is Same as Confirm Password
		elseif( $newpass !== $confirmpass ) {
			$msgErrorPass = "Konfirmasi kata sandi baru tidak sama";
		}

		if( empty($msgErrorPass) ) {
			$update = mysqli_query( $conn, "UPDATE user SET password = '$newpass' WHERE email = '$email'" );
			if( isset($update) ) {
				$msgSuccessPass = "Kata sandi berhasil diperbarui.";
			}
			else {
				$msgErrorPass = "Gagal memperbarui kata sandi!";
			}
		}
	}
?>


<!DOCTYPE html>
<html lang = "id">

<head>
	<meta charset    = "UTF-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	<meta name       = "viewport" content = "width=device-width, initial-scale=1.0">

	<title>Profil - syiMaya</title>

	<link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
	<link rel = "stylesheet" href = "./assets/css/styles/profile.css" type = "text/css">
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
							<a class = "nav-link" href = "room.php?k=<?= findKelasLastID( $kelas_list ) ?>">
								<img  src   = "./assets/img/icons/ruangan.svg" alt = "" style = "width:20px; margin-right:13px">
								<span class = "nav-link-text">Ruangan</span>
							</a>
						</li>
						<li class = "nav-item">
							<a class = "nav-link active" href = "profile.php">
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
		<div class = "header pb-6 d-flex align-items-center" style = "min-height: 500px; background-image: url( ./assets/img/themes/cover_1.jpg ); background-size: cover; background-position: center top;">
			<span class = "mask bg-gradient-custom opacity-8"></span>
			<div  class = "container-fluid d-flex align-items-center">
				<div class = "row">
					<div class = "col-lg-7 col-md-12">
						<h1 class = "display-2 text-white">Halo, <?php echo $user['name']; ?>!</h1>
						<p  class = "text-white mt-0 mb-5">Ini adalah halaman profilmu. Kamu dapat mengganti semua data diri di sini.</p>
					</div>
				</div>
			</div>
		</div>

		<div class = "container-fluid mt--6">
			<div class = "row">
				<!-- Profile -->
				<div class = "col-xl-4 order-xl-2">
					<div class = "card card-profile">
						<img class = "card-img-top" src = "./assets/img/themes/cover_2.jpg" alt = "Image placeholder">
						<div class = "row justify-content-center">
							<div class = "col-lg-3 order-lg-2">
								<div class = "card-profile-image">
									<a href = "#">
										<img class = "rounded-circle" src = "./assets/img/photos/<?= empty( $user["photo"] ) ? "default.jpg" : $user["photo"] ?>" alt = "User Photos">
									</a>
								</div>
							</div>
						</div>
						<div class = "card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4"></div>
						<div class = "card-body pt-0">
							<div class = "row">
								<div class = "col">
									<div class = "card-profile-stats d-flex justify-content-center"></div>
								</div>
							</div>
							<div class = "text-center">
								<span class = "badge badge-primary">
									<?= $user["role"] ?>
								</span>
								<h2 class = "h2">
									<?php echo $user['name']; ?>
								</h2>
								<h5 class = "font-weight-300">
									<i class = "ni ni-pin-3"></i>
									<?php echo $user['address'] ?>
								</h5>
								<div>
									<?= rupiah( $user["saldo"] ) ?>
								</div>
							</div>
						</div>
					</div>
					<?php if( $user["role"] == "admin" ) : ?>
						<div class = "card">
							<div class = "card-profile-stats d-flex justify-content-center">
								<div>
									<span class = "heading">4</span>
									<span class = "description">Arisan</span>
								</div>
								<div>
									<span class = "heading">12</span>
									<span class = "description">Peserta</span>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class = "col-xl-8 order-xl-1">
					<!-- Identity Update-->
					<div class = "card">
						<div class = "card-header">
							<div class = "row align-items-center">
								<div class = "col-12">
									<h3 class = "mb-0">Edit Profil </h3>
								</div>
							</div>
						</div>
						<div class = "card-body">
							<?php if( isset($msgSuccess) ) : ?>
								<div class = "alert alert-success alert-dismissible" role = "alert">
									<span   class = "alert-text"><strong>Berhasil!</strong> <?= $msgSuccess; ?></span>
									<button class = "close" type = "button" data-dismiss = "alert" aria-label = "Close">
										<span aria-hidden = "true">&times;</span>
									</button>
								</div>
							<?php elseif( isset($msgError) ) : ?>
								<div class = "alert alert-danger alert-dismissible" role = "alert">
									<span   class = "alert-text"><strong>Gagal!</strong> <?= $msgError; ?></span>
									<button class = "close" type = "button" data-dismiss = "alert" aria-label = "Close">
										<span aria-hidden = "true">&times;</span>
									</button>
								</div>
							<?php else : ?>
								<div class = "alert alert-info">Silakan edit data dirimu dengan benar.</div>
							<?php endif; ?>

							<form action = "./profile.php" method = "post" enctype = "multipart/form-data">
								<div class = "form-group">
									<label class = "form-control-label" for = "input-email">Email:</label>
									<input class = "form-control" type = "email" name = "email" id = "input-email"
										   value = "<?php echo $user['email']; ?>" readonly>
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "input-name">Nama lengkap:</label>
									<input class = "form-control" type = "text" name = "name" id = "input-name"
										   value = "<?php echo $user['name']; ?>" placeholder="Masukkan nama yang tertulis di kartu identitas.">
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "domisili">Domisili:</label>
									<select class = "form-control" id = "domisili" name = "domisili" required>
										<option value = "">-- Pilih Domisili --</option>
										<?php foreach( $domisili_list as $k => $v ) : ?>
											<option value = "<?= $k ?>" <?= ( "Pulau $v" == $user["address"] ? "selected" : "" ) ?>><?= $v ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "input-city">Jenis kelamin:</label>
									<input class = "form-control" type = "text" name = "sex" id = "sex"
										   value = "<?php echo $user['sex']; ?>" readonly>
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "input-birth">Tanggal lahir:</label>
									<input class = "form-control" type = "date" name = "birth" id = "input-birth"
										   value = "<?php echo $user['birth']; ?>">
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "input-photo">Foto:</label>
									<input class = "form-control" type = "file" name = "photo" id ="input-photo">
								</div>
								<div class = "form-group">
									<button class = "btn btn-primary" type = "submit" name = "update">Simpan Profil</button>
								</div>
							</form>
						</div>
					</div>

					<!-- Password Update -->
					<div class = "card">
						<div class = "card-header">
							<div class = "row align-items-center">
								<div class = "col-12">
									<h3 class = "mb-0">Edit Kata Sandi</h3>
								</div>
							</div>
						</div>
						<div class = "card-body">
							<?php if( isset($msgSuccessPass) ) : ?>
								<div class = "alert alert-success alert-dismissible" role = "alert">
									<span class = "alert-text"><strong>Berhasil!</strong> <?= $msgSuccessPass; ?></span>
									<button class = "close" type = "button" data-dismiss = "alert" aria-label = "Close">
										<span aria-hidden = "true">&times;</span>
									</button>
								</div>
							<?php elseif( isset($msgErrorPass) ) : ?>
								<div class = "alert alert-danger alert-dismissible" role = "alert">
									<span class = "alert-text"><strong>Gagal!</strong> <?= $msgErrorPass; ?></span>
									<button class = "close" type = "button" data-dismiss = "alert" aria-label = "Close">
										<span aria-hidden = "true">&times;</span>
									</button>
								</div>
							<?php else : ?>
								<div class = "alert alert-info">Silahkan ganti keamanan dengan benar.</div>
							<?php endif; ?>

							<form action = "./profile.php" method = "post">
								<div class = "form-group">
									<label class = "form-control-label" for = "input-oldpass">Kata sandi lama:</label>
									<input class = "form-control" type = "password" name = "oldpass" id = "input-oldpass"
										   placeholder = "Masukkan kata sandi lama." required>
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "input-newpass">Kata sandi baru:</label>
									<input class = "form-control" type = "password" name = "newpass" id = "input-newpass"
										   minlength = "8" placeholder = "Masukan kata sandi baru." required>
								</div>
								<div class = "form-group">
									<label class = "form-control-label" for = "input-confirmpass">Konfirmasi kata sandi baru:</label>
									<input class = "form-control" type = "password" name = "confirmpass" id = "input-confirmpass"
										  minlength = "8" placeholder = "Konfirmasi kata sandi baru." required>
								</div>
								<div class = "form-group">
									<button class = "btn btn-primary" type = "submit" name = "updatepass">Simpan Kata Sandi</button>
								</div>
							</form>
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