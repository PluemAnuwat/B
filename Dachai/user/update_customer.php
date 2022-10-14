<?php include 'updatesql_customer.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>แก้ไขข้อมูลลูกค้า</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มแก้ไขข้อมูลลูกค้า
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">หมายเลขประจำตัวลูกค้า</label>
                                    <input class="form-control" name="customer_name" value="<?= $result['customer_id'] ?>" type="text" id="html5-text-input" disabled />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อลูกค้า</label>
                                    <input class="form-control" name="customer_name" value="<?= $result['customer_name'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">นามสกุลลูกค้า</label>
                                    <input class="form-control" name="customer_last" value="<?= $result['customer_last'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                    <input class="form-control" name="customer_phone" value="<?= $result['customer_phone'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">การแพ้ยา</label>
                                    <input class="form-control" type="password" name="customer_drug" value="<?= $result['customer_drug'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>


                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mr-2">ยืนยันแก้ไข</button>
                                <button class="btn btn-success" type="reset" name="reset">ยกเลิก</button>
                                <a class="btn btn-danger" href=javascript:history.back(1)>ย้อนกลับ</a>
                            </div>


                        </div>

                        <!-- <div class="col-md-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">ประวัติการรับยา</label>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th scope="col">วันที่รับยา</th>
                                                <th scope="col">รายการสินค้า</th>
                                                <th scope="col">จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>