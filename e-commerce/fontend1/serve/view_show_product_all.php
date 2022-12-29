<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  

		$showproductall = $_POST['showproductall'];

			$sql = "SELECT * FROM akksofttech_product WHERE cat_id = '".$showproductall."' ";
        
            $result = mysqli_query($conn,$sql);

            $reslutArray = array();
            
            while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{

                    $arrayBill = array( 

                                        "prod_id" => $data['prod_id'] ,

                                        "prod_name" => $data['prod_name'] ,

                                        "prod_image" => $data['prod_image'] ,

                                        "prod_price" => $data['prod_price'] ,

                                        "prod_sku" => $data['prod_sku'] ,

                                        "prod_detail" => $data['prod_detail'] ,

                                        "prod_quantity" => $data['prod_quantity'] ,

                                        "prod_unit" => $data['prod_unit'] ,

                                        "sto_id" => $data['sto_id'] ,

                                        "cat_id" => $data['cat_id'] ,

                                        "scate_id" => $data['scate_id'] ,

                                        "prod_brand" => $data['prod_brand'] 

                                    );

                    array_push($reslutArray , $arrayBill);

            }										

            echo json_encode($reslutArray);

?>