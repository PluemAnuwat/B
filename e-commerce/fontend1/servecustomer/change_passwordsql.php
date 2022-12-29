<?php

session_start();


    include_once '../includedb/condb.php';

    if (isset($_POST['change_password'])) {

        $username = ($_POST['cus_username']);

        $password = ($_POST['old_password']);

        $newpassword = ($_POST['new_password']);
        
        $confirmnewpassword = ($_POST['con_newpassword']);

       echo $sql = "SELECT * FROM `akksofttech_customer` WHERE `cus_username` = '".$username."' LIMIT 1";

        $query = mysqli_query($conn , $sql )  ;

        if($num = mysqli_num_rows($query)){

            $hash = mysqli_fetch_array($query);

            if ($password == $hash['cus_password']){

                if($newpassword == $confirmnewpassword) {

                    $sql = "UPDATE `akksofttech_customer` SET `cus_password` = '".$newpassword."' WHERE `cus_username` = '".$username."' ";
  
                    $query = mysqli_query($conn , $sql )  ;

                    if($query){

                        $coms =  "YES";

                    }else{

                        $coms =   "NO";

                    }

                } else {

                    $coms =   "NOM";

                }

            }else{

                $coms =   "NOPT";

            }

        }else{

            $coms =   "IN";

        }
        
    }

    $json=array('status'=> $com  ); 
    $resultArray = array();
    array_push($resultArray,$json);
    echo json_encode($resultArray);
    

?>