<?php session_start(); ?>
<?php if (isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])) : ?>
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

            <a href="store1/index.php"><img src="images/shop.png" class="ms-5" width="15%" height="15%"></a>

            <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#exampleModal"
                href="profile/index.php?page=profile"><img src="images/employee.png" class="ms-5" width="10%"
                    height="10%"></a>
            <span class="text-danger" style="font-size:80px;"><?= $_SESSION['posit_login']?></span>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content">
                        <div class="modal-body">

                            <?php 
                                    $con = mysqli_connect("localhost","root","akom2006","project");
                                    $sql= "SELECT * FROM employee WHERE username = '".$_SESSION['user_login']."' ";
                                    $query = mysqli_query($con , $sql);
                                    $result = mysqli_fetch_array($query);

                                   ?>
                            <div class="row">



                                <form action="indexsql.php" method="post" enctype="multipart/form-data">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ชื่อ</label>

                                            <input type="text" class="form-control" name="employee_name"
                                                value="<?= $result['employee_name'] ?>">

                                        </div>


                                        <div class="form-group">
                                            <label for="company"
                                                class="col-md-4 col-lg-3 col-form-label">เบอร์โทรศัพท์</label>

                                            <input type="text" class="form-control" name="employee_phone"
                                                value="<?= $result['employee_phone'] ?>">
                                        </div>



                                        <div class="form-group">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">อีเมล์</label>

                                            <input type="text" class="form-control" name="employee_email"
                                                value="<?= $result['employee_email']?>">
                                        </div>

                                    </div>
                                    <br>
                                    <input type="hidden" name="profile">
                                    <button type="submit" class="btn btn-primary">บันทึกข้อมูลการเปลี่ยนแปลง</button>
                                </form>



                                <form action="indexsql2.php" method="post" enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName"
                                                class="col-md-4 col-lg-3 col-form-label">รหัสผ่านเดิม</label>

                                            <input type="password" class="form-control" name="oldpassword">

                                        </div>


                                        <div class="form-group">
                                            <label for="company"
                                                class="col-md-4 col-lg-3 col-form-label">รหัสผ่านใหม่</label>

                                            <input type="password" class="form-control" name="newpassword">
                                        </div>



                                        <div class="form-group">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">ยืนยัน</label>

                                            <input type="password" class="form-control" name="confirmpassword">
                                        </div>

                                    </div>
                                    <br>
                                    <input type="hidden" name="checkpassword">
                                    <input type="submit" class="btn btn-primary" value='ยืนยันการเปลี่ยนรหัสผ่าน' />
                                </form>


                                
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>

                        </div>


                    </div>



                </div>
            </div>



            <a href="./logout/index.php" class=""><img src="images/logout.png" class="ms-5" width="6%" height="6%"></a>
            <hr class="bg-light">


        </div>




        <center>
            <div class="container">
                <div class="row row-cols-12 row-cols-lg-5 g-2 g-lg-3">
                    <div class="col">
                        <div class="p-3 border bg-light border-white">
                            <a href="customer/index.php?page=customer"><img src="images/user.png" width="70%"
                                    height="100%"></a>
                            <hr>
                            <center><span>ลูกค้า</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border bg-light border-white ">
                            <a href="member/index.php?page=member"><img src="images/customer.png" width="70%"
                                    height="100%"></a>
                            <hr>
                            <center><span>สมาชิก</span></center>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 border bg-light border-white ">
                            <a href="suppiles/index.php?page=suppiles"><img src="images/suppiles.png" width="70%"
                                    height="100%"></a>
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
                            <a href="price/index.php?page=sale"><img src="images/price.png" width="70%"
                                    height="70%"></a>
                            <hr>
                            <center><span>กำหนดราคาขาย</span></center>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row row-cols-12 row-cols-lg-5 g-2 g-lg-3">
                        <div class="col">
                            <div class="p-3 border bg-light border-white">
                                <a href="product/index.php?page=product"><img src="images/product.png" width="70%"
                                        height="70%"></a>
                                <hr>
                                <center><span>เมนูสินค้า</span></center>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border bg-light border-white ">
                                <a href="po/index.php?page=po"><img src="images/order.png" width="70%" height="70%"></a>
                                <hr>
                                <center><span>การสั่งซื้อ</span></center>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border bg-light border-white ">
                                <a href="goods/index.php?page=goods"><img src="images/goods.png" width="70%"
                                        height="70%"></a>
                                <hr>
                                <center><span>ใบรับสินค้า</span></center>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border bg-light border-white ">
                                <a href="stock/index.php?page=stock"><img src="images/in-stock.png" width="70%"
                                        height="70%"></a>
                                <hr>
                                <center><span>สต็อกสินค้า</span></center>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 border bg-light border-white ">
                                <a href="line/function_notify1.php"><img src="images/line.png" width="70%"
                                        height="70%"></a>
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
</html>
<?php include 'script.php' ?>
<?php else : ?>
<?php include('index.php') ?>
<?php endif; ?>