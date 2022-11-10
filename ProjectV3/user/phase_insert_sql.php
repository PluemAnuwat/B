<?php
session_start();

$connect = mysqli_connect("localhost","root","akom2006","project");

$strSQL = "

INSERT INTO po (po_create,po_RefNo,po_buyer,po_saler,po_status)

VALUES

('".date("Y-m-d H:i:s")."','".$_POST["po_RefNo"]."','' ,'".$_POST["po_saler"]."','รอยืนยัน') ";

mysqli_query($connect , $strSQL) or die(mysqli_error());

$strOrderID = mysqli_insert_id($connect);

if (isset($_POST) && !empty($_POST)) {

    $date = date('Y-m-d');

 foreach ($_SESSION['cart'] as $product_id => $product_quantity) {

        $total = 0;

	    $strSQLShow = "SELECT * FROM product a INNER JOIN product_price b ON a.product_id = b.product_id 

		WHERE a.product_id = '".$product_id."' ";

		$objQuery = mysqli_query($connect , $strSQLShow)  or die(mysqli_error());

		$objResult = mysqli_fetch_array($objQuery);

		$Total = $product_quantity * $objResult["product_price_cost"];

		$SumTotal = $SumTotal + $Total;

		$Real = (($SumTotal * 0.07) + $SumTotal);

			  $strSQL = "

				INSERT INTO po_detailproduct (po_id,product_id,product_quantity,product_total ,product_start_date , product_end_date)

				VALUES

				('".$strOrderID."','".$product_id."','".$product_quantity."','".$Total."' , '' , '') 

			  ";

			  mysqli_query($connect , $strSQL) or die(mysqli_error());

 }


 if ($query1) {

    mysqli_query($connect, "COMMIT");

    $message = "บันทึกข้อมูลเรียบร้อยแล้ว ";

    foreach ($_SESSION['cart'] as $product_id) {

        unset($_SESSION['cart']);

    }
} else {

    mysqli_query($connect, "ROLLBACK");

    $message = "บันทึกข้อมูลไม่สำเร็จ";

    unset($_SESSION['cart']);

}

mysqli_close($connect);

}

?>
<script type="text/javascript">
    alert("<?php echo $message; ?>");
    window.location = 'index.php?page=po';
</script>