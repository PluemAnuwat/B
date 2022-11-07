<?php
	ob_start();
	session_start();

	$Line = $_GET["Line"];
	$_SESSION["strProductID4000"][$Line] = "";
	$_SESSION["strQty"][$Line] = "";

	header("location:index.php?page=po&function=insert");
?>