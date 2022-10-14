<?php include 'updatesql_suppiles.php' ?>
<?php
$sql = "SELECT * FROM provinces";
$query = mysqli_query($con, $sql);
?>

<div class="row">
    <div class="col-md-12">
        <h2>แก้ไขข้อมูลสินค้า</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มข้อมูลสินค้า
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                         
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อซัพพลายเซน</label>
                                    <input class="form-control" name="partner_name" value="<?= $result['partner_name'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อีเมล์</label>
                                    <input class="form-control" name="partner_email" value="<?= $result['partner_email'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                    <input class="form-control" name="partner_phone" value="<?= $result['partner_phone'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">จังหวัด</label>
                                    <input class="form-control" name="partnerd_pro" value="<?= $result['partnerd_pro'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อำเภอ</label>
                                    <input class="form-control" name="partnerd_amp" value="<?= $result['partnerd_amp'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ตำบล</label>
                                    <input class="form-control" name="partnerd_dis" value="<?= $result['partnerd_dis'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">จังหวัด</label>
                                    <select name="partnerd_pro" id="province" class="form-control">
                                        <option value="">เลือกจังหวัด</option>
                                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                                            <option value="<?= $row['id'] ?>"<?= $result['partnerd_pro'] == $row['id'] ? 'selected' : '' ?>> <?= $row['name_th'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อำเภอ</label>
                                    <select name="partnerd_amp" id="amphure" class="form-control">
                                        <option value="">เลือกอำเภอ</option>
                                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                                            <option value="<?= $row['id'] ?>"<?= $result['partnerd_amp'] == $row['id'] ? 'selected' : '' ?>> <?= $row['name_th'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ตำบล</label>
                                    <select name="partnerd_dis" id="district" class="form-control">
                                        <option value="">เลือกตำบล</option>
                                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                                            <option value="<?= $row['id'] ?>"<?= $result['partnerd_dis'] == $row['id'] ? 'selected' : '' ?>> <?= $row['name_th'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mr-2">ยืนยันแก้ไข</button>
                                <button class="btn btn-success" type="reset" name="reset">ยกเลิก</button>
                                <a class="btn btn-danger" href=javascript:history.back(1)>ย้อนกลับ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- รูปภาพ -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function ReadURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#product_img").change(function() {
        ReadURL(this);
    });
</script>