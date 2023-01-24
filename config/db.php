<?php
	session_start();
	date_default_timezone_set( "Asia/Jakarta" );
	
	// MySQLi Database Configuration
	$username = "root";
	$password = "";
	$hostname = "localhost";
	$dbname   = "syimaya";

	try {
		$conn = new mysqli( $hostname, $username, $password, $dbname );
	}
	catch( \Throwable $e ) {
		die( "Connection failed:" . $e->getMessage() );
	}
?>