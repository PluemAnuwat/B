<?php
	


	$servername = 'localhost';
	// $servername = '192.168.0.134';
	$username = 'root';
	$pass = 'akom2006';
	$dbname = 'akk_ecommerce';	


	try {
		$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}








?>