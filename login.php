<?php
    require_once __DIR__ . "/config/db.php";

    // Login
    if( isset($_POST['login']) ) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $email    = mysqli_real_escape_string( $conn, $email );
        $password = mysqli_real_escape_string( $conn, $password );

        $select   = mysqli_query( $conn, "SELECT * FROM user WHERE email = '$email' AND password = '$password'" );
        $row      = mysqli_fetch_array( $select );

        if( is_array($row) ) {
            $_SESSION["isLogin"] = true;
            $_SESSION["email"]   = $row['email'];
        }
        else {
            header( "location:login.php?e=wrong" );
        }
    }

    // Check Session
    if( isset($_SESSION["email"]) ) {
        header( "location:index.php" );
    }
?>


<!DOCTYPE html>
<html lang = "id">

<head>
    <meta charset    = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name       = "viewport" content = "width=device-width, initial-scale=1.0">

    <title>Masuk - syiMaya</title>

    <link rel = "icon" href = "./assets/img/brands/logo.png" type = "image/png">
    <link rel = "stylesheet" type = "text/css" href = "./assets/css/bootstrap.min.css" />
    <link rel = "stylesheet" type = "text/css" href = "./assets/css/authentication.css" />
</head>

<body>
    <div class = "bg"></div>
    <form class = "login" method = "POST" action = "./login.php">
        <div class = "top">
            <center><img src = "./assets/img/brands/syimaya.png" style = "width:225px; margin-top: 10px;"></center>
        </div>

        <div class = "middle">
            <!-- Alert -->
            <?php if( isset($_GET["e"]) ) : ?>
                <div class = "alert alert-danger" role = "alert">
                    <?php
                        switch( $_GET["e"] ) {
                            case 'wrong':
                                echo "Email atau kata sandi salah!";
                                break;
                            default:
                                echo "Silakan masuk terlebih dahulu!";
                                break;
                        }
                    ?>
                </div>
            <?php elseif (isset($_GET["r"])) : ?>
                <div class = "alert alert-success" role = "alert">
                    <?php
                        switch ($_GET["r"]) {
                            case 'success':
                                echo "Akun berhasil dibuat, silakan masuk.";
                                break;
                            default:
                                echo "Berhasil keluar dari akun, silakan masuk kembali.";
                                break;
                        }
                    ?>
                </div>
            <?php else : ?>
                <p>Masukkan email dan kata sandi akun Anda/<br /><em>Enter your email and password</em>:</p>
            <?php endif; ?>

            <!-- Main Content -->
            <div class = "form-group">
                <input class = "form-control py-4" id = "inputEmailAddress" name = "email" type = "email" placeholder = "Email" />
            </div>
            <div class = "form-group">
                <input class = "form-control py-4" id = "inputPassword" name = "password" type = "password" placeholder = "Kata Sandi" />
            </div>
            <div class = "form-group text-right">
                <button class = "btn btn-lg btn-primary" name = "login">Masuk</button>
            </div>
        </div>
        
        <div class = "bottom text-center" style = "border-top: 1px solid #ddd; background: #eee;">
            <a href = "register.php">Daftar Akun (<em>Guest Account</em>)</a> &nbsp; | &nbsp; <a href="#">Bantuan (<em>Help</em>)</a>
        </div>
    </form>

    <!-- Remove Alert After 3 Seconds -->
    <script>
        setTimeout(
            function() {
                document.querySelector( ".alert" ).remove();
            }, 3000
        );
    </script>
</body>

</html>