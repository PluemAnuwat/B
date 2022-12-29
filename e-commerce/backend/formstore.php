<?php 
   @session_start();
   require_once("check_login.php");	
   require_once 'include/condb.php';	
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>AKK SOFTTECH</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/icons/AKK/icon-144x144.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/cssscreen.css">
</head>

<body>

    <!-- Layout container -->
    <div class="layout-wrapper layout-content-navbar">

        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>
                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                aria-label="Search..." />
                        </div>
                    </div>
                    <!-- /Search -->
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="flex-grow-1">
                                    <span
                                        class="fw-semibold d-block"><?php echo $_SESSION['akksofttechsess_username']?></span>

                                    <small class="text-muted">seller</small>

                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="logout.php">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- CON -->
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">MY STORE</span></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Basic Layout -->
                            <div class="row">
                                <div class="col-xl">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div id="dis">
                                                <!-- here message will be displayed -->
                                            </div>
                                            <?php 
							
                                                        
                                $sql = "SELECT * FROM akksofttech_member_store 
                                WHERE mem_id = '".$_SESSION['akksofttechsess_memid']."'";
                                $query = mysqli_query($connect,$sql);
                                $row = mysqli_fetch_assoc($query);

                            if($row['sto_name'] != '' && $row['sto_id'] !=''){
                                $alert = '<script type="text/javascript">';
                                $alert .= 'window.location.href="index.php";';
                                $alert .= '</script>';
                                echo $alert ;
                                exit; 
                            }else{ ?>

                                            <form method='post' id='emp-SaveForm1'>

                                                <div class="row mb-3" style="display:none;">

                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-default-fullname">Name</label>

                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i
                                                                    class="bx bx-user"></i></span>
                                                            <input type="text" class="form-control" readonly="readonly"
                                                                name="mem_name" id="basic-default-fullname "
                                                                placeholder=""
                                                                value='<?php echo $_SESSION['akksofttechsess_name'];?>' />
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">



                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-default-company">Store
                                                        name</label>

                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2"
                                                                class="input-group-text"><i class='bx bx-home-heart'></i></span>
                                                            <input type="text" class="form-control" name="sto_name"
                                                                id="sto_name" />
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-default-fullname">LOGO</label>


                                                    <div class="col-sm-10">
                                                        <div class="show_view_img"> </div>

                                                        <input type="file" name="filelogo_picture" id="imagebroswer"
                                                            class='form-control  btn-upload' />

                                                        <textarea name="logo_img64" id="logo_img64" class="form-control"
                                                            style="display:none;"></textarea>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-default-company">Address</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="sto_address"
                                                            id="sto_address" />
                                                    </div>

                                                </div>

                                                <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-default-company">Province</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="sto_province"
                                                            id="basic-default-company" />
                                                        <div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        for="basic-default-company">Zipcode</label>

                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="sto_zipcode"
                                                            id="basic-default-company" />
                                                    </div>
                                                </div>

                                                <div class="row justify-content-end">

                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary" name="btn-save"
                                                            id="btn-save">SAVE</button>
                                                    </div>
                                                </div>

                                            </form>
                                            <?php }
                                                    
                        
                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CON -->

        </div>
    </div>
    <!-- END Layout  -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script type="text/javascript">
    $(document).ready(function() {

    });
    // เมื่อคลิกที่ปุ่มเลือกไฟล์
    $(".btn-upload").on("click", function() {
        //ให้ input file เกิด event click
        $(this).prev("input:file").trigger("click");
        console.log('input:file');
    });


    // ถ้ามีการเปลี่ยนไฟล์ที่อัพโหลด
    $(".file-up").on("change", function() {
        var fileLength = $(this)[0].files.length; // เลือกไฟล์หรือไม่
        if (fileLength != 0) { // ถ้าเลือกไฟล์




        } else { // ถ้าไม่ได้เลือกไฟล์
            // $(this).next(".btn-upload").html("<img class='d-block mx-auto mb-1' src='img/imgcamera.svg' alt='' width='50' height='50'>");
            // $(this).nextAll(".btn-remove-file").hide();

        }
    });








    $('#imagebroswer').on('change', function() {
        resizeImages(this.files[0], function(dataUrl) {


            // console.log(dataUrl);


            $("#logo_img64").val(dataUrl);
            //   inset_img(dataUrl);


            //   var this_length= $("#logo_img64").val().length; // หาจำนวนตัวอักษรที่เหลือ
            //   $("#now_length").html(this_length+" ตัวอักษร"); 

            $(".show_view_img").html('<img   class=" "   src="' + dataUrl +
                '"  style="height: 100%;"   >');



        });
    });

    function resizeImages(file, complete) {
        // read file as dataUrl
        ////////  2. Read the file as a data Url
        var reader = new FileReader();
        // file read
        reader.onload = function(e) {
            // create img to store data url
            ////// 3 - 1 Create image object for canvas to use
            var img = new Image();
            img.onload = function() {
                /////////// 3-2 send image object to function for manipulation
                complete(resizeInCanvas(img));


                // console.log(complete(resizeInCanvas(img)));
            };
            img.src = e.target.result;
        }
        // read file
        reader.readAsDataURL(file);

    }


    function resizeInCanvas(img) {
        /////////  3-3 manipulate image
        var perferedWidth = 200;
        var ratio = perferedWidth / img.width;
        var canvas = $("<canvas>")[0];
        canvas.width = img.width * ratio;
        canvas.height = img.height * ratio;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        //////////4. export as dataUrl
        return canvas.toDataURL();
    }
    </script>

    <script type="text/javascript" src="inesetstore.js"></script>



</body>


</html>