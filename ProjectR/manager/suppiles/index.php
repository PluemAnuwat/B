<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>

<body>
    <div class="mt-2">
        <div class="container">
            <?php include 'ul.php' ?>
            <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexc.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'suppiles') {
                              include('indexc.php');
                          }
                        ?>
        </div>
    </div>
</body>
<?php include '../script.php' ?>

</html>