
<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();

        $bac_id = $_POST['bac_id'] ; 
        

			 $sql = "SELECT *  FROM akksofttech_bank_account WHERE bac_id = '".$bac_id."'";
            
          
            $result = mysqli_query($connect,$sql);
            $reslutArray = array();
            while($data = mysqli_fetch_array($result,MYSQLI_BOTH))	{
                    $arrayprice = array( 
                                        "bac_id" => $data['bac_id'],
                                        "bac_number_mem" => $data['bac_number_mem'],    
                                        "bac_mem_name" => $data['bac_mem_name'],
                                        "bac_name" => $data['bac_name'],
                                        "bac_id" => $data['bac_id'],
                                        "bak_name" => $data['bak_name']
                                    );
                    array_push($reslutArray , $arrayprice);

            }										
            echo json_encode($reslutArray);


?>