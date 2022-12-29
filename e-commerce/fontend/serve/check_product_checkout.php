<?php 

session_start() ; 

require_once '../includedb/condb.php';  

 $cus_id = $_SESSION['akksofttechsess_cusid'] ; 

 $cart_select_id = $_POST['cart_select_id'] ; 

 $s = "SELECT * FROM akksofttech_cart  WHERE cus_id = '".$cus_id."' AND cart_id = '".$cart_select_id."' " ; 

 $q = mysqli_query($conn , $s ) ; 

 $n = mysqli_num_rows($q)  ;


    if(!$q){

        $coms = 'NO' ; 

    }else{

        $coms = 'YES' ;

        $reslutArray = array();

        while($data =  mysqli_fetch_array($q,MYSQLI_BOTH)){

            $arrayBill = array( 

                        "cart_id" => $data['cart_id']  

                              );

                              array_push($reslutArray , $arrayBill);

        }
        
  
        

    }


   echo json_encode($reslutArray);
?>