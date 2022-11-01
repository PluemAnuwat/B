<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>
<body>
    <div class="mt-2">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexp.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'po') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertp.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') { //เปลี่ยนสถานะจากรอยืนยัน -> ยกเลิก
                              include('deletep.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
                              include('detailp.php');
                            } else {
                              include('indexp.php');
                            }
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'manager_po') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insertm.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'good') {
                              include('insertsqlmg.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') { //เปลี่ยนสถานะจากรอยืนยัน -> ยกเลิก
                              include('deletep.php');
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