<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  


        $prod_id = $_POST['show_prod_id']; 

			$sql = "SELECT *   FROM akksofttech_product INNER JOIN akksofttech_subproduct
            
            ON akksofttech_product.prod_id = akksofttech_subproduct.prod_id

              WHERE akksofttech_product.prod_id = '".$prod_id."' ";

            $query = mysqli_query($conn , $sql) ;

            $result = mysqli_fetch_array($query) ;
            
            $numm = mysqli_num_rows($query) ;

                if($numm ==  0 ){

                    $coms = "NO";

                    $sql_no = "SELECT prod_price , prod_quantity FROM akksofttech_product WHERE prod_id = '".$prod_id."' ";

                    $query_no = mysqli_query($conn , $sql_no) ;

                    $result_no = mysqli_fetch_array($query_no) ;

                    $prod_price = $result_no['prod_price'] ;

                    $prod_quantity =  $result_no['prod_quantity'] ;

                }else{

                    $coms = "YES";

                    $prod_price = $result['prod_price'] ;

                    $prod_quantity =  $result['prod_quantity'] ;

                    $sprod_price = $result['sprod_price'] ; 

                    $sprod_quantity =  $result['sprod_quantity'] ;

                    $sprod_id =  $result['sprod_id'] ;

                }
               									
                
	$json=array('status'=> $coms , 'price' => $prod_price , 'qty' => $prod_quantity , 'sprod_price' => $sprod_price , 
                'sprod_qty' => $sprod_quantity , 'sprod_id' => $sprod_id ); 

	$resultArray = array();

	array_push($resultArray,$json);

	echo json_encode($resultArray);


?>

