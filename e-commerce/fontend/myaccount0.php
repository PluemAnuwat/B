<?php
    @session_start();

    require 'includedb/condb.php'; 

    $sql = "SELECT * FROM akksofttech_customer WHERE  cus_id = '".$_SESSION['akksofttechsess_cusid']."'  ";

    $query = mysqli_query($conn , $sql);

    $result = mysqli_fetch_array($query); 

?>

<?php require 'include/head.php' ?>

<body>


    <?php require 'include/nav.php' ?>

    <script type="text/javascript" src="customer/crud.js"></script>

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
    <section class="contact-wrapper pt-50 pb-100">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <div class="contact-style-2 mt-50">
                        <ul class="contact-info">
                            <li>
                                <div class="single-contact-info d-flex">
                                    <div class="contact-info-content media-body">
                                        <table>
                                            <tr>
                                                <td class="p-3"></td>

                                            </tr>
                                            <tr>
                                                <th class="p-3"><img src="assets/images/user.png" width="50px"></th>
                                                <th><a href="?page=profile">PROFILE</a></th>

                                            </tr>
                                            <tr>
                                                <th class="p-3"><img src="assets/images/address.png" width="50px"></th>
                                                <th><a href="?page=address">ADDRESS</a></th>
                                            </tr>
                                            <tr>
                                                <th class="p-3"><img src="assets/images/reset-password.png"
                                                        width="50px"></th>
                                                <th><a href="?page=password">PASSWORD</a></th>
                                            </tr>
                                            <tr>
                                                <th class="p-3"><img src="assets/images/cargo.png" width="50px"></th>
                                                <th><a href="?page=myorder">MY ORDER</a></th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </li>

                        </ul>

                    </div>
                </div>

                <?php
          if (!isset($_GET['page']) && empty($_GET['page'])) {
            include('profile.php');

          } elseif (isset($_GET['page']) && $_GET['page'] == 'profile') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('profile_delete.php');
            } else {
              include('profile.php');
            }

        } elseif (isset($_GET['page']) && $_GET['page'] == 'address') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('address_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('address_update.php');
            } else {
              include('address.php');
            }

        } elseif (isset($_GET['page']) && $_GET['page'] == 'password') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('password_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('password_update.php');
            } else {
              include('password_change.php');
            }

        } elseif (isset($_GET['page']) && $_GET['page'] == 'myorder') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('myorder_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('myorder_update.php');
            } else {
              include('myorder.php');
            }

        }
            ?>

            </div>
        </div>


    </section>