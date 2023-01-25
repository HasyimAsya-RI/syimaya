<?php
	session_start();
	date_default_timezone_set( "Asia/Jakarta" );
	
	// MySQLi Database Configuration
	$username = "uxr9k3ufkanuclcf";
	$password = "BfcF8OkLpnywGkR4qlhx";
	$hostname = "bxxzqzl8vt7afqbiijwt-mysql.services.clever-cloud.com";
	$dbname   = "bxxzqzl8vt7afqbiijwt";

	try {
		$conn = new mysqli( $hostname, $username, $password, $dbname );
	}
	catch( \Throwable $e ) {
		die( "Connection failed:" . $e->getMessage() );
	}
?>
