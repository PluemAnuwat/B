<?php session_start(); ?>

<?php 
		require_once '../includedb/condb.php';  


        $sprod_id = $_POST['sprod_id']; 

			echo $sql = "SELECT *   FROM akksofttech_subproduct INNER JOIN akksofttech_subproduct_one
            
            ON akksofttech_subproduct.sprod_id = akksofttech_subproduct_one.sprod_id

              WHERE akksofttech_subproduct.prod_id = '".$sprod_id."' ";

            $query = mysqli_query($conn , $sql) ;

            $result = mysqli_fetch_array($query) ;
            
            $numm = mysqli_num_rows($query) ;

                if($numm ==  0 ){

                    $coms = "NO1";

                    $sql_no = "SELECT sprod_id , sprod_name , sprod_price , sprod_quantity FROM akksofttech_subproduct WHERE sprod_id = '".$sprod_id."' ";

                    $query_no = mysqli_query($conn , $sql_no) ;

                    $result_no = mysqli_fetch_array($query_no) ;

                    $sprod_price = $result_no['sprod_price'] ;

                    $sprod_quantity =  $result_no['sprod_quantity'] ;

                    $sprod_id =  $result_no['sprod_id'] ;

                    $sprod_name =  $result_no['sprod_name'] ;

                }else{

                    $coms = "YES1";

                    $prod_price = $result['prod_price'] ;

                    $sprodone_quantity =  $result['sprodone_quantity'] ;

                    $ssprod_price = $result['ssprod_price'] ; 

                    $sprodone_quantity =  $result['sprodone_quantity'] ;

                    $sprodone_id =  $result['sprodone_id'] ;

                }
               									
                
	$json=array('status'=> $coms , 'price' => $sprod_price , 'qty' => $prod_quantity , 'sprodone_price' => $sprodone_price , 
                'sprod_qty' => $sprod_quantity , 'sprod_id' => $sprod_id ); 

	$resultArray = array();

	array_push($resultArray,$json);

	echo json_encode($resultArray);


?>

