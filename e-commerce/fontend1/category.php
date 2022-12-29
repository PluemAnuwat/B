<?php session_start() ; ?>

<?php require 'includedb/condb.php' ?>

<!doctype html>

<html class="no-js" lang="en">

<?php require 'include/head.php' ; ?>

<body>

<?php require 'include/loader.php' ; ?>

<?php require 'include/navigation.php' ; ?>

<?php $s = " SELECT * FROM akksofttech_subcategory WHERE cat_id = '".$_GET['cat_id']."' " ; $q = mysqli_query($conn , $s) ; $r = mysqli_Fetch_array($q) ; ?>

<div id="showproductall" style="display:none;"><?php echo $_GET['cat_id'] ; ?> </div>

    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Category</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Category</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="category-wrapper pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="filter-style-1 mt-0">
                        <div class="filter-title">
                            <h4 class="title">CATEGORY</h4>
                        </div>
                    </div>
                    <br>

                    <div class="filter-style-4">

                        <div class="filter-title">

                            <a class="title" data-toggle="collapse" href="#size" role="button" aria-expanded="false">
                                SELECT CATEGORY
                            </a>

                        </div>

                        <br>

                        <div class="collapse show boxsubcategory text-center" id="size">

                            <div class="filter-size">

                                <ul>

                                <?php $s = " SELECT * FROM akksofttech_subcategory WHERE cat_id = '".$_GET['cat_id']."' " ; $q = mysqli_query($conn , $s) ; while($r = mysqli_Fetch_array($q)){   ; ?>

                                    <div class="subcategory" data-id="<?php echo $r['scate_id'] ?>">

                                    <li><button class="btn btn-primary " style="width:200px; height:100; font-size:25px;"><?php echo $r['scate_name'] ; ?></button></li>

                                    </div>

                                    <br>

                                <?php } ?>

                                </ul>

                            </div>
                        </div>
                    </div>

                    <a class="btn btn-danger" href=javascript:history.back(1) style="width:100%; height:100; font-size:25px;">Balck</a>
                  
                </div>



                <div class="col-lg-8">

                    <div class="row">

                        <div class="col-lg-12">

                            <div
                                class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                                <div class="breadcrumb-left">
                                    <p>Showing 01-09 of 17 Results</p>
                                </div>
                                <div class="breadcrumb-right">
                                    <ul class="breadcrumb-list-grid nav nav-tabs border-0" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a id="home-tab" data-toggle="tab" href="#home" role="tab"
                                                aria-controls="home" aria-selected="true">
                                                <i class="mdi mdi-view-list"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="active" id="profile-tab" data-toggle="tab" href="#profile"
                                                role="tab" aria-controls="profile" aria-selected="false">
                                                <i class="mdi mdi-view-grid"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">

                     
                          
                                        <div class="col-lg-12">
                                            <div class="product-style-7 mt-30" id="boxproductname">
                                               
                                            <div class="productname" ></div>

                                            </div>
                                   
                                        </div>

                                    

                                    </div>
                                </div>


                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="row">


                                  
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="product-style-1 mt-30 productname1">
                                              


                                            </div>
                                        </div>


                                  

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pagination-wrapper pt-70">
                                <ul class="d-flex justify-content-center">
                                    <li>
                                        <a href="javascript:void(0)"><i class="lni lni-chevron-left"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="active">1</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">2</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">3</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">4</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="lni lni-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>



                </div>


            </div>
        </div>
    </section>


<script type="text/javascript">

      $(document).ready(function() {

        Viewproductwithsubcategoryall();

      } );

      </script>

    <?php require 'include/script.php' ; ?>

</body>

</html>