<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-5">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexm_test.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'goods') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertg.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updateg.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
                              include('indexmdate.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'insertwaitsend') {
                              include('insertwaitsend.php');
                            } else {
                              include('indexg.php');
                            }
                          // } elseif (isset($_GET['page']) && $_GET['page'] == 'manager_goods') {
                          //   if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                          //     include('insertm.php');
                          //   } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
                          //     include('deletem.php');

                          //   } else {
                          //     include('indexm.php');
                          //   }

                          } elseif (isset($_GET['page']) && $_GET['page'] == 'manager_goods_test') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertm_test.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
                              include('deletem.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
                              include('indexmdate_test.php');
                            } else {
                              include('indexm_test.php');
                            }
                            
                          }
                        ?>
        </div>
    </div>
</body>
<?php include '../script.php' ?>

</html>