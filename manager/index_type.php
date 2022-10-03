<?php require 'indexsql.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้ารายการข้อมูลพื้นฐาน</h2>
    </div>
</div>
<hr />
<a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="panel panel-default">
                <form method="POST" action="insertsql_cate.php">
                    <div class="col-md-12">
                        <div class=" row">
                            <label class="col-md-3 col-form-label">ข้อมูลหมวดหมู่สินค้า</label>
                            <div class="col-md-5">
                                <input class="form-control" name="category_name" type="text" id="html5-text-input" />
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mr-2">เพิ่มหมวดหมู่สินค้า</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ลำดับ</th>
                                    <th>ชื่อหมวดหมู่สินค้า</th>
                                    <th>เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row2 = mysqli_fetch_array($result2)) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?php echo  $row2['category_name'] ?></td>
                                        <td>
                                            <a href="?page=<?= $_GET['page'] ?>&function=update&category_id=<?= $row2['category_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>แก้ไข</a>
                                            <a href="?page=<?= $_GET['page'] ?>&function=delete_cate&category_id=<?= $row2['category_id'] ?>" onclick="return confirm('คุณต้องการลบหมวดหมู่สินค้านี้ : <?= $row2['category_name'] ?> หรือไม่ ??')" class="btn  view_data btn-danger text-white"><i class="fa-solid fa-rectangle-xmark "></i>ลบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <form method="POST" action="insertsql_type.php">
                    <div class="col-md-12">
                        <div class=" row">
                            <label class="col-md-3 col-form-label">ประเภทสินค้า</label>
                            <div class="col-md-5">
                                <input class="form-control" name="type_name" type="text" id="html5-text-input" />
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mr-2">เพิ่มประเภทสินค้า</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ลำดับ</th>
                                    <th>ชื่อประเภทสินค้า</th>
                                    <th>เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row0 = mysqli_fetch_array($result0)) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?php echo  $row0['type_name'] ?></td>
                                        <td>
                                            <a href="?page=<?= $_GET['page'] ?>&function=update&type_id=<?= $row0['type_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>แก้ไข</a>
                                            <a href="?page=<?= $_GET['page'] ?>&function=delete_type&type_id=<?= $row0['type_id'] ?>" onclick="return confirm('คุณต้องการลบหมวดหมู่สินค้าแยกตามอาการนี้ : <?= $row0['type_name'] ?> หรือไม่ ??')" class="btn  view_data btn-danger text-white"><i class="fa-solid fa-rectangle-xmark "></i>ลบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <form method="POST" action="insertsql_symp.php">
                    <div class="col-md-12">
                        <div class=" row">
                            <label class="col-md-3 col-form-label">แยกตามอาการ</label>
                            <div class="col-md-5">
                                <input class="form-control" name="symp_name" type="text" id="html5-text-input" />
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mr-2">เพิ่มแยกตามอาการ</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ลำดับ</th>
                                    <th>ชื่อหมวดหมู่สินค้า</th>
                                    <th>เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row3 = mysqli_fetch_array($result3)) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?php echo  $row3['symp_name'] ?></td>
                                        <td>
                                            <!-- <a href="?page=<?= $_GET['page'] ?>&function=detail&symp_id=<?= $row3['symp_id'] ?>" class="btn  btn-primary">รายละเอียด</a> -->
                                            <a href="?page=<?= $_GET['page'] ?>&function=update&symp_id=<?= $row3['symp_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>แก้ไข</a>
                                            <a href="?page=<?= $_GET['page'] ?>&function=delete_symp&symp_id=<?= $row3['symp_id'] ?>" onclick="return confirm('คุณต้องการลบหมวดหมู่สินค้าแยกตามอาการนี้ : <?= $row3['symp_name'] ?> หรือไม่ ??')" class="btn  view_data btn-danger text-white"><i class="fa-solid fa-rectangle-xmark "></i>ลบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <form method="POST" action="insertsql_unit.php">
                    <div class="col-md-12">
                        <div class=" row">
                            <label class="col-md-3 col-form-label">หน่วยนับ</label>
                            <div class="col-md-5">
                                <input class="form-control" name="unit_name" type="text" id="html5-text-input" />
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mr-2">เพิ่มหน่วยนับ</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>ลำดับ</th>
                                    <th>ชื่อหน่วยนับ</th>
                                    <th>เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row1 = mysqli_fetch_array($result1)) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?php echo  $row1['unit_name'] ?></td>
                                        <td>
                                            <a href="?page=<?= $_GET['page'] ?>&function=update&unit_id=<?= $row1['unit_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>แก้ไข</a>
                                            <a href="?page=<?= $_GET['page'] ?>&function=delete_unit&unit_id=<?= $row1['unit_id'] ?>" onclick="return confirm('คุณต้องการลบหมวดหมู่สินค้าแยกตามอาการนี้ : <?= $row1['unit_name'] ?> หรือไม่ ??')" class="btn  view_data btn-danger text-white"><i class="fa-solid fa-rectangle-xmark "></i>ลบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>