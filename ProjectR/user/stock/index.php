<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-5">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexs.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'stock') {
                            if (isset($_GET['function']) && $_GET['function'] == 'insert') {
                              include('inserts.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
                              include('updates.php');
                            } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
                              include('delete.php');
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