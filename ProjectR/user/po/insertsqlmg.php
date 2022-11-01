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
                

        }

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            date_default_timezone_set("Asia/Bangkok");
        
            $sToken = "Uv0soCK4s2VPPiO1s8DpbBYp5mHdqz9Y9p5NUpiPsRZ";
        
        
        require '../functionDateThai.php'; 
        
        $con = mysqli_connect("localhost", "root", "akom2006", "project");

        
        $sql1 = "SELECT *   FROM po WHERE po_RefNo = '".$po_RefNo."' ";

        $query1 = mysqli_query($con , $sql1);

        while ($row1 = mysqli_fetch_array($query1)) { 
            
                         $sql2 = "SELECT * 
                         FROM po INNER JOIN po_detailproduct ON po.po_id = po_detailproduct.po_id
                         INNER JOIN product ON po.product_id = product.product_id
                        WHERE po.po_id = '".$row1['po_id']."'    " ;
                             $query2 = mysqli_query($con , $sql2);
                             while ($result2 = mysqli_fetch_array($query2)){ 
   $sMessage1 = '
<----- สั่งซื้อสินค้า ----->
วันที่สั่งซื้อ : '.datethai($row1['po_create']).'
หมายเลขใบสั่งซื้อ :'.$row1['po_RefNo'].'
ผู้สั่งซื้อ :'.$row1['po_buyer'].'
รายการ :'.$result2['product_name'].'
จำนวน :'.$result2['product_quantity'].'
';
                        }
        
                        
                    }
        
                            
         
        
            
            $chOne = curl_init(); 
            curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt( $chOne, CURLOPT_POST, 1); 
            curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage1); 
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
            curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec( $chOne ); 
        
            //Result error 
            if(curl_error($chOne)) 
            { 
                echo 'error:' . curl_error($chOne); 
            } 
            else { 
                $result_ = json_decode($result, true); 
                echo "status : ".$result_['status']; echo "message : ". $result_['message'];
                
            } 
            curl_close( $chOne );   
           
     
    
 
            echo "<script>";
            echo "alert(' เพิ่มใบรับสินค้านี้เรียบร้อยแล้ว !');";
            echo "window.location='index.php?page=po';";
            echo "</script>";



        }


        ?>