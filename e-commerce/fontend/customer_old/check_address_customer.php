<?php
@session_start();

require '../includedb/condb.php' ;

$cusa_id = $_POST['cusa_id'] ; 

$sql = " SELECT * FROM akksofttech_customer_address WHERE cusa_id = '".$cusa_id."' " ; 

$query = mysqli_query($conn , $sql ) ;

$num_rows = mysqli_num_rows($query) ; 

$resultArray = array();

while($result = mysqli_fetch_array($query,MYSQLI_BOTH)){

    array_push($resultArray, array(

        'cus_id'=>$result['cus_id'],

        'cusa_id'=>$result['cusa_id'],

        'cusa_name'=>$result['cusa_name'],

        'cusa_surname'=>$result['cusa_surname'],

        'cusa_province'=>$result['cusa_province'],

        'cusa_zipcode'=>$result['cusa_zipcode'],

        'cusa_address'=>$result['cusa_address'],

        'cusa_note'=>$result['cusa_note'],

        'cusa_phone'=>$result['cusa_phone'],
            
        ));

} 

				
echo json_encode($resultArray,JSON_UNESCAPED_UNICODE);


?>