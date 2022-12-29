

<?php 
require_once '../include/condb.php';
session_start();
// print_r($_POST);
// exit();


            $sprod_id =$_POST["sprod_id"];
            $prod_id =$_REQUEST["prod_id"];
	
            $sql2= "SELECT * FROM  akksofttech_subproduct WHERE prod_id = '".$prod_id."' "; 

            $result2 = mysqli_query($connect, $sql2); 

            $num2 = mysqli_num_rows($result2) ; 

              if($num2 == 0){

                     echo"<option value='0'>Choss</option>"; 

              }else{

                     ?>
                     
                            <option value='0'>Choss</option>
                            
                     <?php
                   
                            	
                     
                     while($row2 = mysqli_fetch_array($result2)) { 


                
                          
                     echo "<option value='$row2[0]'>" .$row2["sprod_name"]." </option>"; 
                      
                         
                         
                      
                      
                      
                     
                     }
              }

          


	

?>