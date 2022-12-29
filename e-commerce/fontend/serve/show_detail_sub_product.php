<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  

		    $sprod_id = $_POST['sprod_id'];

			$sql = "SELECT * FROM akksofttech_subproduct INNER JOIN akksofttech_subproduct_one ON  akksofttech_subproduct.sprod_id =  akksofttech_subproduct_one.sprod_id 
            
            WHERE akksofttech_subproduct.sprod_id = '".$sprod_id."' ";
        
            $result = mysqli_query($conn,$sql);

            $reslutArray = array();

            $numm = mysqli_num_rows($result) ;

            if($numm == 0 ){

                $coms = "NO 1" ; 

                $sql_no = "SELECT * FROM akksofttech_subproduct WHERE  sprod_id = '".$sprod_id."' ";

                $result_no = mysqli_query($conn,$sql_no);

                $reslutArray = array();

                while($data_no = mysqli_fetch_array($result_no,MYSQLI_BOTH))	{

                    $arrayBill = array( 
                        
                                        "status" =>   "NO 1"  , 

                                        "sprod_id" => $data_no['sprod_id'] ,

                                        "sprod_name" => $data_no['sprod_name'] ,

                                        "sprod_image" => $data_no['sprod_image'] ,

                                        "sprod_price" => $data_no['sprod_price'] ,

                                        "sprod_sku" => $data_no['sprod_sku'] ,

                                        "sprod_detail" => $data_no['sprod_detail'] ,

                                        "sprod_quantity" => $data_no['sprod_quantity'] ,

                                        "prod_id" => $data_no['prod_id'] ,


                                    );

                    array_push($reslutArray , $arrayBill);

                         }										


            }else{

              


                                while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{

                                    
                                    $arrayBill = array( 

                                        "status" =>   "YES 1"  , 

                                        "sprodone_id" => $data['sprodone_id'] ,

                                        "sprodone_name" => $data['sprodone_name'] ,

                                        "sprodone_image" => $data['sprodone_image'] ,

                                        "sprodone_price" => $data['sprodone_price'] ,

                                        "sprodone_sku" => $data['sprodone_sku'] ,

                                        "sprodone_detail" => $data['sprodone_detail'] ,

                                        "sprodone_quantity" => $data['sprodone_quantity'] ,

                                        "prod_id" => $data['prod_id'] ,

                                        "sprod_id" => $data['sprod_id'] 

                                    );

                    array_push($reslutArray , $arrayBill);
                                
                                }


            }
            
         
            echo json_encode($reslutArray);


?>