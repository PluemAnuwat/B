<?php session_start(); ?>
<?php 


	require_once '../includedb/condb.php'; 

	
										$show_address_id = $_POST['show_address_id'];

									
										 $sqlro = "select  *   FROM  akksofttech_customer_address  where   cusa_id = '".$show_address_id."' ";

										$result = mysqli_query($conn , $sqlro);

										$resultArray = array();
							
										while($rowttto = mysqli_fetch_array($result,MYSQLI_BOTH))	{	

												array_push($resultArray, array(
																				'cus_id'=>$rowttto['cus_id'],

																				'cusa_name'=>$rowttto['cusa_name'],
                                                                                
																				'cusa_surname'=>$rowttto['cusa_surname'],

																				'cusa_address'=>$rowttto['cusa_address'],

																				'cusa_province'=>$rowttto['cusa_province'],
                                                                                
																				'cusa_zipcode'=>$rowttto['cusa_zipcode'],
                                                                                
																				'cusa_note'=>$rowttto['cusa_note'], 

                                                                                'cusa_phone'=>$rowttto['cusa_phone'] 
																					
																				));


										}
				
	echo json_encode($resultArray,JSON_UNESCAPED_UNICODE);
?>
