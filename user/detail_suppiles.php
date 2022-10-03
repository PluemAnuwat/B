<?php require 'detailsql_suppiles.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>รายละเอียดของซัพพลายเซน</h2>
    </div>
</div>
<hr />
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            ข้อมูลเกี่ยวกับซัพพลายเซน
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <p>ชื่อซัพพลายเซน / บริษัท : <?= $result['partner_name'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>อีเมลล์ : <?= $result['partner_email'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>เบอร์โทรศัพท์ : <?= $result['partner_phone'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>ที่อยู่ : <?= $result['partnerd_add'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>จังหวัด : <?= $result['partnerd_pro'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>อำเภอ : <?= $result['partnerd_amp'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>ตำบล : <?= $result['partnerd_dis'] ?></p>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
</div>