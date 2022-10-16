<?php
ob_start();
session_start();
	
if(!isset($_SESSION["intLine1"]))
{

	 $_SESSION["intLine1"] = 0;
	 $_SESSION["strProductID1"][0] = $_GET["product_id"];
	 $_SESSION["strQty1"][0] = 1;

	 header("location:index.php");
}
else
{
	
	$key = array_search($_GET["product_id"], $_SESSION["strProductID1"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty1"][$key] = $_SESSION["strQty1"][$key] + 1;
	}
	else
	{
		
		 $_SESSION["intLine1"] = $_SESSION["intLine1"] + 1;
		 $intNewLine = $_SESSION["intLine1"];
		 $_SESSION["strProductID1"][$intNewLine] = $_GET["product_id"];
		 $_SESSION["strQty1"][$intNewLine] = 1;
	}
	
	 header("location:index.php");

}
?>