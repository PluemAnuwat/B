<?php session_start() ; ?>

<!doctype html>

<html class="no-js" lang="en">

<?php require 'includedb/condb.php' ?>

<?php require 'include/head.php' ?>

<body>

    <?php require 'include/load.php' ?>

    <?php require 'include/nav.php' ?>

    <?php require 'include/header.php' ?>

    <?php $s = " SELECT * FROM akksofttech_subcategory WHERE cat_id = '".$_GET['cat_id']."' " ; $q = mysqli_query($conn , $s) ; $r = mysqli_Fetch_array($q) ; ?>

    <div id="showproductall" style="display:none;"><?php echo $_GET['cat_id'] ; ?> </div>


    <!--====== Product Style 1 Part Start ======-->

    <section class="product-wrapper pt-100 pb-70">

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                    <div class="filter-style-4 m-2">

                        <div class="filter-title">

                            <a class="title" data-toggle="collapse" href="#size" role="button" aria-expanded="false">

                                CATEGORY : <?php echo $r['cat_name'] ; ?>

                            </a>

                        </div>

                        <hr>

                        <?php $s = " SELECT * FROM akksofttech_subcategory WHERE cat_id = '".$_GET['cat_id']."' " ; $q = mysqli_query($conn , $s) ; while($r = mysqli_Fetch_array($q)){   ; ?>

                        <div class="collapse show boxsubcategoryname" id="size">

                            <div class="filter-size">

                                <ul>

                                    <div class="subcategoryname" data-id="<?php echo $r['scate_id'] ?>">

                                        <li>

                                            <p>  <?php echo $r['scate_name'] ; ?> </p>

                                        </li>

                                    </div>


                                </ul>

                            </div>

                        </div>

                        <?php } ?>

                    </div>

                </div>

                <div class="col-md-8">

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="mb-10">

                                <p class="font-weight-700">PRODUCT</p>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="row m-2 pb-2">

                        <div id="boxproductname">

                            <div class="row productname"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!--====== Product Style 1 Part Ends ======-->


    <script type="text/javascript">

      $(document).ready(function() {

        Viewproductwithsubcategoryall();

      } );

      </script>


    <?php require 'include/script.php' ?>

</body>

</html>