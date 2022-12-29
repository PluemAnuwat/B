<?php

@session_start();

require 'includedb/condb.php'; 

if (!$_REQUEST){exit();}

$cus_username = $_POST['cus_username'];

$cus_password = $_POST['cus_password'];

$reslutArray = array();

$arrayBill = array();

$sql = "SELECT cus_id ,  cus_name , cus_username ,  cus_password , cus_surname , cus_phone , cus_email FROM akksofttech_customer WHERE  cus_username = '".$cus_username."' AND cus_password = '".$cus_password."' ";

$query = mysqli_query($conn , $sql);

$num = mysqli_num_rows($query);

$result = mysqli_fetch_array($query);

if($num > 0 ){

        $_SESSION['akksofttechsess_username'] =$cus_username;

        $_SESSION['akksofttechsess_name'] =$result['cus_name'];

        $_SESSION['akksofttechsess_surname'] =$result['cus_surname'];

        $_SESSION['akksofttechsess_cusid'] =$result['cus_id'];

        $_SESSION['akksofttechsess_cusemail'] =$result['cus_email'];

        $_SESSION['akksofttechsess_cusphone'] =$result['cus_phone'];

$arrayBill = array("status" => 'YES' ,"akksofttechsess_username" => $_SESSION['akksofttechsess_username'],"akksofttechsess_name" => $_SESSION['akksofttechsess_name']
, "akksofttechsess_surname" => $_SESSION['akksofttechsess_surname'] , "akksofttechsess_cusid" => $_SESSION['akksofttechsess_cusid'], "akksofttechsess_cusphone" => $_SESSION['akksofttechsess_cusphone'], "akksofttechsess_cusemail" => $_SESSION['akksofttechsess_cusemail']);

array_push($reslutArray , $arrayBill);

echo json_encode($reslutArray);

}else{

    $arrayBill = array("status" => 'NO' ,"akksofttechsess_username" => '');

    array_push($reslutArray , $arrayBill);

    echo json_encode($reslutArray);

}

        

?>