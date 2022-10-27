<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-3">
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
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
                              include('deletep.php');
                            } else {
                              include('indexp.php');
                            }
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'type_product') {   
                              include('indext.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'unit') {              
                              include('indexu.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'cate') {
                              include('indexc.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'symp') {
                              include('indexs.php');
                            }
                        ?>
        </div>
    </div>
</body>
<?php include '../script.php' ?>

</html>