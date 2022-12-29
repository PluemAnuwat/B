
<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();

$sprod_id = $_POST['sprod_id'];
        

			$sql = "SELECT sprod_price , sprod_sku  FROM akksofttech_subproduct WHERE sprod_id = '".$sprod_id."' ";
            

            $result = mysqli_query($connect,$sql);
            $reslutArray = array();
            while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{
                    $arrayprice = array( 
                                     
                                        "sprod_price" => $data['sprod_price'],    
                                        "sprod_sku" => $data['sprod_sku'] 
                                    );
                    array_push($reslutArray , $arrayprice);

            }										
            echo json_encode($reslutArray);


?>