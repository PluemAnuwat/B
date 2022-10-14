<?php
function datetodb($date)
//    23/04/2564
{
    $day = substr($date, 0, 2); // substrตัดข้อความที่เป็นสติง
    $month = substr($date, 3, 2); //ตัดตำแหน่ง
    $year = substr($date, 6) - 543;
    $dateme = $year . '-' . $month . '-' . $day;
    return $dateme; //return ส่งค่ากลับไป
}

$n = 10;
function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
?>
<?php
if (isset($_POST) && !empty($_POST)) {
    $date = date('Y-m-d , H:i:s');
    $po_buyer = $_SESSION['user_login'];
    $po_saler = $_POST['po_saler'];
    $po_RefNo = $_POST['po_RefNo'];
    $po_status = 'รอใบรับสินค้า';
    @$product_quantity =  $_POST["product_quantity"];
    @$product_total =  $_POST["product_total"];

    //บันทึกการสั่งซื้อลงใน po
    foreach ($_SESSION['carting'] as $product_id => $product_quantity) {
        $total = 0;
        $product_start_date = ($_POST["product_start_date"]["$product_id"]);
        $product_end_date = ($_POST["product_end_date"]["$product_id"]);
        $sql3 = "SELECT * FROM view_product_detail a join view_product_price b on a.product_id = b.product_id where a.product_id= '$product_id'";
        $query3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_array($query3);
        $sum = $row3['product_price_cost'] * $product_quantity;
        $total += $sum;
        $vat = 0.07 * $total;
        $product_total = $total + $vat;
        $count = mysqli_num_rows($query3);
        print_r($row3);

        mysqli_query($con, "BEGIN");

        $sql1 = "INSERT INTO po (po_RefNo,po_create,po_buyer,po_saler,po_status) VALUES('$po_RefNo', '$date', '$po_buyer' , '$po_saler' ,'$po_status')";
        $query1 = mysqli_query($con, $sql1);

        $new_po_id = mysqli_insert_id($con);

        // if($product_start_date == '' && $product_end_date == ''){
        //     $product_start_date = $date;
        //     $product_end_date = date('Y-m-d , H:i:s',strtotime($now . "+3 years"));
        // }

        $sql2 = "INSERT INTO po_detailproduct (product_quantity , product_id , product_total , po_id) VALUES('$product_quantity' , '$product_id' , '$product_total' , '$new_po_id')";
        $query2 = mysqli_query($con, $sql2);

        $sql3 = "INSERT INTO po_status (po_status , po_RefNo , status_cretae)  VALUES ('$po_status' , '$po_RefNo'  , '$date')";
        $query3 = mysqli_query($con, $sql3);
    }
    if ($query1) {
        mysqli_query($con, "COMMIT");
        $message = "บันทึกข้อมูลเรียบร้อยแล้ว ";
        foreach ($_SESSION['carting'] as $product_id) {
            unset($_SESSION['carting']);
        }
    } else {
        mysqli_query($con, "ROLLBACK");
        $message = "บันทึกข้อมูลไม่สำเร็จ";
    }
    mysqli_close($con);
}
?>
<script type="text/javascript">
    alert("<?php echo $message; ?>");
    window.location = '?page=po';
</script>