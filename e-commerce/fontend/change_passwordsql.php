<?php

    include_once 'includedb/condb_pdo.php';

    if (isset($_POST['change_password'])) {

        $username = strip_tags($_POST['cus_username']);

        $password = strip_tags($_POST['old_password']);

        $newpassword = strip_tags($_POST['new_password']);
        
        $confirmnewpassword = strip_tags($_POST['con_newpassword']);

        $sql = "SELECT * FROM `akksofttech_customer` WHERE `cus_username` = ? LIMIT 1";

        $query = $dbh->prepare($sql);

        $query->bindParam(1, $username, PDO::PARAM_STR);

        echo($conn) ; 

        if($query->execute() && $query->rowCount()){

            $hash = $query->fetch();

            if ($password == $hash['password']){

                if($newpassword == $confirmnewpassword) {

                    $sql = "UPDATE `akksofttech_customer` SET `cus_password` = ? WHERE `username` = ?";

                    $query = $dbh->prepare($sql);

                    $query->bindParam(1, $newpassword, PDO::PARAM_STR);

                    $query->bindParam(2, $username, PDO::PARAM_STR);

                    if($query->execute()){

                        $coms =  "Password Changed Successfully!";

                    }else{

                        $coms =   "Password could not be updated";

                    }

                } else {

                    $coms =   "Passwords do not match!";

                }

            }else{

                $coms =   "Please type your current password accurately!";

            }

        }else{

            $coms =   "Incorrect username";

        }
        
    }

    $json=array('status'=> $coms ); 

	$resultArray = array();

	array_push($resultArray,$json);

	echo json_encode($resultArray);
    

?>