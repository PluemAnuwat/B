<?php
	ob_start();
	session_start();

	$Line = $_GET["Line"];
	$_SESSION["strProductID1"][$Line] = "";
    $_SESSION["product_name"][$Line] = "";
	$_SESSION["product_price_cost"][$Line] = "";

	header("location:index.php");
?>