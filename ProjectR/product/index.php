<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-5">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexp.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'product') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertp.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updatep.php');
                            } else {
                              include('indexp.php');
                            }
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'type_product') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertt.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updatet.php');
                            } else {
                              include('indext.php');
                            }
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'unit') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertu.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updateu.php');
                            } else {
                              include('indexu.php');
                            }
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'cate') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertc.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updatec.php');
                            } else {
                              include('indexc.php');
                            }
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'symp') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('inserts.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updates.php');
                            } else {
                              include('indexs.php');
                            }
                          }
                        ?>
        </div>
    </div>
</body>
<?php include '../script.php' ?>

</html>