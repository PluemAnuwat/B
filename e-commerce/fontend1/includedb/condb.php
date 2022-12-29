<?php

$pass = 'akom2006';
$host = 'localhost';
// $host = '192.168.0.134';
$usr = 'root';
$dbname = 'akk_ecommerce';	

$conn = mysqli_connect($host,$usr,$pass);
mysqli_select_db($conn,$dbname);
mysqli_query($conn,"set names utf8");

?>