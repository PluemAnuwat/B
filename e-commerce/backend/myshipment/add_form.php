<?php require '../include_backend/head.php' ;

@session_start();
require_once '../include/condb.php';


if( $_GET['id'] != 0){
    
    $sql2 ="SELECT *
    FROM akksofttech_purchase_order  AS po
    
    INNER JOIN akksofttech_payment AS pm ON po.po_id = pm.po_id
    
    WHERE po.po_id = '".$_GET['id']."' " ;
    $result2 = mysqli_query($connect,$sql2) or die ("error ".mysqli_error($connect));
    $row = mysqli_fetch_array($result2);
    
    
}


 


?>

<div id="show_po_id" style="display:none;"><?php echo $row['po_id'];?></div>

<body>



    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">TO CONFIRM</span></h4>

                    <div class="row">

                        <div class="col-md-12">
                            <!-- Basic Layout -->
                            <div class="row">
                                
                                <div class="box-1">


                                    <div class="col-xl">
                                    
                                        <div class="card mb-4">
                                            
                                            <div class="card-body">
                                            
                                                <div class="mb-3" align="right">
                                                
                                                <a type="button"   href="index.php" class="btn btn-primary">BACK</a>  
                                                </div>

                                                <h3 class="card-header">Purchase Order Id # <?php echo $row['po_id'];?> | <?php 
                                        if($row['po_status'] == 1){
                                            
                                          echo "<span class='badge bg-label-danger me-1'>UNPAID</span>";
                                              
                                          }elseif($row['po_status'] == 2){
                                            
                                            echo "<span class='badge bg-label-primary me-1'>TO CONFIRM</span>";
                                             
                                          }elseif($row['po_status'] == 3){
                                            
                                            echo "<span class='badge bg-label-warning me-1'>TO SHIP</span>";
                                            
                                          }
                                          elseif($row['po_status'] == 4){
                                            
                                            echo "<span class='badge bg-label-info me-1'>SHIPPING</span>";
                                            
                                          }elseif($row['po_status'] == 5){
                                            
                                            echo "<span class='badge bg-label-success me-1'>COMPLETED</span>";
                                            
                                          }
                                       ?> | <font class="form-subhead">Time Of Order : <?php echo $row['po_start_date'];?></font> </h3>
                                                
                                    <div class="card mb-4">
                                        
                                        <div class="card-body">
                                                                
                                            <h4 class="card-header"><i class='form-subhead2 bx bx-map'></i> Address<hr /></h4>
                                            
                                                <div class="mb-3" >
                    
                                                    <label class="form-subhead1">Name-Surname : </label>
                                                    <label class="form-input"> <?php echo $row['cus_name'];?> <?php echo $row['cus_surname'];?></label>
                                                    <br>
                                                    <label class="form-subhead1"> Address : </label>
                                                    <label class="form-input"> <?php echo $row['cus_address'];?> </label>
                                                    <br>
                                                    <label class="form-subhead1"> Province :</label>
                                                    <label class="form-input"> <?php echo $row['cus_province'];?> | </label>
                                                    
                                                    <label class="form-subhead1"> Zipcode :</label>
                                                    <label class="form-input"> <?php echo $row['cus_zipcode'];?></label>
                                                  
                                                </div>
                                        </div>
                                    </div>

                                    <div class="card mb-4">
                                            
                                            <div class="card-body">

                                                <h4 class="card-header">Product Details
                                                <hr /></h4>

                                        <?php
                                        $totoprice = 0 ; 
                                        $pod ="SELECT *
                                        FROM akksofttech_phrchaes_order_detail 

                                        WHERE sto_id = '".$_SESSION['akksofttechsess_stoid']."'  AND po_id = '".$row['po_id']."' " ;
                                        $respod = mysqli_query($connect,$pod) or die ("error ".mysqli_error($connect));

                                        while ($row2 = mysqli_fetch_array($respod)) {

                                        $totoprice += $row2['prod_price'] * $row2['quantity']; 
                                        $toto = $row2['prod_price'] * $row2['quantity']; 
                                        ?>
                                        
                                            
                    <div class="row mb-3" >

                        <label class="col-sm-2">
    
                    <?php if($row2['sprod_id'] == 0 ){ ?>

                            <img src="../getimg/prod/<?php echo $row2['prod_image'];?>" height="200px;" width="180px;">

                    <?php }else if($row2['sprod_id'] != 0  && $row2['sprodone_id'] == 0){ ?>

                            <img src="../getimg/sprod/<?php echo $row2['prod_image'];?>" height="200px;" width="180px;">

                    <?php }else if($row2['sprod_id'] != 0 && $row2['sprodone_id'] != 0 ){ ?>

                            <img src="../getimg/sprodone/<?php echo $row2['prod_image'];?>" height="200px;" width="180px;">

                    <?php } ?>

                        </label>

                    <div class="col-sm-10" >

                    <?php if($row2['sprod_id'] == 0 ){ ?>

                        <label class="form-input4"><?php echo $row2['prod_name'];?> <br>
                            <a class="form-subhead"> <?php echo number_format($row2['prod_price'],0,'.',',');?></a>
                        <br>
                            <a class="form-input"><font color="red"><?php echo number_format($toto);?>  </font></a>
                        <a class="form-input">| x <?php echo $row2['quantity'];?></a>
                        </label>
                        
                    <?php }else if($row2['sprod_id'] != 0  && $row2['sprodone_id'] == 0){ ?>

                        <label class="form-input4"><?php echo $row2['prod_name'];?>
                        <br>

                        <a class="form-subhead"><?php echo $row2['sprod_name'];?> 
                        <a class="form-subhead"> | <?php echo number_format($row2['prod_price'],0,'.',',');?></a>
                        <br>
                        <a class="form-input"><font color="red"><?php echo number_format($toto);?></font></a>
                        <a class="form-input">| x <?php echo $row2['quantity'];?></a>

                        </label>

                    <?php }else if($row2['sprod_id'] != 0 && $row2['sprodone_id'] != 0 ){ ?>

                        <label class="form-input4"><?php echo $row2['prod_name'];?><br>

                        <a class="form-subhead"><?php echo $row2['sprod_name'];?> | <?php echo $row2['sprodone_name'];?></a> 
                        <a class="form-subhead"> | <?php echo number_format($row2['prod_price'],0,'.',',');?></a>
                        <br>
                        <a class="form-input"><font color="red"><?php echo number_format($toto);?></font></a>
                        <a class="form-input">| x <?php echo $row2['quantity'];?></a>
                        </label>

                    <?php } ?>


                    </div> 
                </div>

                <hr class="my-5" />

                <?php } ?>
                                    <div class="md-3" align="right">
                                    <a class="form-input">TOTAL PRICE  : </a> 
                                    <a class="form-input4"> £ <?php echo number_format($totoprice); ?></a>
                                    </div>
                            </div>
                    </div>
                                            
                            <div class="card mb-4">
                                <div class="card-body">
                                                
                                        
                                            
                                         
                                                <h4 class="card-header">Payment Information<hr /></h4>
                                            
                                                <div class="mb-3" >
                    
                                                    <label class="form-subhead1">Bank Name : </label>
                                                    <label class="form-input"> <?php echo $row['bac_name'];?></label>
                                                    <br>
                                                    <label class="form-subhead1">Account  Name : </label>
                                                    <label class="form-input"> <?php echo $row['bac_account'];?> </label>
                                                    <br>
                                                    <label class="form-subhead1">Amount : </label>
                                                    <label class="form-input"> <?php echo number_format($row['amount'],0,'.',','); ?> </label>
                                                    <br>
                                                    <label class="form-subhead1">Payment Date :</label>
                                                    <label class="form-input"> <?php echo $row['tranfer_date'];?></label>
                                                  
                                                </div>
                                               
                                            
                                               
                                            </div>
                                    </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                                
                                        
                                            
                                         
                                                <h4 class="card-header">Upload Shipping Information<hr /></h4>
                                            
                     
                                
                              
                                <div class="card shadow-none bg-transparent border border-primary mb-3">
                              
                                    <div class="card-body">
                                
                                    <form method='post' id='emp-SaveForm1'>
                                               
                                               <div class="mb-3">
                                                   <label class="form-label" for="basic-default-fullname">ID</label>
                                                   <input type="text" readonly="readonly" class="form-control" name="po_id" id="po_id"
                                                        value='<?php echo $row['po_id'];?>'
                                                   />
                                                </div>

                                        <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">tracking number</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tracking" id="basic-default-name" />
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                               
                                            <label  class="col-sm-2 col-form-label" for="basic-default-name">Transport Type</label>
                                            <div class="col-sm-5">
                                                <input type='text' name='savettype_name' id='savettype_name' class='form-control' placeholder='Search... '  />
                                            </div>

                                        <div class="col-sm-5">
                                             
                                               <select name="ttype" id="tran_type_id"  class='form-control' required>
					                           <option value="<?php echo $row['tran_type_id']?>">Choss</option>
                                               <?php
                                               
                                               $query3 = "SELECT tran_type_id, tran_type_name FROM akksofttech_transport  
                                               ";
                                               $result3 = mysqli_query($connect,$query3) or die ("error ".mysqli_error($connect));
                                               while ($row3 = mysqli_fetch_array($result3)) {

                                               echo '<option value="'.$row3['tran_type_id'].'">'.$row3['tran_type_name'].'</option>'; 
                                                }
                                                
                                                ?>
                                                </select>
                                            </div>     
                                         </div>    

                                         <div class="mb-3 row">
                                            <label  class="col-md-2 col-form-label">Datetime</label>
                                            <div class="col-md-10">
                                        <input
                                            name ="del_update_date"
                                            class="form-control"
                                            type="datetime-local"
                                            
                                           
                                        />
                                        </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            
                                                <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary"
                                                name="btn-save" id="btn-save">UPLOAD</button>
                                                </div>
                                        
                                        </div>
                                        
                                    </form>

                                    </div>

                                </div>
                            
                                               
                                            
                                               
                                            </div>
                                    </div>
                                                   


                                              
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php require '../include_backend/script.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
    crossorigin="anonymous"></script>
    
   
     <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>

<script>
	
    $(document).ready(function(){

		$("#savettype_name").keyup(function(){
           
				var value = $(this).val().toLowerCase();
				$("#tran_type_id option").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});

		});

	});
</script>
 <script type="text/javascript" src="insettoship.js"></script>
</body>

</html>