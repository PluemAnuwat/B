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
		$strSQLShow = "SELECT * FROM product a INNER JOIN product_price b ON a.product_id = b.product_id 
		WHERE a.product_id = '".$_SESSION["strProductID4000"][$i]."' ";
		$objQuery = mysqli_query($connect , $strSQLShow)  or die(mysqli_error());
		$objResult = mysqli_fetch_array($objQuery);
		$Total = $_SESSION["strQty"][$i] * $objResult["product_price_cost"];
		$SumTotal = $SumTotal + $Total;
		$Real = (($SumTotal * 0.07) + $SumTotal);

			  $strSQL = "
				INSERT INTO po_detailproduct (po_id,product_id,product_quantity,product_total)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID4000"][$i]."','".$_SESSION["strQty"][$i]."','".$Total."') 
			  ";
			  mysqli_query($connect , $strSQL) or die(mysqli_error());

	  }else{
		echo "<script type='text/javascript'>alert('ไม่มีรายการสินค้า');</script>";
		header("location:index.php?page=po");
	  }
  }



mysqli_close();

unset($_SESSION['intLine4000']);
unset($_SESSION['strProductID4000']);

// session_destroy();

header("location:index.php?page=po");

?>