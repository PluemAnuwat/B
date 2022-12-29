<?php session_start() ; ?>

<?php require 'includedb/condb.php' ?>

<!doctype html>

<html class="no-js" lang="en">

<?php require 'include/head.php' ; ?>

<?php   

$s = "SELECT * FROM akksofttech_product  where akksofttech_product.prod_id  = '".$_GET['prod_id']."'";

$q = mysqli_query($conn,$s);

$r = mysqli_fetch_array($q,MYSQLI_BOTH);

?>

<body>

    <?php require 'include/loader.php' ; ?>

    <?php require 'include/navigation.php' ; ?>

    <div id="show_cus_id" style="display:none;"><?php  echo $_SESSION['akksofttechsess_cusid'] ;  ?></div>

    <!-- รหัสร้านค้า -->
    <div id="show_sto_id" style="display:none;"><?php echo $r['sto_id'] ?></div>

    <!-- รหัสสินค้า -->
    <div id="show_prod_id" style="display:none;"><?php echo $r['prod_id'] ?></div>

    <!-- รหัสสินค้่าย้อย -->
    <div id="show_sub_prod_id" style="display:none;">0</div>

    <!-- รหัสสินค้่าย้อย 1-->
    <div id="show_sub_prodone_id" style="display:none;">0</div>

    <!-- ดึงค่าราคาปัจจุบันมา -->
    <div id="show_price_simple" style="display:none;">0</div>


    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Product Details</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--====== Product Details Style 1 Part Start ======-->
    <section class="product-details-wrapper pt-50 pb-100">
        <div class="container">
            <div class="product-details-style-1">
                <div class="row flex-lg-row-reverse align-items-center">
                    <div class="col-lg-6">
                        <div class="product-details-image mt-50">
                            <div class="product-image">
                                <div class="product-image-active-1">
                                    <div class="single-image">
                                        <img src="../backend/getimg/prod/<?php echo $r['prod_image'] ; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="product-thumb-image">
                                <div class="product-thumb-image-active-1">
                                    <div class="single-thumb">
                                        <img src="../backend/getimg/prod/<?php echo $r['prod_image'] ; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content mt-45">
                            <!-- <p class="sub-title">All-In-One VR</p> -->
                            <h2 class="title"><?php echo $r['prod_name'] ; ?></h2>

                            <div class="product-items flex-wrap">

                                <!-- แสดงเมื่อมีสินค้าย่อยนะครับ -->

                                <div id="boxshowsubproductionselect">

                                    <div id="boxshowsubproductionid">


                                        <h6 class="item-title">Select Your <?php echo $r['prod_name'] ; ?>: </h6>
                                        <div class="items-wrapper">

                                            <?php $sqlsubprod = "SELECT * FROM akksofttech_subproduct WHERE prod_id = '".$r['prod_id']."'" ;
                                        
                                                $querysubprod = mysqli_query($conn , $sqlsubprod) ; 
                                        
                                             while($resultsubprod = mysqli_fetch_array($querysubprod)){   ?>

                                            <div class="single-item " id="show_sprod_id"
                                                sprod_id="<?php echo $resultsubprod['sprod_id'] ; ?>">

                                                <p><?php echo $resultsubprod['sprod_id'] ; ?></p>

                                                <div class="items-image ">

                                                    <img src="../backend/getimg/sprod/<?php echo $resultsubprod['sprod_image'] ; ?>"
                                                        width="200px;" height="150px;" alt="product">

                                                </div>

                                                <p class="text"><?php echo $resultsubprod['sprod_name'] ; ?></p>

                                            </div>


                                            <?php } ?>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div id="boxshowsubproductionselectone">

                                <div class="product-select-wrapper flex-wrap">

                                    <div class="select-item">

                                        <h6 class="select-title">Select : </h6>

                                        <ul class="color-select">

                                            <div id="showsubproductionselectone"></div>

                                        </ul>

                                    </div>

                                </div>

                            </div>


                            <div id="boxshowquantity">

                                <div class="product-select-wrapper flex-wrap">

                                    <div class="select-item show_insert_product">

                                        <h6 class="select-title">Select Quantity: </h6>

                                        <div class="select-quantity">

                                            <button type="button" id="show_molo_minus" class="show_molo_minus"><i
                                                    class="mdi mdi-minus"></i></button>

                                            <button id="show_quantity">1</button>

                                            <button type="button" id="show_molo_plus" class="show_molo_plus"><i
                                                    class="mdi mdi-plus"></i></button>

                                            <div id="showsubproductionselectquantity"></div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <br>

                        <div id="showpriceall" style="display:none;">0</div>

                        <div id="boxshowsubproductionprice">

                            <div class="product-price">

                                <h6 class="price-title">Price: </h6>

                                <div id="showsubproductionselectprice"></div>

                            </div>

                        </div>

                        <div class="product-price ">

                            <?php 

                                $sql = "SELECT * FROM akksofttech_member_store 

                                INNER JOIN akksofttech_product ON akksofttech_member_store.sto_id = akksofttech_product.sto_id WHERE akksofttech_product.prod_id  = '".$_GET['prod_id']."'" ; 

                                $que = mysqli_query($conn , $sql); 

                                $res_sto = mysqli_fetch_array($que); ?>

                            <h6 class="price-title"> Sale By : <?php echo $res_sto['sto_name'] ;?></h6>

                        </div>

                        <div class="row">

                         

                                <div class="col-md-6">

                                    <button href="javascript:void(0)" style="width:100%"
                                        class="main-btn primary-btn addtocart" id="ok_inset_cart">

                                        <img src="assets/images/icon-svg/cart-4.svg" alt="">

                                        Add to cart

                                    </button>

                                </div>

               

                                <div class="col-md-6">

                                    <a href="javascript:history.back(1)" style="width:100%" class="btn btn-danger">

                                        <img src="assets/images/icon-svg/cart-8.svg" alt="">

                                        Black To Shopping

                                    </a>

                                </div>

                            

                        </div>

                    </div>

                </div>

            </div>

        </div>

        </div>

    </section>



    <?php require 'include/script.php' ; ?>

</body>

</html>