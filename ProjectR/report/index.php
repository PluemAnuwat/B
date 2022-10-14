<!doctype html>
<html lang="en">
<?php require 'include/head.php' ?>
  <body>
		
  <?php require 'include/nav.php' ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">

 
        <a type="button" href="?page=admin" class="btn btn-info" style="height:8%; width:20%">ผู้ดูแลระบบ</a>
        <a type="button" href="?page=phar" class="btn btn-success" style="height:8%; width:20%">เภสัชกร</a>
        <a type="button" href="?page=manager" class="btn btn-danger" style="height:8%; width:20%">เจ้าของกิจการ</a>
        <br>
        <br>
        <?php
                          if (!isset($_GET['page']) && empty($_GET['page'])) {
                            include('indexall.php');
                          } elseif (isset($_GET['page']) && $_GET['page'] == 'admin') {   
                            echo '<h5 class="mb-4">รายงานผู้ใช้งานระบบ ตำแหน่ง ADMIN </h5> ' ;      
                              include('indexadmin.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'phar') {      
                          echo '<h5 class="mb-4">รายงานผู้ใช้งานระบบ ตำแหน่ง PHARMACY </h5> ' ;     
                          include('indexphar.php');
                        } elseif (isset($_GET['page']) && $_GET['page'] == 'manager') {    
                          echo '<h5 class="mb-4">รายงานผู้ใช้งานระบบ ตำแหน่ง MANAGER </h5> ' ;       
                          include('indexmanager.php');
                      }
                        ?>
      
      
      </div>
		</div>
<?php require 'include/script.php' ?>
  </body>
</html>