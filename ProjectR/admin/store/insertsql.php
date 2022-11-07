<?php
session_start();

$connect = mysqli_connect("localhost","root","akom2006","project");


function random_char($len)
{
     $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //ตัวอักษรที่สามารถสุ่มได้
     $ret_char = "";
     $num = strlen($chars);
     for ($i = 0; $i < $len; $i++) {
          $ret_char .= $chars[rand() % $num];
          $ret_char .= "";
     }
     return $ret_char;
}

//   $strSQL = "
// 	INSERT INTO po (po_create,po_RefNo,po_buyer,po_saler,po_status)
// 	VALUES
// 	('".date("Y-m-d H:i:s")."','".$_POST["po_RefNo"]."','0' ,'".$_POST["po_saler"]."','รอยืนยัน') ";

//   print_r($strSQL);

//   mysqli_query($connect , $strSQL) or die(mysqli_error());

//   $strOrderID = mysqli_insert_id($connect);
  for($i=0;$i<=(int)$_SESSION["intLine1"];$i++)
  {
	  if($_SESSION["strProductID1"][$i] != "")
	  {

			$strSQL = "
				INSERT INTO sales (sales_RefNo , sales_date,sales_get,product_quantity,customer_id,product_id,sales_change,product_total)
				VALUES
				('".random_char(10)."' , '".date("Y-m-d H:i:s")."','".$_POST['sales_get']."','".$_SESSION["strQty1"][$i]."','".$_POST['customer_id']."','".$_SESSION["strProductID1"][$i]."','".$_POST['VatTotal']."','".$product_total."') 
			";

			
			$strSQL = " 
				UPDATE product_quantity SET product_quantity = '".$_SESSION["strQty1"][$i]."'  WHERE product_id = '".$_SESSION["strProductID1"][$i]."'
			" ; 
				
					

				mysqli_query($connect , $strSQL) or die(mysqli_error());
	  }
  }


mysqli_close();

session_destroy();

header("location:index.php?page=po");

?>