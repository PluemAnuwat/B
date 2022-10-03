<?php require 'indexsql_dashboard.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้าหลัก</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-bars"></i>
            </span>
            <div class="text-box">
                <p class="main-text">พนักงาน</p>
                <p class="text-muted"><?= $result_employee['count_employee'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-brown set-icon">
                <i class="fa fa-rocket"></i>
            </span>
            <div class="text-box">
                <p class="main-text">ซัพพลายเซน</p>
                <p class="text-muted"><?= $result_partner['count_partner'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-bell-o"></i>
            </span>
            <div class="text-box">
                <p class="main-text">ลูกค้า</p>
                <p class="text-muted"><?= $result_customer['count_customer'] ?></p>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-md-12 col-sm-6 col-xs-6">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-bell-o"></i>
            </span>
            <div class="text-box">
                <p class="main-text">ผล</p>
                <p class="text-muted"></p>
                <a href="function_notify.php"></a>
            </div>
        </div>
    </div> -->

<hr>

<!-- <div class="col-md-4 col-sm-6 col-xs-6">
    <div class="panel panel-back noti-box">
        <div class="text-box">
            <p class="main-text">ยอดขายสินค้าวันนี้</p>
            <p class="text-muted"><?= datethai($datenow) ?></p>
            <p class="text-muted">
                <?php
                while ($row = mysqli_fetch_assoc($query)) { ?>
            <p><?= $row['count_product'] ?> รายการ</p>
            <p><?= number_format($row['count_price'], 2) ?> บาท</p>
        <?php } ?>
        </p>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
    <div class="panel panel-back noti-box">
        <div class="text-box">
            <p class="main-text">ยอดขายสินค้า สัปดาห์นี้</p>
            <p class="text-muted">
                <?php
                while ($row = mysqli_fetch_assoc($query1)) { ?>
            <p>ทั้งหมด <?= $row['count_product'] ?> รายการ</p>
            <p>ราคารวม <?= number_format($row['count_price'], 2) ?> บาท</p>
        <?php } ?>
        <p class="text-muted mb-0">สัปดาห์ที่ <?= $week1 ?> <?= datethai($start) . " ถึง " . datethai($end) ?> </p>

        </p>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
    <div class="panel panel-back noti-box">
        <div class="text-box">
            <p class="main-text">ยอดขายสินค้าแต่ละเดือน</p>
            <?php require 'function_chart.php' ?>
        </div>
    </div>
</div> -->