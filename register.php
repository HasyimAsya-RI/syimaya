<?php
    require_once __DIR__ . "/config/db.php";
    require_once __DIR__ . "/config/libs.php";

    // Register
    if( isset($_POST['register']) ) {
        $email           = $_POST['email'];
        $password        = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $name            = $_POST['name'] ? ucwords( $_POST['name'] ) : "Nama tidak dikenal!";
        $domisili        = $_POST['domisili'] ? "Pulau " . $domisili_list[$_POST['domisili']] : "Lokasi tidak diketahui!";
        $sex             = $_POST["sex"] == 1 ? "Pria" : "Wanita";
        $birth           = $_POST["birth"];

        $select   = mysqli_query( $conn, "SELECT * FROM user WHERE email = '$email'" );
        $row      = mysqli_fetch_array( $select );

        $name     = mysqli_real_escape_string( $conn, $name );
        $domisili = mysqli_real_escape_string( $conn, $domisili );
        $sex      = mysqli_real_escape_string( $conn, $sex );
        $birth    = mysqli_real_escape_string( $conn, $birth );

        // Check Email Exist
        if( is_array($row) ) {
            header( "location:register.php?e=exist" );
            die();
        }

        // Check Password Match
        if( $password !== $confirmPassword ) {
            header( "location:register.php?e=not_match" );
            die();
        }

        // Check Password Length
        if( strlen( $password ) < 8 ) {
            header( "location:register.php?e=short" );
            die();
        }

        // Check Name Length
        if( strlen( $name ) < 4 ) {
            header( "location:register.php?e=name_short" );
            die();
        }

        // Check Photo Size
        if( $photoSize > 5000000 && $photoSize < 0 ) {
            header( "location:register.php?e=photo_size" );
            die();
        }

        // Check Photo
        if( file_exists($_FILES["photo"]["tmp_name"]) || is_uploaded_file($_FILES["photo"]["tmp_name"]) ) {
            $photoName      = $_FILES["photo"]["name"];
            $photoTmpName   = $_FILES["photo"]["tmp_name"];
            $photoSize      = $_FILES["photo"]["size"];
            $photoExt       = explode( ".", $photoName );
            $photoActualExt = strtolower( end($photoExt) );
            $allowed        = array( "jpg", "jpeg", "png" );

            if( in_array($photoActualExt, $allowed) ) {
                $photoName        = uniqid( "", true ) . "." . $photoActualExt;
                $photoDestination = "assets/img/photos/" . $photoName;

                move_uploaded_file( $photoTmpName, $photoDestination );
            }
            else {
                $msgError = "Jenis file tidak diizinkan!";
            }
        }

        // Insert Data
        $insert = mysqli_query( $conn, "
            INSERT INTO user( email, password, name, address, sex, birth, photo, role )
            VALUES( '$email', '$password', '$name', '$domisili', '$sex', '$birth', '$photoName', 'member' )
        " );

        if( $insert ) {
            header( "location:login.php?r=success" );
        }
        else {
            header( "location:register.php?e=failed" );
        }
    }

    // Check Session
    if( isset($_SESSION["email"]) ) {
        header( "location:/" );
    }
?>


<!DOCTYPE html>
<html lang = "id">

<head>
    <meta charset    = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name       = "viewport" content = "width=device-width, initial-scale=1">

    <title>Daftar - syiMaya</title>

    <link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
    <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity = "sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin = "anonymous">
</head>

<body>
    <div class = "bg-light">
        <div class = "min-vh-100 d-flex justify-content-center align-items-center">
            <div class = "col-lg-6 my-5">
                <!-- Alert -->
                <?php if( isset($_GET["e"]) ) : ?>
                    <div class = "alert alert-danger">
                        <strong>Gagal!</strong>
                        <?php switch( $_GET["e"] ) {
                            case 'exist':
                                echo "Email sudah terdaftar.";
                                break;
                            case 'not_match':
                                echo "Kata sandi tidak cocok.";
                                break;
                            case 'short':
                                echo "Kata sandi terlalu pendek.";
                                break;
                            case 'name_short':
                                echo "Nama terlalu pendek.";
                                break;
                            case 'photo_size':
                                echo "Ukuran foto terlalu besar.";
                                break;
                            default:
                                echo "Terjadi kesalahan.";
                                break;
                        } ?>
                    </div>
                <?php endif; ?>

                <!-- Main Content -->
                <div class = "card">
                    <div class = "card-header py-3">
                        <h4>Daftar Peserta Arisan</h4>
                    </div>
                    <div class = "card-body">
                        <form action = "./register.php" method = "POST" enctype = "multipart/form-data" autocomplete = "off">
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "email">Email</label>
                                <div   class = "col-sm-8">
                                    <input class = "form-control" type = "email" id = "email" name = "email"
                                           placeholder = "Email" required>
                                </div>
                            </div>
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "password">Kata sandi</label>
                                <div   class = "col-sm-8">
                                    <input class = "form-control" type = "password" id = "password" name = "password"
                                           placeholder = "Kata Sandi" required>
                                </div>
                            </div>
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "confirm-password">Konfirmasi kata sandi</label>
                                <div   class = "col-sm-8">
                                    <input class = "form-control" type = "password" id = "confirm-password" name = "confirm-password"
                                           placeholder = "Konfirmasi Kata Sandi" required>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "name">Nama Lengkap</label>
                                <div   class = "col-sm-8">
                                    <input class = "form-control" type = "text" id = "name" name = "name"
                                           placeholder = "Nama Lengkap" required>
                                </div>
                            </div>
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "domisili">Domisili</label>
                                <div   class = "col-sm-8">
                                    <select class = "form-select" id = "domisili" name = "domisili" required>
                                        <option selected value = "">-- Pilih Domisili --</option>
                                        <?php foreach( $domisili_list as $k => $v ) : ?>
                                            <option value = "<?= $k ?>"><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class = "mb-3 row">
                                <div class = "col-sm-4">Jenis Kelamin</div>
                                <div class = "col-sm-8">
                                    <div class = "form-check">
                                        <input class = "form-check-input" type = "radio" name = "sex" id = "flexRadioDefault1" value = "1">
                                        <label class = "form-check-label" for = "flexRadioDefault1">Pria</label>
                                    </div>
                                    <div class = "form-check">
                                        <input class = "form-check-input" type = "radio" name = "sex" id = "flexRadioDefault2" value = "2">
                                        <label class = "form-check-label" for = "flexRadioDefault2">Wanita</label>
                                    </div>
                                </div>
                            </div>
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "tanggal-lahir">Tanggal Lahir</label>
                                <div   class = "col-sm-8">
                                    <input class = "form-control" type = "date" value = "2021-01-01" id = "tanggal-lahir" name = "birth">
                                </div>
                            </div>
                            <div class = "mb-3 row">
                                <label class = "col-sm-4 col-form-label" for = "foto-profil">Foto</label>
                                <div   class = "col-sm-8">
                                    <input class = "form-control" type = "file" id = "foto-profil" name = "photo">
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "d-grid gap-2">
                                    <button class = "btn btn-lg btn-primary" type = "submit" name = "register">Buat Akun Baru</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <p class = "my-3 text-center">
                    <a href = "./login.php">Sudah Memiliki Akun</a>
                </p>
            </div>
        </div>
    </div>

    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity = "sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin = "anonymous"></script>
</body>

</html>