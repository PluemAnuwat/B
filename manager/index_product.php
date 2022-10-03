<?php require 'indexsql_product.php' ?>

<div class="row">
    <div class="col-md-12">
        <h2>หน้ารายการข้อมูลของสินค้า</h2>
    </div>
</div>
<hr />
<form action="?page=product" method="post">
    ค้นหา <input type="text" name="search" class="form-control" placeholder="กรอกคำค้นหา">
    <hr>
    <input type="submit" value="ค้นหา" class="btn btn-success">
    <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill btn-primary">เพิ่มสินค้า</a>
<a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
</form>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr class="text-nowrap">
                            <th>รูปภาพ</th>
                            <th>ชื่อสินค้า</th>
                            <th>หน่วยนับสินค้า</th>
                            <th>ประเภทสินค้า</th>
                            <th>ราคาทุน</th>
                            <th>เมนู</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    isset( $_POST['search'] ) ? $search = $_POST['search'] : $search = "";
                    if( !empty( $search ) ) { 
                        $sql = " SELECT * FROM view_product_detail a left join view_product_price b on a.product_id = b.product_id WHERE ( a.product_name LIKE '%".$search."%' )";
                        $q = mysqli_query( $con, $sql ); 
                        while( $row = mysqli_fetch_assoc( $q ) ) { ?>
 <tr>
                                <td><img src=".\image\<?= $row['product_img']; ?>" width="100" height="100"></td>
                                <td><?php echo  $row['product_name'] ?></td>
                                <td><?php echo  $row['unit_name'] ?></td>
                                <td><?php echo  $row['type_name'] ?></td>
                                <td><?php echo  number_format($row['product_price_cost'],2) ?></td>
                                <td>
                                    <a href="?page=<?= $_GET['page'] ?>&function=detail&product_id=<?= $row['product_id'] ?>" class="btn  btn-primary">Details</a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=update&product_id=<?= $row['product_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>Modify</a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=delete&product_id=<?= $row['product_id'] ?>" class="btn  btn-danger  text-white" onclick="return confirm('ยืนยันการลบข้อมูล')"><i class="fa-solid fa-rectangle-xmark "></i>Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } else {   ?>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_array($result)) { ?>
 <tr>
                                <td><img src=".\image\<?= $row['product_img']; ?>" width="100" height="100"></td>
                                <td><?php echo  $row['product_name'] ?></td>
                                <td><?php echo  $row['unit_name'] ?></td>
                                <td><?php echo  $row['type_name'] ?></td>
                                <td><?php echo  number_format($row['product_price_cost'],2) ?></td>
                                <td>
                                    <a href="?page=<?= $_GET['page'] ?>&function=detail&product_id=<?= $row['product_id'] ?>" class="btn  btn-primary">Details</a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=update&product_id=<?= $row['product_id'] ?>" class="btn  btn-warning text-white"><i class="fa-solid fa-keyboard"></i>Modify</a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=delete&product_id=<?= $row['product_id'] ?>" class="btn  btn-danger  text-white" onclick="return confirm('ยืนยันการลบข้อมูล')"><i class="fa-solid fa-rectangle-xmark "></i>Delete</a>
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