<?php
    require_once __DIR__ . "/db.php";

    // Check Session
    if( !isset($_SESSION['email']) ) {
        header( 'Location: login.php?e' );
        exit;
    }
    else {
        $email  = $_SESSION['email'];
        $select = mysqli_query( $conn, "SELECT * FROM user WHERE email = '$email'" );
        $user   = mysqli_fetch_array( $select );
    }

    require_once __DIR__ . "/libs.php";
?>