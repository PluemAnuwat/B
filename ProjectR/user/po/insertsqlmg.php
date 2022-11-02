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
    $sql = "SELECT * ,  sum(cc.product_price_cost * b.product_quantity ) as qty ,
    sum(cc.product_price_cost )  as sum ,
    sum(cc.product_price_cost * b.product_quantity ) * 0.07 + sum(cc.product_price_cost * b.product_quantity ) as vat
    FROM po a JOIN po_detailproduct b ON a.po_id = b.po_id 
    INNER JOIN product_price cc ON b.product_id = cc.product_id 
    WHERE a.po_RefNo = '$po_RefNo' AND a.po_status = 'รอยืนยัน' ";

 
    $query = mysqli_query($connect, $sql);

   
        while ($result = mysqli_fetch_assoc($query)) {
            $po_RefNo = $_GET['po_RefNo'];
            $date = date('Y-m-d H:i:s');
            $sum = $result['sum'];
            $vat = $result['vat'];

    
            $sqlinsert = "INSERT INTO goods(good_RefNo  , po_buyer , good_status)
                    values( '$good_RefNo'  , '$result[po_buyer]' , '0')";

            $query2 = mysqli_query($connect, $sqlinsert);

            $new_po_id = mysqli_insert_id($connect);
        
            $sqlinsert1 = "INSERT INTO goods_detailproduct(po_id , po_RefNo , product_id , product_quantity , product_total , good_id , po_create )
                    values('$result[po_id]' , '$result[po_RefNo]' , '$result[product_id]' , '$result[product_quantity]','$vat','$new_po_id' , '$date' )";
                    
            //                 print_r($sqlinsert1);
            // exit;


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


        $product_name = "" ;

        $product_quantity = "";

        $unit_name = "" ;
     
        
        while ($row1 = mysqli_fetch_array($query1)) { 

            $i=1;


                         $sql2 = "SELECT * 
                         FROM po_detailproduct  INNER JOIN po ON po_detailproduct.po_id = po.po_id
                         INNER JOIN product ON po_detailproduct.product_id = product.product_id
                         INNER JOIN unit ON product.product_unit = unit.unit_id
                        WHERE po.po_RefNo = '".$row1['po_RefNo']."'    " ;
                       
                    //     $sql2 = "SELECT * ,(cc.product_price_cost * aa.product_quantity) as plusel  
                    //     FROM po a join po_detailproduct aa ON a.po_id = aa.po_id JOIN product b ON aa.product_id = b.product_id 
                    //    join product c on aa.product_id = c.product_id JOIN product_price cc ON c.product_id = cc.product_id
                    //      WHERE a.po_RefNo = '$po_RefNo'";


                             $query2 = mysqli_query($con , $sql2);
                            //  echo '<pre>'.print_r($sql2).'</pre>' ;
                             while ($result2 = mysqli_fetch_array($query2)){ 
                            $po_buyer = $result2['po_buyer'];

                        //  echo '<pre>'.print_r($po_buyer,2).'</pre>' ;
                        
                            
                                $product_name =  $product_name.$result2['product_name']."\r"."จำนวน : ".$product_quantity.$result2['product_quantity']. "\r" .$unit_name.$result2['unit_name']."\n" ;      
            
                
                        }
        
                        
                    }


                    $sMessage1 = "
<----- สั่งซื้อสินค้า ----->
วันที่สั่งซื้อ : ".($row1['po_create'])."
หมายเลขใบสั่งซื้อ : ".$po_RefNo."
ผู้สั่งซื้อ :". $row1['po_buyer']."      
<====== รายการ ======>               
" .$product_name. "
";


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
           
            //  exit;
    
 
            echo "<script>";
            echo "alert(' เพิ่มใบรับสินค้านี้เรียบร้อยแล้ว !');";
            echo "window.location='index.php?page=po';";
            echo "</script>";



        }


        ?>