<?php require 'indexsql_employee.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้ารายการข้อมูลของผู้ใช้งานระบบ</h2>
    </div>
</div>
<hr />
<div class="col-md-4">
    <form action="?page=employee" method="post">
        ค้นหา <input type="text" name="search" class="form-control" placeholder="กรอกคำค้นหา">
        <hr>
        <input type="submit" value="ค้นหา" class="btn btn-success">
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill btn-primary">เพิ่มผู้ใช้งานระบบ</a>
        <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
    </form>
</div>
<div class="row">
    <div class="col-md-4">

    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr class="text-nowrap">
                            <th>รหัสผู้ใช้งานระบบ</th>
                            <th>Username</th>
                            <th>ตำแหน่ง</th>
                            <th>เมนู</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        isset($_POST['search']) ? $search = $_POST['search'] : $search = "";
                        if (!empty($search)) {
                            $sql = " SELECT * FROM employee WHERE ( username LIKE '%" . $search . "%' )";
                            $q = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($q)) { ?>
                                <tr>
                                    <td><?php echo  $row['employee_id'] ?></td>
                                    <td><?php echo  $row['username'] ?></td>
                                    <td><?php echo  $row['employee_role'] ?></td>
                                    <td>
                                        <!-- <a href="?page=<?= $_GET['page'] ?>&function=detail&employee_id=<?= $row['employee_id'] ?>" class="btn  btn-primary">Details</a> -->
                                        <a href="?page=<?= $_GET['page'] ?>&function=update&employee_id=<?= $row['employee_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>Modify</a>
                                        <a href="?page=<?= $_GET['page'] ?>&function=delete&employee_id=<?= $row['employee_id'] ?>" class="btn  btn-danger  text-white" onclick="return confirm('ยืนยันการลบข้อมูล')"><i class="fa-solid fa-rectangle-xmark "></i>Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <?php $i = 1;
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo  $row['employee_id'] ?></td>
                                    <td><?php echo  $row['username'] ?></td>
                                    <td><?php echo  $row['employee_role'] ?></td>
                                    <td>
                                        <!-- <a href="?page=<?= $_GET['page'] ?>&function=detail&employee_id=<?= $row['employee_id'] ?>" class="btn  btn-primary">Details</a> -->
                                        <a href="?page=<?= $_GET['page'] ?>&function=update&employee_id=<?= $row['employee_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>Modify</a>
                                        <a href="?page=<?= $_GET['page'] ?>&function=delete&employee_id=<?= $row['employee_id'] ?>" class="btn  btn-danger  text-white" onclick="return confirm('ยืนยันการลบข้อมูล')"><i class="fa-solid fa-rectangle-xmark "></i>Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>