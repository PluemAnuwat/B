<?php require 'detailsql_customer.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>รายละเอียดของลูกค้า</h2>
    </div>
</div>
<hr />
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            ข้อมูลเกี่ยวกับลูกค้า
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <p>ชื่อลูกค้า : <?= $result['customer_name'] ?> <?= $result['customer_last'] ?></p>
                </div>
                <div class="col-md-6">
                    <p>เบอร์โทรศัพท์ : <?= $result['customer_phone'] ?></p>
                </div>
                <!-- <div class="col-md-6">
                    <p>ประวัติการรับยาในร้านขายยาดาชัย์ : <?= $result['customer_his'] ?></p>
                </div> -->
                <div class="col-md-6">
                    <p>การแพ้ยา : <?= $result['customer_drug'] ?></p>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </div>
</div>