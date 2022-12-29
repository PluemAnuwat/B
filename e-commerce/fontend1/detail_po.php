<?php
        @session_start();
        
        require 'includedb/condb.php'; 

        if( $_GET['po_id'] != 0){
        
        $sql = "SELECT * FROM akksofttech_purchase_order 
        INNER JOIN akksofttech_po_status ON akksofttech_purchase_order.po_status = akksofttech_po_status.po_status_id
         WHERE  po_id = '".$_GET['po_id']."'  ";
        
        $query = mysqli_query($conn , $sql);
        
        $result = mysqli_fetch_array($query); 

        }

      ?>

<?php require 'include/head.php' ?>

<style>
::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 0px;
}
</style>






<form method='post' id="emp-savebank1" action="#">

<input type="text" name="po_id" id="po_id" style="display:none;" value="<?php echo $_GET['po_id'] ; ?>">

<input type="text" name="sto_id" id="sto_id" style="display:none;" value="<?php echo $result['sto_id'] ; ?>">


<section class="checkout-wrapper pt-10">
    <div class="container">
        <div class="row justify-content-center">



            <h1 class="mt-5 mb-2 btn btn-danger">STATUS PO : <?php echo $result['po_status_name'] ; ?></h1>

            <hr>



            <div class="col-lg-8">
                <div class="checkout-steps-form-style-1 mt-50">
                    <ul id="checkout-steps">
                        <li data-vjstepno="1">
                            <h6 class="title">Your Personal Details Address </h6>
                            <section class="checkout-steps-form-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>User Name</label>
                                            <div class="row">
                                                <div class="col-md-6 form-input form">
                                                    <input type="text" value="<?php echo $result['cus_name'] ; ?>">
                                                </div>
                                                <div class="col-md-6 form-input form">
                                                    <input type="text" value="<?php echo $result['cus_surname'] ; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Email Address</label>
                                            <div class="form-input form">
                                                <input type="text" value=" - ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Phone Number</label>
                                            <div class="form-input form">
                                                <input type="text" value="<?php echo $result['cus_phone'] ; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>Mailing Address</label>
                                            <div class="form-input form">
                                                <input type="text" value="<?php echo $result['cus_address'] ; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>City</label>
                                            <div class="form-input form">
                                                <input type="text" value="<?php echo $result['cus_province'] ; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Post Code</label>
                                            <div class="form-input form">
                                                <input  type="text" value="<?php echo $result['cus_zipcode'] ; ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </li>

                    </ul>







                    <?php


                          $sql2 ="SELECT *

                          FROM akksofttech_purchase_order  AS po

                          INNER JOIN akksofttech_payment AS pm ON po.po_id = pm.po_id

                          WHERE po.po_id = '".$_GET['po_id']."' " ;
                          $result2 = mysqli_query($conn,$sql2) or die ("error ".mysqli_error($conn));
                          $row = mysqli_fetch_array($result2);


                          ?>

                

                        <div class="checkout-payment-style-1 mt-50">
                            <h6 class="title">Payment Info</h6>
                            <div class="checkout-payment-form">

                                <div class="row">

                                    <div class="col">
                                        <div class="single-form form-default">
                                            <label>Account Name </label>
                                            <div class="form-input form">
                                                <input name="bac_name"  required
                                            oninvalid="this.setCustomValidity('Please fill in')"
                                            oninput="this.setCustomValidity('')" id="bac_name" type="text"
                                                    value="<?php echo $row['bac_name'] ; ?>">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col">
                                        <div class="single-form form-default">
                                            <label>Bank Name </label>
                                            <div class="form-input form">
                                                <input type="text"  required
                                            oninvalid="this.setCustomValidity('Please fill in')"
                                            oninput="this.setCustomValidity('')" name="bac_account" id="bac_account"
                                                    value="<?php echo $row['bac_account'] ; ?>">
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="single-form form-default">
                                    <label>Account Number </label>
                                    <div class="form-input form">
                                        <input name="bac_number"  required
                                            oninvalid="this.setCustomValidity('Please fill in')"
                                            oninput="this.setCustomValidity('')" id="bac_number" type="text"
                                            value="<?php echo $row['bac_number'] ; ?>">
                                        <img src="assets/images/card.png" alt="card">
                                    </div>
                                </div>
                                <div class="payment-card-info">
                                    <div class="single-form form-default">

                                        <div class="expiration d-flex">
                                            <div class="row">
                                                <div class="col">
                                                    <label>Amount </label>

                                                    <div class="form-input form">
                                                        <input type="text" name="amount"  required
                                            oninvalid="this.setCustomValidity('Please fill in')"
                                            oninput="this.setCustomValidity('')" id="amount"
                                                            value="<?php echo  number_format($row['amount'],0,'.',',') ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label>Date </label>
                                                    <div class="form-input form">
                                                        <input type="datetime-local"  required
                                            oninvalid="this.setCustomValidity('Please fill in')"
                                            oninput="this.setCustomValidity('')"  name="tranfer_date" id="tranfer_date" value="<?php echo  $row['po_start_date'] ?>">
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










            <div class="col-lg-4">
                <div class="checkout-sidebar-accordion mt-50">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <a href="javascript:void(0)" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">Selected Products</a>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="checkout-table table-responsive">
                                        <table class="table">
                                            <tbody>

                                                <?php
                                        $totoprice = 0 ; 
                                        $pod ="SELECT *
                                        FROM akksofttech_phrchaes_order_detail 

                                        WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."'  AND po_id = '".$_GET['po_id']."' " ;
                                        $respod = mysqli_query($conn,$pod) or die ("error ".mysqli_error($conn));

                                        while ($row2 = mysqli_fetch_array($respod)) {

                                        $totoprice += $row2['prod_price'] * $row2['quantity']; 
                                        $toto = $row2['prod_price'] * $row2['quantity']; 
                                        
                                        ?>


                                                <tr>
                                                    <td class="checkout-product">
                                                        <div class="product-cart d-flex">
                                                            <div class="product-thumb m-1">
                                                                <?php if($row2['sprod_id'] == 0 ){ ?>

                                                                <img src="../backend/getimg/prod/<?php echo $row2['prod_image'];?>"
                                                                    height="80px;" width="80px;">

                                                                <?php }else if($row2['sprod_id'] != 0  && $row2['sprodone_id'] == 0){ ?>

                                                                <img src="../backend/getimg/sprod/<?php echo $row2['prod_image'];?>"
                                                                    height="80px;" width="80px;">

                                                                <?php }else if($row2['sprod_id'] != 0 && $row2['sprodone_id'] != 0 ){ ?>

                                                                <img src="../backend/getimg/sprodone/<?php echo $row2['prod_image'];?>"
                                                                    height="80px;" width="80px;">

                                                                <?php } ?>
                                                            </div>
                                                            <div class="product-content media-body">

                                                                <?php if($row2['sprod_id'] == 0 ){ ?>


                                                                <h5 class="title"><a
                                                                        href="product-details-page.html"><?php echo $row2['prod_name'];?></a>
                                                                </h5>
                                                                <ul>
                                                                    <li><span> <?php echo $row2['quantity'];?> X
                                                                            <?php echo number_format($row2['prod_price'],0,'.',',');?>
                                                                        </span></li>
                                                                </ul>

                                                                <p class="price"> <?php echo number_format($toto);?></p>

                                                                <?php }else if($row2['sprod_id'] != 0  && $row2['sprodone_id'] == 0){ ?>


                                                                <h5 class="title"><a
                                                                        href="product-details-page.html"><?php echo $row2['prod_name'];?></a>
                                                                </h5>
                                                                <ul>
                                                                    <li><span><?php echo $row2['sprod_name'];?></span>
                                                                    </li>
                                                                    <li><span>XL</span></li>
                                                                    <li><span> <?php echo $row2['quantity'];?> X
                                                                            <?php echo number_format($row2['prod_price'],0,'.',',');?>
                                                                        </span></li>
                                                                </ul>

                                                                <p class="price"> <?php echo number_format($toto);?></p>

                                                                <?php }else if($row2['sprod_id'] != 0 && $row2['sprodone_id'] != 0 ){ ?>


                                                                <h5 class="title"><a
                                                                        href="product-details-page.html"><?php echo $row2['prod_name'];?></a>
                                                                </h5>
                                                                <ul>
                                                                    <li><span><?php echo $row2['sprod_name'];?></span>
                                                                    </li>
                                                                    <li><span>
                                                                            <?php echo $row2['sprodone_name'];?></span>
                                                                    </li>
                                                                    <li><span> <?php echo $row2['quantity'];?> X
                                                                            <?php echo number_format($row2['prod_price'],0,'.',',');?>
                                                                        </span></li>
                                                                </ul>

                                                                <p class="price"> <?php echo number_format($toto);?></p>


                                                                <?php } ?>


                                                            </div>
                                                        </div>
                                                    </td>



                                                </tr>



                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pricing-table text-right">
                                        <div class="sub-total-price">
                                            <div class="total-price">
                                                <p class="value">Subtotal Price:</p>
                                                <p class="price  btn btn-danger">
                                                    <?php echo number_format($totoprice); ?></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <a href="javascript:void(0)" class="collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">Slip
                                        Images</a>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="checkout-sidebar-details">
                                            <div class="single-details">

                                                <?php if($result['po_status'] == 1  ){ ?>

                                                <div class="card borderbg">

                                                    <div class="show_view_img"></div>

                                                    <input type="file" name="filesto_picture" id="imagebroswer"
                                                        class='form-control  btn-upload' autocomplete="off" 
                                                        oninvalid="this.setCustomValidity('Please fill in')"
                                                        oninput="this.setCustomValidity('')" />

                                                    <textarea name="logo_img64" id="logo_img64" class="form-control"
                                                        style="display:none;"></textarea>


                                                </div>



                                                <?php }else{ ?>

                                                <img src="../backend/getimg/slip/<?php echo $row['tranfer_image']; ?>">


                                                <?php }
                                            
                                            ?>



                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <a href="javascript:void(0)" class="collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">Store Address</a>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="checkout-sidebar-details">

                                        <?php $sql = "SELECT * FROM akksofttech_bank_account INNER JOIN akksofttech_bank ON akksofttech_bank.bak_id = akksofttech_bank_account.bak_id
                                                        WHERE akksofttech_bank_account.sto_id = '".$result['sto_id']."' " ;
                                                    $query = mysqli_query($conn , $sql) ; 
                                                    while($result = mysqli_fetch_array($query)){ ?>

                                            <div class="single-details">
                                            <img src="..\backend\getimg\logobank\<?php echo $result['bak_image'] ; ?>"
                                                            class="mt-1" width="150px;">
                                            </div>
                                            <div class="details-btn">
                                            <?php echo $result['bac_name'] ; ?>
                                                        <br>
                                                        <?php echo $result['bac_mem_name'] ; ?>
                                                        <br>
                                                        <?php echo $result['bac_number_mem'] ; ?>
                                            </div>

                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="single-form form-default">


                        <?php if( $result['po_status_name'] == 1 ){ ?>

                            <button class="main-btn primary-btn" name="ok_bank" id="ok_bank">pay now</button>

                            <button class="main-btn danger-btn" name="ok_bank" id="ok_bank">Cancel Po</button>

                            <?php }else if( $result['po_status_name'] == 2 ){ ?>

                            <button class="main-btn primary-btn" >PDF</button>

                            <?php } ?>

                        </div>



                    </div>
                </div>
            </div>
        </div>
</section>


                                                </form>





                                                <?php require 'include/script.php' ?>

<script type="text/javascript">
$(document).ready(function() {

});
</script>

<?php require_once 'funcimage.php' ; ?>

<script type="text/javascript" src="serve/js_serve/webapp.serve.bankaccount.js"></script>


</body>

</html>