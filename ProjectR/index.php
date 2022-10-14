<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>

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
            <a href="store.php"><img src="images/dashboard.png" class="ms-5" width="15%" height="15%"></a>
            <a href="store/index.php"><img src="images/shop.png" class="ms-5" width="15%" height="15%"></a>
            <!-- <button type="button" class="btn-lg btn btn-success" style="width:300px;height:100px">Success</button>
            <button type="button" class="btn-lg btn btn-danger" style="width:300px;height:100px">Success</button> -->
            <hr class="bg-light">

            <nav class="navbar navbar-light bgc">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="#">
                        เมนู
                    </a>
                </div>
            </nav>
        </div>
        <br>
        <div class="container">
            <div class="row row-cols-12 row-cols-lg-5 g-2 g-lg-3">
                <div class="col">
                    <div class="p-3 border bg-light border-white">
                        <a href="customer/index.php"><img src="images/user.png" width="70%" height="100%"></a>
                        <hr>
                        <center><span>ลูกค้า</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light border-white ">
                        <a href="member/index.php"><img src="images/customer.png" width="70%" height="100%"></a>
                        <hr>
                        <center><span>สมาชิก</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light border-white ">
                        <a href="suppiles/index.php"><img src="images/suppiles.png" width="70%" height="100%"></a>
                        <hr>
                        <center><span>ซัพพลายเซน</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light border-white ">
                        <a href="report/index.php"><img src="images/report.png" width="70%" height="70%"></a>
                        <hr>
                        <center><span>รายงานทั้งหมด</span></center>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3 border bg-light border-white ">
                        <a href="price/index.php"><img src="images/price.png" width="70%" height="70%"></a>
                        <hr>
                        <center><span>กำหนดราคาขาย</span></center>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <nav class="navbar navbar-light bgd">
                    <div class="container-fluid">
                        <a class="navbar-brand text-white" href="#">
                            เมนู
                        </a>
                    </div>
                </nav>
            </div>
            <br>
            <div class="container">
                <div class="row row-cols-12 row-cols-lg-5 g-2 g-lg-3">
                    <div class="col">
                        <div class="p-3 border bg-light border-white">
                            <a href="product/index.php"><img src="images/product.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>เมนูสินค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border bg-light border-white ">
                            <a href="po/index.php"><img src="images/order.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>การสั่งซื้อ</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border bg-light border-white ">
                            <a href="goods/index.php"><img src="images/goods.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>ใบรับสินค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border bg-light border-white ">
                            <a href="stock/index.php"><img src="images/in-stock.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>สต็อกสินค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border bg-light border-white ">
                            <a href="line/index.php"><img src="images/line.png" width="70%" height="70%"></a>
                            <hr>
                            <center><span>LINE Notify</span></center>
                        </div>
                    </div>
                </div>
            </div>
            <br>


        </div>
</body>
<?php include 'script.php' ?>

</html>