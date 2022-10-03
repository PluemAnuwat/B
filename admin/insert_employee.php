<?php include 'insertsql_employee.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้าเพิ่มข้อมูลของผู้ใช้งานระบบ</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มข้อมูลผู้ใช้งานระบบ
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data" name="frmMain">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="preview" width="200" height="200">
                                    <hr>
                                    <input type="file" class="form-control " id="employee_img" name="employee_img" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อผู้ใช้งานระบบ</label>
                                    <input type="text" class="form-control" name="employee_name" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">อีเมลล์</label>
                                    <input type="text" class="form-control" name="employee_email" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" name="employee_phone" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">Username</label>
                                    <input type="text" class="form-control" name="username" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">Password</label>
                                    <input type="password" class="form-control" name="password" id="inputSuccess">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ตำแหน่ง</label>
                                    <select name="employee_role" class="form-control" >
                                        <option value="">--- เลือกตำแหน่ง ---</option>
                                        <option value="เภสัชกร">เภสัชกร</option>
                                        <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                        <option value="เจ้าของกิจการ">เจ้าของกิจการ</option>
                                    </select>
                                </div>
                            </div>
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