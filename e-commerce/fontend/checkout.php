<?php @session_start() ; ?>

<?php require 'includedb/condb.php';  ?>

<?php require 'include/head.php' ?>

<body>


    <?php require 'include/load.php' ?>

    <?php require 'include/nav.php' ?>

    <?php  $sss = "SELECT * FROM akksofttech_cart INNER JOIN akksofttech_member_store 
                ON akksofttech_cart.sto_id = akksofttech_member_store.sto_id 
                WHERE akksofttech_cart.cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ;
                $qqq = mysqli_query($conn , $sss) ; 
                $rrr = mysqli_fetch_array($qqq);  ?>

    <div id="show_address_id" style="display:none;">0</div>

   

    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Checkout</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <section class="checkout-wrapper pt-50">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="checkout-steps-form-style-1 mt-50">
                        <ul id="checkout-steps">
                            <li data-vjstepno="1">
                                <h6 class="title">Your Personal Details </h6>
                                <br>
                                <section class="checkout-steps-form-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">


                                                <div id="show_address_select" class="m-3"></div>



                                                <a class="main-btn primary-btn" id="clickshowselectmodaladdress">SELECT ADDRESS</a>

                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </li>
                        </ul>


                        <hr>


                        <div class="single-content mt-15 text-center">
                            <div class="content-content">
                                <h4 class="title"><a href="javascript:void(0)" class="mb-2">Payment Method</a></h4>


                                <div class="container">
                                    <div class="mt-2">
                                <?php  $sql = "SELECT * FROM akksofttech_bank_account INNER JOIN  akksofttech_member_store ON akksofttech_member_store.sto_id =  akksofttech_bank_account.sto_id WHERE akksofttech_bank_account.sto_id = '".$rrr['sto_id']."' " ;
                                      $query = mysqli_query($conn , $sql) ; 
                                     while($result = mysqli_fetch_array($query)){ ?>

                                        
                                        <a class="btn btn-outline-primary m-2">
                                        <?php echo $result['bac_number_mem'] ; ?> (<?php echo $result['bak_name'] ; ?>)
                                           <br>
                                        NAME ACCOUNT : <?php echo $result['bac_mem_name'] ; ?>
                                        <br>
                                        STORE NAME : <?php echo $result['sto_name'] ; ?>
                                            </a>



                                    <?php  } ;   ?>

                                    </div>

                                </div>

                            </div>
                        </div>


                    </div>
                </div>










                <div class="col-lg-7">
                    <div class="checkout-sidebar pt-20">
                        <div class="checkout-sidebar-coupon mt-30">
                            <p>The product has been ordered.</p>
                        </div>


                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Product</th>
                                    <th scope="col">Price/N</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $s = "SELECT * FROM akksofttech_cart INNER JOIN akksofttech_member_store 
                                        ON akksofttech_cart.sto_id = akksofttech_member_store.sto_id 
                                        WHERE akksofttech_cart.cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ;
                                        $q = mysqli_query($conn , $s) ; 
                                        $qty_all = "" ; 
                                        $price_all = "" ; 
                                        while($r = mysqli_fetch_array($q)){
                                            $qty_all +=  $r['quantity'] ; 
                                            $price_all +=  $r['prod_price_simple'] * $r['quantity'] ; 
                                        ?>
                                <tr>
                                    <td>

                                        <div id="show_sto_id"><?php echo $r['sto_id'] ; ?></div>

                                        <!-- <p class="m-1"> <?php echo $r['sto_name'] ; ?> </p> -->

                                        <?php if($r['sprod_id'] == 0 ){ ?>

                                        <img src="../backend/getimg/prod/<?php echo $r['prod_image'];?>" width="50px;"
                                            alt="Product">

                                        <?php }else if($r['sprod_id'] != 0  && $r['sprodone_id'] == 0){ ?>

                                        <img src="../backend/getimg/sprod/<?php echo $r['prod_image'];?>" width="50px;"
                                            alt="Product">

                                        <?php }else if($r['sprod_id'] != 0 && $r['sprodone_id'] != 0 ){ ?>

                                        <img src="../backend/getimg/sprodone/<?php echo $r['prod_image'];?>"
                                            width="50px;" alt="Product">

                                        <?php } ?>

                                        <?php echo $r['prod_name'] ; ?>

                                    </td>
                                    <td class="text-right">
                                        <?php echo number_format($r['prod_price_simple'],2,'.',',') ; ?></td>
                                    <td class="text-center"><?php echo ($r['quantity']) ; ?></td>
                                    <td class="text-right">
                                        <?php echo number_format($r['prod_price_simple'] * $r['quantity'],2,'.',',')   ; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tr>
                                <th colspan="2" class="text-center">Total All</th>

                                <th class="text-center"><?php echo $qty_all ; ?></th>
                                <th class="text-right"><?php echo number_format($price_all,2,'.',',') ; ?></th>
                            </tr>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </section>













    <!-- Modal -->
    <div class="modal mt-5 fade clickshowselectmodaladdress" id="select_modal_address" aria-hidden="true"
        style="width:100%;">
        <div class="modal-dialog" style="width:95%;">
            <div class="modal-content" style="width:95%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> SELECT ADDRESS </h5>
                </div>
                <form method="post">
                    <div class="modal-body">

                        <?php 

                           $sql = "SELECT * FROM akksofttech_customer_address WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ; 

                           $query = mysqli_query($conn , $sql )  ;
                            
                           while($result = mysqli_fetch_array($query)){ ?>

                        <div class="radio" id="">

                            <p><input type="radio" name="radio_address" id='<?php echo $result['cusa_id'] ; ?>'
                                    class="m-2"><?php echo $result['cusa_name'] ; ?> |
                                <?php echo $result['cusa_phone'] ; ?></p>

                            <p><?php echo $result['cusa_address'] ; ?> , <?php echo $result['cusa_province'] ; ?> ,
                                <?php echo $result['cusa_zipcode'] ; ?> </p>

                        </div>



                        <hr>

                        <?php  } ?>



                    </div>

                    <div class="modal-footer">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    style="width:100%;height:40px;font-size:20px;">EXIT</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary"
                                    style="width:100%;height:40px;font-size:20px;"
                                    id="select_address_submit">SELECT</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <hr>

    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container text-center">

            <button type="button" class="btn btn-default text-white" style="width:100%;height:40px;font-size:20px;"
                id="insert_to_purchase">order a purchase</button>


        </div>
    </section>



    <?php require 'include/script.php' ?>

</body>

</html>