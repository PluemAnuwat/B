<?php
        @session_start();
        
        require 'includedb/condb.php'; 
        
        $sql = "SELECT * FROM akksofttech_customer WHERE  cus_id = '".$_SESSION['akksofttechsess_cusid']."'  ";
        
        $query = mysqli_query($conn , $sql);
        
        $result = mysqli_fetch_array($query); 

        $poid = " SELECT COUNT(akksofttech_purchase_order.po_id) as poid_count FROM akksofttech_purchase_order
        WHERE akksofttech_purchase_order.cus_id = '".$_SESSION['akksofttechsess_cusid']."' " ;
        $query = mysqli_query($conn,$poid);
        $respoid = mysqli_fetch_array($query); ?>

<?php require 'include/head.php' ?>

<style>
::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 0px;
}
</style>


<div class="contact-style-1 mt-50">
    <div class="container-xxl flex-grow-1 container-p-y" id="container">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">MY ORDERS</span></h4>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item text-center">
                        <a class="nav-link active">ALL</a>
                    </li>





                    <?php 
            $sql = "SELECT * FROM akksofttech_po_status " ; 
            $query = mysqli_query($conn , $sql ) ; 
            while($result = mysqli_fetch_array($query)){ ; 
            ?>
                    <li class="nav-item">
                        <a class="nav-link "
                            href="myorder_<?php echo $result['po_status_name'] ; ?>.php "><?php echo $result['po_status_name'] ; ?></a>
                    </li>

                    <?php } ?>
                </ul>










                <div class="row">
                    <div class="col">
                        <h5 class="card-header"><?php echo $respoid['poid_count']; ?> Orders</h5>
                        <hr class="my-1" />
                        <div class="table-responsive ">






                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="display:none;">Order ID</th>
                                        <th style="text-align:center;">Product(s)</th>

                                        <th style="text-align:center;">Total Price</th>

                                        <th style="text-align:center;">Satatus</th>
                                        <th style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php $sss = "SELECT * FROM akksofttech_purchase_order  WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ; 

                            $qqq = mysqli_query($conn , $sss) ; 


                            while($row = mysqli_fetch_array($qqq)){  ;

                            ?>


                                    <tr>




                                        <td style="display:none;"><?php echo $row['po_id'] ; ?></td>


                                        <td>

                                            <?php
                                            
                                            $totoprice = 0 ; 

                                            $sss1 = "SELECT * FROM akksofttech_phrchaes_order_detail
                                        
                                            WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."' AND po_id = '".$row['po_id']."'" ; 

                                            $qqq1 = mysqli_query($conn , $sss1) ; ?>

                                            <?php while($row1 = mysqli_fetch_array($qqq1)){  
                                                
                                                $totoprice += $row1['prod_price'] * $row1['quantity']; 
                                                
                                                $toto = $row1['prod_price'] * $row1['quantity']; 
                                                
                                                ; ?>
                                            <div class="row">


                                                <label class="col">

                                                    <?php if($row1['sprod_id'] == 0 ){ ?>

                                                    <img src="../backend/getimg/prod/<?php echo $row1['prod_image'];?>"
                                                        height="80px;" width="80px;"><br>

                                                    <?php }else if($row1['sprod_id'] != 0  && $row1['sprodone_id'] == 0){ ?>

                                                    <img src="../backend/getimg/sprod/<?php echo $row1['prod_image'];?>"
                                                        height="80px;" width="80px;"><br>

                                                    <?php }else if($row1['sprod_id'] != 0 && $row1['sprodone_id'] != 0 ){ ?>

                                                    <img src="../backend/getimg/sprodone/<?php echo $row1['prod_image'];?>"
                                                        height="80px;" width="80px;"><br>

                                                    <?php } ?>

                                                </label>

                                                <div class="col" align="left">

                                                    <?php if($row1['sprod_id'] == 0 ){ ?>

                                                    <label class="form-input4"><?php echo $row1['prod_name'];?><br>
                                                        <a
                                                            class="form-subhead"><?php echo number_format($row1['prod_price'],0,'.',',');?></a>
                                                        <br>
                                                        <a class="form-input">
                                                            <font color="red">
                                                                <?php echo number_format($toto);?>
                                                            </font>
                                                        </a>
                                                        <a class="form-input">| x
                                                            <?php echo $row1['quantity'];?></a>
                                                    </label>
                                                    <?php }else if($row1['sprod_id'] != 0  && $row1['sprodone_id'] == 0){ ?>

                                                    <label class="form-input4"><?php echo $row1['prod_name'];?><br>

                                                        <a class="form-subhead"><?php echo $row1['sprod_name'];?>

                                                            |


                                                            <a class="form-subhead"><?php echo number_format($row1['prod_price'],0,'.',',');?>
                                                            </a>
                                                            <br>


                                                            <a class="form-input">
                                                                <font color="red">
                                                                    <?php echo number_format($toto);?>
                                                                </font>
                                                            </a>
                                                            <a class="form-input">| x
                                                                <?php echo $row1['quantity'];?>
                                                            </a>

                                                    </label>
                                                    <?php }else if($row1['sprod_id'] != 0 && $row1['sprodone_id'] != 0 ){ ?>

                                                    <label class="form-input4"><?php echo $row1['prod_name'];?><br>

                                                        <a class="form-subhead"><?php echo $row1['sprod_name'];?>

                                                            |
                                                            <?php echo $row1['sprodone_name'];?>
                                                            | </a>


                                                        <a
                                                            class="form-subhead"><?php echo number_format($row1['prod_price'],0,'.',',');?></a>
                                                        <br>
                                                        <a class="form-input">
                                                            <font color="red">
                                                                <?php echo number_format($toto);?>
                                                            </font>
                                                        </a>
                                                        <a class="form-input">| x
                                                            <?php echo $row1['quantity'];?></a>
                                                    </label>

                                                    <?php } ?>
                                                </div>


                                                <?php } ?>



                                        </td>


                                        <td style="text-align:center;">
                                            <?php echo number_format($totoprice); ?></td>

                                        <td style="text-align:center;">
                                            <?php 
                                        if($row['po_status'] == 1){
                                            
                                          echo "<span class='btn btn-info'>UNPAID</span>";
                                              
                                          }elseif($row['po_status'] == 2){
                                            
                                            echo "<span class='btn btn-info'>TO CONFIRM</span>";
                                             
                                          }elseif($row['po_status'] == 3){
                                            
                                            echo "<span class='btn btn-info'>TO SHIP</span>";
                                            
                                          }
                                          elseif($row['po_status'] == 4){
                                            
                                            echo "<span class='btn btn-info'>SHIPPING</span>";
                                            
                                          }elseif($row['po_status'] == 5){
                                            
                                            echo "<span class='btn btn-info'>COMPLETED</span>";
                                            
                                          }
                                       ?>
                                        </td>

                                        <td style="text-align:center;">

                                            <a type="button" href="detail_po.php?po_id=<?php echo $row['po_id']; ?>"
                                                class="btn btn-outline-primary">View</a>

                                        </td>


                                    </tr>



                                    <?php } ?>

                                </tbody>
                            </table>



































                        </div>




                    </div>




                </div>


            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#myTable').DataTable({
        pageLength: 2

    });
});
</script>


<?php require 'include/script.php' ; ?>

</body>

</html>