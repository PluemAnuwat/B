<?php include 'insertsql_customer.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้าเพิ่มข้อมูลของลูกค้า</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มข้อมูลลูกค้า
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data" name="frmMain">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
                                    <input type="text" class="form-control" name="customer_name" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">นามสกุลลูกค้า</label>
                                    <input type="text" class="form-control" name="customer_last" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อีเมลล์</label>
                                    <input type="text" class="form-control" name="customer_email" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" name="customer_phone" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">การแพ้ยา</label>
                                    <input type="text" class="form-control" name="customer_drug" id="inputSuccess">
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ประวัติการรับยา</label>
                                    <input type="password" class="form-control" name="customer_his" id="inputSuccess">
                                </div>
                            </div> -->
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                                <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/jquery.min.js"></script>
<script src="assets/script.js"></script>
<!-- รูปภาพ -->