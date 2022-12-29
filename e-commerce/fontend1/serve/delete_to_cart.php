<?php session_start() ;

require_once '../includedb/condb.php';

$cus_id = $_SESSION['akksofttechsess_cusid'] ;

$ip = $_SERVER['REMOTE_ADDR'] ;

$show_address_id = $_POST['show_address_id'] ; 

$show_sto_id = $_POST['show_sto_id'] ; 

$s = "SELECT * FROM akksofttech_cart  WHERE cus_id = '".$cus_id."' " ;

$q = mysqli_query($conn, $s) ;

$n = mysqli_num_rows($q) ;

if($n > 0 ){

    $ss = "DELETE FROM `akksofttech_cart` WHERE cus_id = '".$cus_id."'  " ; 

    $qq = mysqli_query($conn, $ss) ;

    $nn = mysqli_num_rows($qq) ;

        if($nn){

        $coms = "YES"  ;

        }else{

        $coms = "NO"  ;

        }


}else{

    $coms = "error"  ;

}



$json=array('status'=> $coms  ); 

$resultArray = array();

array_push($resultArray,$json);

echo json_encode($resultArray);

?>