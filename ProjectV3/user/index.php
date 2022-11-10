<?php require '../include/head.php' ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php require '../include/sidebar.php' ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php require '../include/topbar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                
                <?php
          if (!isset($_GET['page']) && empty($_GET['page'])) {
            include('product_index.php');

          } elseif (isset($_GET['page']) && $_GET['page'] == 'product') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('product_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('product_update.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
              include('detail_product.php');
            } else {
              include('product_index.php');
            }

          } elseif (isset($_GET['page']) && $_GET['page'] == 'unit') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('unit_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('unit_update.php');
            } else {
              include('unit_index.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'cate') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('cate_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('cate_update.php');
            } else {
              include('cate_index.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'type') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('type_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('type_update.php');
            } else {
              include('type_index.php');
            }
          } elseif (isset($_GET['page']) && $_GET['page'] == 'symp') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('symp_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('symp_update.php');
            } else {
              include('symp_index.php');
            }

          } elseif (isset($_GET['page']) && $_GET['page'] == 'phase') {
            if (isset($_GET['function']) && $_GET['function'] == 'delete') {
              include('phase_delete.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'insert') {
              include('phase_insert.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'insert1') {
              include('phase_insert_show.php');
            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
              include('phase_update.php');
            } else {
              include('phase_index.php');
            }


          } elseif (isset($_GET['page']) && $_GET['page'] == 'product_insert') {
            include('product_insert.php');
          }
        
        
          ?>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php require '../include/script.php' ?>

</body>

</html>