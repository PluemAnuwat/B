<?php
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
date_default_timezone_set("asia/bangkok");
?>

<?php
if (isset($_POST) && !empty($_POST)) {
    $date = date('Y-m-d , H:i:s');
    $sales_RefNo = getName($n);
    $sales_date = date('Y-m-d');
    $sales_get = $_POST['sales_get'];
    $sales_change = $_POST['sales_change'];
    $product_total = $_POST['product_total'];
    @$product_id = $_POST['product_id'];
    @$customer_id = $_POST['customer_id'];
    foreach ($_SESSION['storeing'] as $product_id => $product_quantity) {
        echo $product_id;
        $total = 0;
        $sql3 = "SELECT * FROM view_product_stock a where a.product_id= '$product_id'";
        $query3 = mysqli_query($con, $sql3);
        $row3 = mysqli_fetch_array($query3);
        $sum = $row3['product_price_sell'] * $product_quantity;
        $total += $sum;
        $vat = 0.07 * $total;
        $product_total = $total + $vat;
        $count = mysqli_num_rows($query3);
        mysqli_query($con, "BEGIN");

        $sql1 = "INSERT INTO sales (product_total ,sales_RefNo,sales_create,sales_get,sales_change,product_quantity,product_id,customer_id)
        VALUES('$sum','$sales_RefNo', '$date', '$sales_get' , '$sales_change' ,'$product_quantity' , '$product_id' , '$customer_id')";
        $query1 = mysqli_query($con, $sql1);

        // $sql11 = "INSERT INTO customer_history (customer_id , sutomer_history) values ('$customer_id' , '$sales_RefNo')" ;
        // $query11 = mysqli_query($con , $sql11);

        // print_r($sql11);
        // exit;
        
        $sql2 = "select max(sales_id) as sales_id from sales where sales_RefNo='$sales_RefNo' ";
        $query2 = mysqli_query($con, $sql2);
        $row = mysqli_fetch_array($query2);
        $sales_id = $row['sales_id'];

        for ($i = 0; $i < $count; $i++) {
            $oldnet =  $row3['product_quantity'];
            $newnet = $oldnet - $product_quantity;
            $sql9 = "UPDATE product_quantity SET  product_quantity = $newnet WHERE  product_id = '$row3[product_id]' ";
            $resuu = mysqli_query($con, $sql9);
        }
  
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
    window.location = '?page=store&function=confirm';
</script>