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
				INSERT INTO sales (sales_RefNo , sales_date,sales_get,product_quantity,customer_id,product_id,sales_change,product_total,user_login)
				VALUES
				('".random_char(10)."' , '".date("Y-m-d H:i:s")."','".$_POST['sales_get']."','".$_SESSION["strQty1"][$i]."','".$_POST['customer_id']."','".$_SESSION["strProductID1"][$i]."','','".$VatTotal."','".$_SESSION['user_login']."') 
			";
				$resultSQL = mysqli_query($connect , $strSQL);


               $strQTY = "SELECT * FROM product_quantity";
               $resultQTY = mysqli_query($connect  , $strQTY);
               $queryQTY = mysqli_fetch_array($resultQTY);

               $oldqty = $queryQTY['product_quantity'];
               $newqty = $oldqty - $_SESSION['strQty1'][$i]; 

               $strSQL1 = "
                    UPDATE product_quantity SET product_quantity = '$newqty' WHERE product_id = '".$_SESSION['strProductID1'][$i]."' " ; 
                    $resultSQL1 = mysqli_query($connect , $strSQL1);
               }
  }


mysqli_close();

session_destroy();

header("location:index.php?page=po");

?>