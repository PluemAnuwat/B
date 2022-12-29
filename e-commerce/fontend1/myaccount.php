<?php
    @session_start();

    require 'includedb/condb.php'; 

    $sql = "SELECT * FROM akksofttech_customer WHERE  cus_id = '".$_SESSION['akksofttechsess_cusid']."'  ";

    $query = mysqli_query($conn , $sql);

    $result = mysqli_fetch_array($query); 

?>

<?php require 'include/head.php' ?>


<link rel="stylesheet" type="text/css" href="assets/cssscreen.css">

<body>

    <style>
    ::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 0px;
    }
    </style>



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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Profile</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <div id="dis"></div>

    <section class="contact-wrapper ">

        <div class="row">

            <div class="col-lg-2">

                <table>
                    <tr>
                        <td class="p-3"></td>

                    </tr>
                    <tr>
                        <th class="p-3"><img src="assets/images/user.png" width="50px"></th>
                        <th> <a href="profile.php" class="menu-link" target="myiframe">
                                <i class="menu-icon tf-icons bx bx-image-add"></i>
                                <div data-i18n="Analytics">PROFILES</div>

                            </a></th>

                    </tr>
                    <tr>
                        <th class="p-3"><img src="assets/images/address.png" width="50px"></th>
                        <th> <a href="address.php" class="menu-link" target="myiframe">
                                <i class="menu-icon tf-icons bx bx-image-add"></i>
                                <div data-i18n="Analytics">ADDRESS</div>

                            </a></th>
                    </tr>
                    <tr>
                        <th class="p-3"><img src="assets/images/reset-password.png" width="50px"></th>
                        <th> <a href="password_change.php" class="menu-link" target="myiframe">
                                <i class="menu-icon tf-icons bx bx-image-add"></i>
                                <div data-i18n="Analytics">PASSWORD CHANGE</div>

                            </a></th>
                    </tr>
                    <tr>
                        <th class="p-3"><img src="assets/images/cargo.png" width="50px"></th>
                        <th> <a href="myorder.php" class="menu-link" target="myiframe">
                                <i class="menu-icon tf-icons bx bx-image-add"></i>
                                <div data-i18n="Analytics">MY ORDERS</div>

                            </a></th>
                    </tr>
                </table>


            </div>



            <div class="col-lg-10">

                <div class="container">

                    <div class="pcoded-content">

                        <div class="page-wrapper">


                            <iframe height="400" width="600px;" src="profile.php" class="screen col-md-10"
                                name="myiframe" id="framelayout" frameborder="0" style=""></iframe>

                        </div>

                    </div>
                    
                </div>

            </div>

        </div>



    </section>

    </div>


</body>