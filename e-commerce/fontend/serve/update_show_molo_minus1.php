<?php 

session_start();

require_once '../includedb/condb.php'; 


$cart_id = $_POST['cart_id'] ; 

$quantity = $_POST['quantity'] ; 

echo $sql =  "UPDATE  akksofttech_cart SET quantity = quantity -  ( ( $quantity + 1 ) - quantity )   WHERE cart_id = '".$cart_id."' "; 

$que = mysqli_query($conn , $sql ) ;

if($que){

    $coms = "YES"  ; 

}else{

    $coms = "NO"  ; 

}

$json=array('status'=> $coms ); 

$resultArray = array();

array_push($resultArray,$json);

echo json_encode($resultArray);

?>