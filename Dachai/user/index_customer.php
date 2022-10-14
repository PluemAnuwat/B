<?php require 'indexsql_customer.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>หน้ารายการข้อมูลของลูกค้า</h2>
    </div>
</div>
<hr />
<div class="col-md-4">
<form action="?page=customer" method="post">
    ค้นหา <input type="text" name="search" class="form-control" placeholder="กรอกคำค้นหา">
    <hr>
    <input type="submit" value="ค้นหา" class="btn btn-success">
    <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill btn-primary">เพิ่มลูกค้า</a>
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
                            <th>รหัสลูกค้า</th>
                            <th>ชื่อ - นามสกุลลูกค้า</th>
                            <th>เบอร์โทรศัพท์ลูกค้า</th>
                            <th>ประวัติการรับยา</th>
                            <th>แพ้ยา</th>
                            <th>เมนู</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    isset( $_POST['search'] ) ? $search = $_POST['search'] : $search = "";
                    if( !empty( $search ) ) { 
                        $sql = " SELECT * FROM customer WHERE ( customer_name LIKE '%".$search."%' )";
                        $q = mysqli_query( $con, $sql ); 
                        while( $f = mysqli_fetch_assoc( $q ) ) { ?>
                         <tr>
                                <td><?php echo  $f['customer_id'] ?></td>
                                <td><?php echo  $f['customer_name'] ?> <?php echo  $f['customer_last'] ?></td>
                                <td><?php echo  $f['customer_phone'] ?></td>
                                <td><?php echo  $f['customer_drug'] ?></td>
                                <td><?php echo  $f['customer_his'] ?></td>
                                <td>
                                    <a href="?page=<?= $_GET['page'] ?>&function=detail&customer_id=<?= $f['customer_id'] ?>"> <i class="fa fa-file fa-3x" aria-hidden="true" value="Detail" style="color:"> </i></a>                   
                                    <a href="?page=<?= $_GET['page'] ?>&function=update&customer_id=<?= $f['customer_id'] ?>" ><i class="fa fa-pencil-square-o fa-3x" aria-hidden="true" style="color:green"></i></a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=delete&customer_id=<?= $f['customer_id'] ?>" ><i class="fa fa-trash-o fa-3x" aria-hidden="true" style="color:red"></i></a>
                                </td>
                            </tr>
                            <?php }
                              ?>
                        <?php } else {   ?>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?php echo  $row['customer_id'] ?></td>
                                <td><?php echo  $row['customer_name'] ?> <?php echo  $row['customer_last'] ?></td>
                                <td><?php echo  $row['customer_phone'] ?></td>
                                <td><?php echo  $row['customer_drug'] ?></td>
                                <td><?php echo  $row['customer_his'] ?></td>
                                <td>
                                    <a href="?page=<?= $_GET['page'] ?>&function=detail&customer_id=<?= $row['customer_id'] ?>"> <i class="fa fa-file fa-3x" aria-hidden="true" value="Detail" style="color:"> </i></a>                   
                                    <a href="?page=<?= $_GET['page'] ?>&function=update&customer_id=<?= $row['customer_id'] ?>" ><i class="fa fa-pencil-square-o fa-3x" aria-hidden="true" style="color:green"></i></a>
                                    <a href="?page=<?= $_GET['page'] ?>&function=delete&customer_id=<?= $row['customer_id'] ?>" ><i class="fa fa-trash-o fa-3x" aria-hidden="true" style="color:red"></i></a>
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