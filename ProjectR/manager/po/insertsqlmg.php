
<?php
$n = 10;
function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0,  strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

$connect = mysqli_connect("localhost","root","akom2006","project");

if (isset($_GET['po_RefNo']) && !empty($_GET['po_RefNo'])) {
    $po_RefNo = $_GET['po_RefNo'];
    $good_RefNo = getName($n);
    $sql = "SELECT * FROM po a JOIN po_detailproduct b ON a.po_id = b.po_id WHERE a.po_RefNo = '$po_RefNo' AND a.po_status = 'รอยืนยัน' ";
    $query = mysqli_query($connect, $sql);

   
        while ($result = mysqli_fetch_assoc($query)) {
            $po_RefNo = $_GET['po_RefNo'];
            $date = date('Y-m-d H:i:s');
        
            $sqlinsert = "INSERT INTO goods(good_RefNo  , po_buyer , good_status)
                    values( '$good_RefNo'  , '$result[po_buyer]' , '0')";
            $query2 = mysqli_query($connect, $sqlinsert);
            $new_po_id = mysqli_insert_id($connect);
        
            $sqlinsert1 = "INSERT INTO goods_detailproduct(po_id , po_RefNo , product_id , product_quantity , product_total , good_id , po_create )
                    values('$result[po_id]' , '$result[po_RefNo]' , '$result[product_id]' , '$result[product_quantity]','$result[product_total]','$new_po_id' , '$date' )";
            $query2 = mysqli_query($connect, $sqlinsert1);
        
            $sqlstatus = "UPDATE  po a JOIN po_detailproduct b ON a.po_id = b.po_id  SET a.po_status = 'สั่งแล้ว' , a.po_RefNo = '$result[po_RefNo]' WHERE a.po_id = '$result[po_id]' ";
            $querystatus = mysqli_query($connect, $sqlstatus);
        
             $sqlold = "INSERT INTO po_status(po_RefNo , po_status , status_create) values('$result[po_RefNo]' ,'สั่งซื้อ' , '$date') ";
             $queryold = mysqli_query($connect, $sqlold);
        
            echo "<script>";
            echo "alert(' เพิ่มใบรับสินค้านี้เรียบร้อยแล้ว !');";
            echo "window.location='index.php?page=po';";
            echo "</script>";
        
        }
    }
?>