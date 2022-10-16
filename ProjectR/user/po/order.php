<?php
ob_start();
session_start();
	
if(!isset($_SESSION["intLine4000"]))
{

	 $_SESSION["intLine4000"] = 0;
	 $_SESSION["strProductID4000"][0] = $_GET["Prproduct_idoductID"];
	 $_SESSION["strQty"][0] = 1;

	 header("location:index.php?page=po&function=insert");
}
else
{
	
	$key = array_search($_GET["product_id"], $_SESSION["strProductID4000"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
	}
	else
	{
		
		 $_SESSION["intLine4000"] = $_SESSION["intLine4000"] + 1;
		 $intNewLine = $_SESSION["intLine4000"];
		 $_SESSION["strProductID4000"][$intNewLine] = $_GET["product_id"];
		 $_SESSION["strQty"][$intNewLine] = 1;
	}
	
	 header("location:index.php?page=po&function=insert");

}
?>