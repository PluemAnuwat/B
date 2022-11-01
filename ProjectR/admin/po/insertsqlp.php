<?php
session_start();

$connect = mysqli_connect("localhost","root","akom2006","project");

  $strSQL = "
	INSERT INTO po (po_create,po_RefNo,po_buyer,po_saler,po_status)
	VALUES
	('".date("Y-m-d H:i:s")."','".$_POST["po_RefNo"]."','".$_SESSION['posit_login']."' ,'".$_POST["po_saler"]."','รอยืนยัน') ";


  mysqli_query($connect , $strSQL) or die(mysqli_error());

  $strOrderID = mysqli_insert_id($connect);

  for($i=0;$i<=(int)$_SESSION["intLine4000"];$i++)
  {
	  if($_SESSION["strProductID4000"][$i] != "")
	  {
			  $strSQL = "
				INSERT INTO po_detailproduct (po_id,product_id,product_quantity)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID4000"][$i]."','".$_SESSION["strQty"][$i]."') 
			  ";
			  mysqli_query($connect , $strSQL) or die(mysqli_error());
	  }
  }

mysqli_close();

session_destroy();

header("location:index.php?page=po");

?>