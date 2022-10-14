<?php include 'index_sql_profile.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ข้อมูลส่วนตัว ของ <?php echo $_SESSION['user_login'] ?>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class=""><a href="#home-pills" data-toggle="tab">แก้ไขโปรไฟล์</a>
                        </li>
                        <li class=""><a href="#profile-pills" data-toggle="tab">เปลี่ยนรหัสผ่าน</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="home-pills">
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ชื่อผู้ใช้งานระบบ</label>

                                    <input type="text" class="form-control" name="employee_name" value="<?= $result['employee_name'] ?>">

                                </div>


                                <div class="form-group">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">เบอร์โทรศัพท์มือถือ</label>

                                    <input type="text" class="form-control" name="employee_phone" value="<?= $result['employee_phone'] ?>">
                                </div>



                                <div class="form-group">
                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">อีเมล์</label>

                                    <input type="text" class="form-control" name="employee_email" value="<?= $result['employee_email']?>">
                                </div>



                                <div class="form-group">
                                    <input type="hidden" name="profile">
                                    <button type="submit" class="btn btn-primary">บันทึกข้อมูลการเปลี่ยนแปลง</button>
                                </div>
                            </div>




                        </div>
                    </div>
                        <div class="tab-pane fade" id="profile-pills">
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="col-md-7">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านเดิม</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="password" class="form-control" name="oldpassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านใหม่</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="password" class="form-control" name="newpassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">ยืนยันรหัสผ่านใหม่</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="password" class="form-control" name="confirmpassword">
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <input type="hidden" name="checkpassword">
                                        <input type="submit" class="btn btn-primary" value='ยืนยันการเปลี่ยนรหัสผ่าน' />
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
</div>

</div>
</div>
</div>

<!-- date -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://รับเขียนโปรแกรม.net/picker_date/picker_date.js"></script>
<script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
<script>
    picker_date(document.getElementById("date1"), {
        year_range: "-12:+10"
    });
    picker_date(document.getElementById("date3"), {
        year_range: "-12:+10"
    });
    picker_date(document.getElementById("date2"), {
        year_range: "-12:+10"
    });
</script>
<!-- date -->