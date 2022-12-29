<?php session_start() ; ?>

<?php require 'includedb/condb.php' ?>

<!doctype html>

<html class="no-js" lang="en">

<?php require 'include/head.php' ; ?>

<body>

    <?php require 'include/loader.php' ; ?>

    <?php require 'include/navigation.php' ; ?>

    <?php require 'include/header.php' ; ?>

    <!--====== Content Card Style 4 Part Start ======-->
    <section class="content-card-style-4 pt-70 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="single-content mt-15 text-center">
                        <div class="content-icon">
                            <i class="mdi mdi-truck-fast"></i>
                        </div>
                        <div class="content-content">
                            <h4 class="title"><a href="javascript:void(0)">Two-hour delivery</a></h4>
                            <p>Available in most metros on selected in-stock products</p>
                            <a href="javascript:void(0)" class="more">learn more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="single-content mt-15 text-center">
                        <div class="content-icon">
                            <i class="mdi mdi-message-text"></i>
                        </div>
                        <div class="content-content">
                            <h4 class="title"><a href="javascript:void(0)">Get help buying</a></h4>
                            <p>Have a question? Call a Specialist or chat online for help</p>
                            <a href="contact-page.html" class="more">Contact us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 col-sm-8">
                    <div class="single-content mt-15 text-center">
                        <div class="content-icon">
                            <i class="mdi mdi-ticket-percent"></i>
                        </div>
                        <div class="content-content">
                            <h4 class="title"><a href="javascript:void(0)">Find the card for you</a></h4>
                            <p>Get 3% Daily Cash with special financing offers from us</p>
                            <a href="javascript:void(0)" class="more">learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Content Card Style 4 Part Ends ======-->



    <!--====== Clients Logo Part Start ======-->

    <section class="clients-logo-section pt-70 pb-70">

        <div class="container">

            <div class="section22 row client-logo-active" id="boxcategory">

                <?php $sql ="select * from akksofttech_category" ; $que = mysqli_query($conn , $sql) ; while($res = mysqli_fetch_array($que)){ ; ?>

                <div class="col-md-1">

                    <div class="single-logo-wrapper categoryid" data-id="<?php echo $res['cat_id']; ?>">

                        <img src="..\backend\getimg\cate\<?php echo $res['cat_img'] ; ?>" alt="">

                    </div>

                    <p class="text-center"><?php echo $res['cat_name'] ; ?></p>

                </div>

                <?php } ?>

            </div>

       

        </div>

    </section>

    <!--====== Clients Logo Part Ends ======-->

    <!--====== Product Style 1 Part Start ======-->
    <section class="product-wrapper pt-100 pb-70">

        <div class="container" id="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="mb-50">

                        <h1 class="heading-1 font-weight-700">Featured Items</h1>

                    </div>

                </div>

            </div>

            <div class="row">

                <?php $sql = "select  * from akksofttech_product LIMIT 20;" ; $que = mysqli_query($conn , $sql) ;  $num = mysqli_num_rows($que);    while($res = mysqli_fetch_array($que)){ ; ?>

                <div class="col-lg-3 col-sm-3">

                    <div class="product-style-1 mt-30">

                        <div class="product-image">

                            <div class="product-active">

                                <div class="product-item active">

                                    <img src="..\backend\getimg\prod\<?php echo $res['prod_image'] ; ?>" alt="product"
                                        width="250px;" height="350px;">

                                </div>

                            </div>

                        </div>

                        <div class="product-content text-center">


                            <h4 id="productid" class="title productid"><a><?php echo $res['prod_name'] ; ?></a></h4>

                            <p><?php echo $res['prod_detail'] ; ?></p>

                            <a href="javascript:void(0)" class="main-btn secondary-1-btn">

                                <div id="productid" class="productid" data-id='<?php echo $res['prod_id'] ?>'>

                                    <img src="assets/images/icon-svg/cart-7.svg" alt="">

                                    $<?php echo $res['prod_price'] ; ?>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

                <?php } ?>


            </div>

        </div>

    </section>

    <!--====== Product Style 1 Part Ends ======-->

    <!--====== Product Style 7 Part Start ======-->

    <section class="product-wrapper pt-100 pb-100">
        
        <div class="container" id="container1">

            <div class="row">

                <div class="col-lg-12">

                    <div class="mb-50">

                        <h1 class="heading-1 font-weight-700">Recent Items</h1>

                    </div>

                </div>

            </div>

            <div class="row">

                <?php $sql1 = "SELECT  * FROM  akksofttech_product ORDER BY prod_start_date DESC LIMIT 20;" ; $que1 = mysqli_query($conn , $sql1) ;  $num1 = mysqli_num_rows($que1);    while($res1 = mysqli_fetch_array($que1)){ ; ?>

                <div class="col-lg-6">
                    <div class="product-style-7 mt-30">
                        <div class="product-image">
                            <div class="product-active">
                                <div class="product-item active">
                                    <img src="..\backend\getimg\prod\<?php echo $res1['prod_image'] ; ?>" alt="product"
                                        height="250PX;">
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4 id="productid" class="title productid"><a><?php echo $res1['prod_name'] ; ?></a>
                            </h4>
                            <p><?php echo $res1['prod_detail'] ; ?></p>
                            <span class="price">$<?php echo $res1['prod_price'] ; ?></span>
                            <a href="javascript:void(0)" class="main-btn primary-btn">
                            <div id="productid" class="productid" data-id='<?php echo $res1['prod_id'] ?>'>
                                <img src="assets/images/icon-svg/cart-4.svg" alt="">
                                Add to Cart
                            
                            </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>
    </section>
    <!--====== Product Style 7 Part Ends ======-->






    <?php require 'include/script.php' ; ?>

</body>

</html>