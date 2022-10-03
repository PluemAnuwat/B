<?php require 'detailsql_product.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้ารายละเอียดของสินค้า</h2>
    </div>
</div>
<hr />
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ข้อมูลเกี่ยวกับสินค้า
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">รูปภาพ</a>
                        </li>
                        <li class=""><a href="#profile" data-toggle="tab">ข้อมูล</a>
                        </li>
                        <li class=""><a href="#price" data-toggle="tab">ราคา</a>
                        </li>
                            <!-- <li class=""><a href="#messages" data-toggle="tab">ราคา</a>
                            </li>
                            <li class=""><a href="#settings" data-toggle="tab">Settings</a>
                            </li> -->
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <h4>รูปภาพ</h4>
                            <div class="col-md-6">
                                <img class="card-img-top" src=".\image\<?= $result['product_img']; ?>" alt="Card image cap" width="400" height="400" />
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <h4>ข้อมูลเกี่ยวกับสินค้า</h4>
                            <div class="col-md-6">
                                <p>Barcode : <?= $result['product_barcode'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>ชื่อสินค้า : <?= $result['product_name'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>หน่วยของสินค้า : <?= $result['unit_name'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>ประเภทสินค้า : <?= $result['type_name'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>หมวดหมู่สินค้า : <?= $result['category_name'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p>หมวดหมู่สินค้าแยกตามอาการ : <?= $result['symp_name'] ?></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="price">
                            <h4>ข้อมูลเกี่ยวกับสินค้า</h4>
                            <div class="col-md-4">
                                <p>ราคาทุน : <?= number_format($result['product_price_cost'],2) ?> บาท</p>
                            </div>
                            <div class="col-md-4">
                                <p>ราคาขาย : <?= number_format($result['product_price_sell'],2) ?> บาท</p>
                            </div>
                            <div class="col-md-4">
                                <p>จุดสั่งซื้อ : <?= $result['point'] ?></p>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="messages">
                            <h4>ราคาสินค้าปัจจุบัน</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <h4>Settings Tab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-6 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ประวัติการสั่งซื้อสินค้า
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class=""><a href="#home-pills" data-toggle="tab">หน้าหลัก</a>
                        </li>
                        <li class=""><a href="#profile-pills" data-toggle="tab">Profile</a>
                        </li>
                        <li class=""><a href="#messages-pills" data-toggle="tab">Messages</a>
                        </li>
                        <li class="active"><a href="#settings-pills" data-toggle="tab">Settings</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="home-pills">
                            <h4>Home Tab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                        <div class="tab-pane fade" id="profile-pills">
                            <h4>Profile Tab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                        <div class="tab-pane fade" id="messages-pills">
                            <h4>Messages Tab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                        <div class="tab-pane fade active in" id="settings-pills">
                            <h4>Settings Tab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>