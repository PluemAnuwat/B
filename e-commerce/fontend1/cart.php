<?php @session_start() ; ?>

<?php require 'includedb/condb.php';  ?>

<?php require 'include/head.php' ?>

<body>

    <style>
    ::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 0px;
    }
    </style>


    <?php require 'include/loader.php' ?>

    <?php require 'include/navigation.php' ?>


    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart Page</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Cart Page</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="checkout-wrapper pt-50">

        <div class="container" id="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="checkout-style-1 ">

                        <div class="checkout-table table-responsive">

                            <div class="card">

                                <table class="table table-hover text-center ">

                                    <thead>

                                        <tr>

                                            <th class="product ">
                                                <p>Product</p>
                                            </th>
                                            <th class="price">
                                                <p>Price/ชิ้น
                                            </th>
                                            <th class="quantity">
                                                <p>Quantity
                                            </th>
                                            <th class="price">
                                                <p>Price
                                            </th>
                                            <th class="action">
                                                <p>Delete
                                            </th>
                                        </tr>

                                    </thead>

                                    <?php

                                        $s = "SELECT * FROM akksofttech_cart WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ;

                                        $q = mysqli_query($conn , $s) ; 

                                        $n = mysqli_num_rows($q) ; 

                                        while($r = mysqli_fetch_array($q)){

                                        ?>

                                    <div id="cartnumber" style="display:none;"><?php echo $n ; ?></div>

                                    <tbody>

                                        <tr>





                                            <td>

                                                <div class="product-cart d-flex m-2">



                                                    <div class="product-thumb">


                                                        <?php if($r['sprod_id'] == 0 ){ ?>

                                                        <img src="../backend/getimg/prod/<?php echo $r['prod_image'];?>"
                                                            width="50px;" alt="Product">

                                                        <?php }else if($r['sprod_id'] != 0  && $r['sprodone_id'] == 0){ ?>

                                                        <img src="../backend/getimg/sprod/<?php echo $r['prod_image'];?>"
                                                            width="50px;" alt="Product">

                                                        <?php }else if($r['sprod_id'] != 0 && $r['sprodone_id'] != 0 ){ ?>

                                                        <img src="../backend/getimg/sprodone/<?php echo $r['prod_image'];?>"
                                                            width="50px;" alt="Product">

                                                        <?php } ?>

                                                    </div>

                                                    <div class="product-content media-body m-2">

                                                        <h4 class="title"><a href="product-details-page.html"
                                                                class="text-dark">

                                                                <?php echo $r['prod_name'] ; ?>

                                                            </a></h4>
                                                      <span>aaa</span>
                                                    </div>

                                                </div>

                                            </td>

                                            <td>


                                                <div id="show_price1" class="price m-3">
                                                    <?php echo number_format($r['prod_price_simple'],2,'.',',') ; ?>
                                                </div>

                                            </td>

                                            <td>

                                                <div class="product-quantity d-inline-flex m-2 ">

                                                    <button type="button" id="show_molo_minus1"
                                                        data-id='<?php echo $r['cart_id'] ; ?>'
                                                        class="show_molo_minus1"><i class="mdi mdi-minus"></i></button>

                                                    <button id="show_quantity1<?php echo $r['cart_id'] ; ?>"
                                                        data-id='<?php echo $r['cart_id'] ; ?>'><?php echo $r['quantity'] ; ?></button>

                                                    <button type="button" id="show_molo_plus1"
                                                        data-id='<?php echo $r['cart_id'] ; ?>'
                                                        class="show_molo_plus1"><i class="mdi mdi-plus"></i></button>

                                                </div>




                                            </td>
                                            <td>
                                                <p class="price m-3">


                                                <div id="show_price_qty<?php echo $r['cart_id'] ; ?>">
                                                    <?php echo  number_format($r['prod_price_simple'] * $r['quantity'],2,'.',',') ; ?>
                                                </div>

                                                <!-- <div id="show_price_qty_t"+cart_id></div> -->

                                            </td>
                                            <td>
                                                <ul class="action m-3">
                                                    <!-- <li><a class="delete delete_cart" href="javascript:void(0)"><i
                                                                class="mdi mdi-delete"></i></a></li> -->

                                                    <li> <a type="button" class="delete delete_cart "
                                                            data-id='<?php echo $r['cart_id'] ; ?>'>
                                                            <font color="red">
                                                                <i class="mdi mdi-delete" style="font-size: 200%;"></i>
                                                            </font>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>


                                    </tbody>
                                    <?php } ?>
                                </table>






                            </div>

                        </div>

                        <br>

                        <div class="checkout-btn d-sm-flex justify-content-between">
                            <div class="single-btn">
                                <a href="index.php" class="main-btn primary-btn-border">continue shopping</a>
                            </div>
                            <div class="single-btn">
                                <a id="checkout" class="main-btn primary-btn">Pay now</a>
                                <!-- <a id="checkout" class="main-btn primary-btn">Pay now</a> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require 'include/script.php' ?>

</body>

</html>