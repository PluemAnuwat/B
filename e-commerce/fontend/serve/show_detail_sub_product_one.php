<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  

		    $sprodone_id = $_POST['sprodone_id'];

			$sql = "SELECT * FROM akksofttech_subproduct_one 
            
            WHERE sprodone_id = '".$sprodone_id."' ";
        
            $result = mysqli_query($conn,$sql);

            $reslutArray = array();

            $numm = mysqli_num_rows($result) ;


                while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{

                    $arrayBill = array( 
                        
                                        "sprodone_id" => $data['sprodone_id'] ,

                                        "sprodone_name" => $data['sprodone_name'] ,
                                        
                                        "sprodone_quantity" => $data['sprodone_quantity'] ,

                                        "sprodone_price" => $data['sprodone_price'] ,

                                        "sprod_id" => $data['sprod_id'] ,

                                        "sprod_name" => $data['sprod_name'] 

                                    );

                    array_push($reslutArray , $arrayBill);

                         }										

            
         
            echo json_encode($reslutArray);


?>