<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-5">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexg.php');
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
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'manager_goods') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertm.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updatem.php');

                            } else {
                              include('indexm.php');
                            }
                          }
                        ?>
        </div>
    </div>
</body>
<?php include '../script.php' ?>

</html>