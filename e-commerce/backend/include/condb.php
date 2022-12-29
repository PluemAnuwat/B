<?php

$pass = 'akom2006';
//$host = 'localhost';
$host = '192.168.0.134';
$usr = 'root';
$dbname = 'akk_ecommerce';	

$connect = mysqli_connect($host,$usr,$pass);
mysqli_select_db($connect,$dbname);
mysqli_query($connect,"set names utf8");

?>