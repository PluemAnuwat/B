<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>
<?php if (isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])) : ?>
<body>
    <style>
    .bgc {
        background-color: purple;
    }

    .bgd {
        background-color: brown;
    }

    .borderstyle {
        border-style: solid;
        border-width: 5px;
        border-color: purple;
    }
    </style>
    <div class="mt-2">
        <div class="container">
            
            <a href="store1/index.php"><img src="images/shop.png" class="ms-5" width="15%" height="15%"></a>

            <a class="navbar-brand" href="?page=index_profile"><img src="images/employee.png"  class="ms-5"  width="15%" height="15%" ></a>
            <span class="text-danger" style="font-size:50px;"><?= $_SESSION['posit_login']?></span>
            

            <a href="./logout/index.php" class=""><img src="images/logout.png" class="ms-5" width="6%" height="6%"></a> 
            <hr class="bg-light">

         
        </div>

     


       <center>
        <div class="container">
            <div class="row row-cols-12 row-cols-lg-5 g-2 g-lg-3">
                <div class="col">
                    <div class="p-3 border  border-white">
                        <a href="customer/index.php?page=customer"><img src="images/user.png" width="70%" height="100%"></a>
                        <hr>
                        <center><span>ลูกค้า</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border  border-white ">
                        <a href="member/index.php?page=member"><img src="images/customer.png" width="70%" height="100%"></a>
                        <hr>
                        <center><span>สมาชิก</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border  border-white ">
                        <a href="suppiles/index.php?page=suppiles"><img src="images/suppiles.png" width="70%" height="100%"></a>
                        <hr>
                        <center><span>ซัพพลายเซน</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border  border-white ">
                        <a href="report/index.php"><img src="images/report.png" width="70%" height="70%"></a>
                        <hr>
                        <center><span>รายงานทั้งหมด</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border  border-white ">
                        <a href="price/index.php?page=sale"><img src="images/price.png" width="70%" height="70%"></a>
                        <hr>
                        <center><span>กำหนดราคาขาย</span></center>
                    </div>
                </div>
            </div>
    
            <div class="container">
                <div class="row row-cols-12 row-cols-lg-5 g-2 g-lg-3">
                    <div class="col">
                        <div class="p-3 border  border-white">
                            <a href="product/index.php?page=product"><img src="images/product.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>เมนูสินค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border  border-white ">
                            <a href="po/index.php?page=po"><img src="images/order.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>การสั่งซื้อ</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border  border-white ">
                            <a href="goods/index.php?page=goods"><img src="images/goods.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>ใบรับสินค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border  border-white ">
                            <a href="stock/index.php?page=stock"><img src="images/in-stock.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>สต็อกสินค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border  border-white ">
                            <a href="line/function_notify1.php"><img src="images/line.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>LINE Notify</span></center>
                        </div>
                    </div>
                </div>
            </div>
            <br>


        </div>
        </center>   
</body>
<?php include 'script.php' ?>
<?php else : ?>
  <?php include('index.php') ?>
<?php endif; ?>

</html>