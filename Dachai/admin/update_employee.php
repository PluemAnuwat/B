<?php include 'updatesql_employee.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>แก้ไขข้อมูลผู้ใช้งานระบบ</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มแก้ไขข้อมูลผู้ใช้งานระบบ
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="preview" width="250" height="250" src="./image/<?= $result['employee_img'] ?>">
                                    <hr>
                                    <input type="file" class="form-control" name="employee_img" id="employee_img">
                                    <input type="hidden" name="oldimage" value="<?= $result['employee_img'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อผู้ใช้งานระบบ</label>
                                    <input class="form-control" name="employee_name" value="<?= $result['employee_name'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                    <input class="form-control" name="employee_phone" value="<?= $result['employee_phone'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อีเมล์</label>
                                    <input class="form-control" name="employee_email" value="<?= $result['employee_email'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">Username</label>
                                    <input class="form-control" name="username" value="<?= $result['username'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">Password</label>
                                    <input class="form-control" type="password" name="password" value="<?= $result['password'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            
                           
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
    $("#employee_img").change(function() {
        ReadURL(this);
    });
</script>