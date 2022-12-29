

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();


            $scate_id =$_POST["scate_id"];
            $cat_id =$_REQUEST["cat_id"];
	
            $sql2= "SELECT * FROM  akksofttech_subcategory WHERE cat_id = '".$cat_id."' "; 

            $result2 = mysqli_query($connect, $sql2); 

            $num2 = mysqli_num_rows($result2) ; 

              if($num2 == 0){

                     echo"<option value='0'>Choss</option>"; 

              }else{
                     ?>
                     <option value='0'>Choss</option>
                     
                     <?php

                     while($row2 = mysqli_fetch_array($result2)) { 


                
                            echo"<option value='$row2[0]'>" .$row2["scate_name"]." </option>"; 
                      
                         
                         
                      
                      
                      
                     
                     }
              }

          


	

?>