<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-5">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexc.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'suppiles') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('insert.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
                              include('delete.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('update.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'detail') {
                              include('detail.php');
                            } else {
                              include('indexc.php');
                            }
                          }
                        ?>
        </div>
    </div>
</body>
<?php include '../script.php' ?>

</html>