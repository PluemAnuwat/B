<?php session_start() ; ?>

<!doctype html>

<html class="no-js" lang="en">

<?php require 'includedb/condb.php' ?>

<?php require 'include/head.php' ?>

<?php     $results_per_page = 10;   ?>

<body>

    <?php require 'include/load.php' ?>

    <?php require 'include/nav.php' ?>

    <?php require 'include/header.php' ?>

    <style>
    .section22 {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        box-shadow: 0 3px 10px 0 rgba(#000, 0.1);
        -webkit-overflow-scrolling: touch;
        scroll-padding: 1rem;
        border-radius: 5px;
        font-size: 25px;
        margin-top: 20px;
    }

    ::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 0px;
    }

    .fincenter {
        text-align: center;
    }
    </style>

    <!--====== Product Style 1 Part Start ======-->

    <form method="POST">

        <div class="container mt-5">

            <div class="row">

                <div class="col-lg-12">

                    <div class="mb-10">

                        <p class="font-weight-700">CATEGORY</p>

                    </div>

                </div>

            </div>

            <hr>

            <div class="section22 boxcategoryname">

                <?php $sql ="select * from akksofttech_category" ; $que = mysqli_query($conn , $sql) ; while($res = mysqli_fetch_array($que)){ ; ?>

                <div class="ml-5 categoryname" data-id="<?PHP echo $res['cat_id']; ?>">

                    <img src="..\backend\getimg\cate\<?php echo $res['cat_img'] ; ?>" width="60px;" height="50px;">

                    <div class="fincenter">

                        <p><?php echo $res['cat_name'] ; ?></p>

                    </div>

                </div>

                <?php } ?>

            </div>

        </div>

    </form>
    <!--====== Product Style 1 Part Ends ======-->

    <!--====== Product Style 1 Part Start ======-->

    <section class="product-wrapper pt-100 pb-70">

        <div class="container" id="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="mb-10">

                        <p class="font-weight-700">PRODUCT</p>

                    </div>

                </div>

            </div>

            <hr>

            <div class="row m-2">

                <?php $sql = "select  * from akksofttech_product LIMIT 20;" ; $que = mysqli_query($conn , $sql) ;  $num = mysqli_num_rows($que);    while($res = mysqli_fetch_array($que)){ ; ?>

                <div class="col-sm-2 mb-2">

                    <div class="card">

                        <div id="showproductall" class="showproductall" data-id='<?php echo $res['prod_id'] ?>'>

                            <img src="..\backend\getimg\prod\<?php echo $res['prod_image'] ; ?>" width="250px;"
                                height="200px;">

                            <div class="card-body">

                                <h5 class="card-title" style="font-size:15px;">
                                    <?php echo substr($res['prod_name'],0,15);?></h5>

                                <p class="card-text"><?php echo substr($res['prod_detail'],0,15);?></p>

                                <p style="font-size:10px;" class="text-danger"><?php echo $res['prod_price'] ; ?>
                                    บาท
                                </p>

                            </div>

                        </div>

                    </div>

                </div>




                <?php } ?>

            </div>



        </div>

        </div>

    </section>

    <!--====== Product Style 1 Part Ends ======-->

    <script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
    </script>

    <?php require 'include/script.php' ?>

</body>

</html>