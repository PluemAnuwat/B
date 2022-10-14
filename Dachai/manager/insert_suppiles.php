<?php include 'insertsql_suppiles.php' ?>

<div class="row">
    <div class="col-md-12">
        <h2>หน้าเพิ่มข้อมูลของซัพพลายเซน</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มข้อมูลซัพพลายเซน
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data" name="frmMain">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อ / บริษัท ซัพพลายเซน</label>
                                    <input type="text" class="form-control" name="partner_name" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อีเมลล์</label>
                                    <input type="text" class="form-control" name="partner_email" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" name="partner_phone" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ที่อยู่</label>
                                    <input type="text" class="form-control" name="partnerd_add" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">จังหวัด</label>
                                    <input type="text" class="form-control" name="partnerd_pro" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อำเภอ</label>
                                    <input type="text" class="form-control" name="partnerd_amp" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ตำบล</label>
                                    <input type="text" class="form-control" name="partnerd_dis" id="inputSuccess">
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">จังหวัด</label>
                                    <select name="partnerd_pro" id="province" class="form-control">
                                        <option value="">เลือกจังหวัด</option>
                                        <?php while ($result = mysqli_fetch_assoc($query)) : ?>
                                            <option value="<?= $result['id'] ?>"><?= $result['name_th'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อำเภอ</label>
                                    <select name="partnerd_amp" id="amphure" class="form-control">
                                        <option value="">เลือกอำเภอ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ตำบล</label>
                                    <select name="partnerd_dis" id="district" class="form-control">
                                        <option value="">เลือกตำบล</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">รหัสไปรษณีย์</label>
                                   <input type="text" class="form-control" name="partnerd_geo" id="inputSuccess"> 
                                 
                                </div>
                            </div>
                            <div class="col-md-4">
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

<!-- <script src="assets/jquery.min.js"></script>
<script src="assets/script.js"></script> -->