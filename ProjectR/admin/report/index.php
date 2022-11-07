<!doctype html>
<html lang="en">
<?php require 'include/head.php' ?>

<body>

    <?php require 'include/nav.php' ?>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">



        <br>
        <br>
        <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexall.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'admin') {   ?>
                          <a type="button" href="?page=admin" class="btn btn-info" style="height:8%; width:20%">ผู้ดูแลระบบ</a>
                          <a type="button" href="?page=phar" class="btn btn-success" style="height:8%; width:20%">เภสัชกร</a>
                          <a type="button" href="?page=manager" class="btn btn-danger" style="height:8%; width:20%">เจ้าของกิจการ</a>
                          <hr>
                          <?php
                            echo '<h5 class="mb-4">รายงานผู้ใช้งานระบบ ตำแหน่ง ADMIN </h5> ' ;      
                              include('indexadmin.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'phar') {   ?>
                        <a type="button" href="?page=admin" class="btn btn-info" style="height:8%; width:20%">ผู้ดูแลระบบ</a>
                        <a type="button" href="?page=phar" class="btn btn-success" style="height:8%; width:20%">เภสัชกร</a>
                        <a type="button" href="?page=manager" class="btn btn-danger" style="height:8%; width:20%">เจ้าของกิจการ</a>
                        <hr>
                        <?php 
                          echo '<h5 class="mb-4">รายงานผู้ใช้งานระบบ ตำแหน่ง PHARMACY </h5> ' ;     
                          include('indexphar.php');
                          
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'manager') {   ?>
                        <a type="button" href="?page=admin" class="btn btn-info" style="height:8%; width:20%">ผู้ดูแลระบบ</a>
                        <a type="button" href="?page=phar" class="btn btn-success" style="height:8%; width:20%">เภสัชกร</a>
                        <a type="button" href="?page=manager" class="btn btn-danger" style="height:8%; width:20%">เจ้าของกิจการ</a>
                        <hr>
                        <?php
                          echo '<h5 class="mb-4">รายงานผู้ใช้งานระบบ ตำแหน่ง MANAGER </h5> ' ;       
                          include('indexmanager.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'stockall') {  
                          echo '<h5 class="mb-4">รายงาน STOCK PRODUCT ALL </h5> ' ; 
                          include('indexstockall.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'stockin') {    
                          echo '<h5 class="mb-4">รายงานสินค้านำเข้าสต็อก</h5> ' ;       
                          include('indexstockin.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'product') {    
                          echo '<h5 class="mb-4">รายงานสินค้าทั้งหมด</h5> ' ;       
                          include('indexproduct.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'report_po') {    
                          if (isset($_GET['function']) && $_GET['function'] == 'rptsales_day') {
                            include('rptsales_day.php');
                          } elseif (isset($_GET['function']) && $_GET['function'] == 'rptsales_month') {
                            include('rptsales_month.php');
                          } elseif (isset($_GET['function']) && $_GET['function'] == 'rptsales_year') {
                            include('rptsales_year.php');
                          }else{
                          include('report_po.php');
                          }
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'report_po_yes') {
                          include('report_po_yes.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'report_age_yes') {
                          include('report_age_yes.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'report_qty_yes') {
                          include('report_qty_yes.php');
                        
                      } elseif (isset($_GET['page']) && $_GET['page'] == 'report_sell_yes') {
                        if (isset($_GET['function']) && $_GET['function'] == 'rptsales_day') {
                          include('rptsales_day.php');
                        } elseif (isset($_GET['function']) && $_GET['function'] == 'rptsales_month') {
                          include('rptsales_month.php');
                        } elseif (isset($_GET['function']) && $_GET['function'] == 'rptsales_year') {
                          include('rptsales_year.php');
                        }else{
                        include('report_sell_yes.php');
                      }
                    }
                        ?>


    </div>
    </div>
    <?php require 'include/script.php' ?>
</body>

</html>