<?php

require '../includedb/condb.php' ;
	

if ($_POST) {

$cus_id = $_POST['cus_id'] ; 

$cus_name = $_POST['cus_name'] ; 

$cus_surname = $_POST['cus_surname'] ; 

$cus_phone = $_POST['cus_phone'] ; 

$cus_email = $_POST['cus_email'] ; 

echo $sql = "UPDATE akksofttech_customer SET cus_name = '".$cus_name."' , cus_name = '".$cus_name."' , cus_surname = '".$cus_surname."' , cus_phone = '".$cus_phone."' ,
 cus_email = '".$cus_email."'  WHERE cus_id = '".$cus_id."'" ;

$que = mysqli_query($conn , $sql) ; 

if(!$que){

    $coms = "NO";

}else{
    $coms = "YES";


}



}


$json=array('status'=> $coms  ); 
$resultArray = array();
array_push($resultArray,$json);
echo json_encode($resultArray);

?>