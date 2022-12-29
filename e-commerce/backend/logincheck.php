<?php

@session_start();

require 'include/condb.php'; 

if (!$_REQUEST){exit();}

$mem_username = $_POST['mem_username'];

$mem_password = $_POST['mem_password'];

$reslutArray = array();

$arrayBill = array();

 $sql = "SELECT * FROM akksofttech_member WHERE  mem_username = '".$mem_username."' AND mem_password = '".$mem_password."' ";

$query = mysqli_query($connect , $sql);

$num = mysqli_num_rows($query);

$result = mysqli_fetch_array($query);

if($num > 0 ){

    $_SESSION['akksofttechsess_memid'] =$result['mem_id'];
    $_SESSION['akksofttechsess_username'] =$mem_username;
    $_SESSION['akksofttechsess_name'] =$result['mem_name'];

$arrayBill = array("status" => 'YES' ,"akksofttechsess_username" => $_SESSION['akksofttechsess_username'],"akksofttechsess_name" => $_SESSION['akksofttechsess_name']);

array_push($reslutArray , $arrayBill);

echo json_encode($reslutArray);

}else{

    $arrayBill = array("status" => 'NO' ,"akksofttechsess_username" => '');

    array_push($reslutArray , $arrayBill);

    echo json_encode($reslutArray);

}

        

?>