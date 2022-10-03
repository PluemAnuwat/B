<?php require 'indexsql_price.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>รายการกำหนดราคาทุน</h2>
    </div>
</div>
<hr />
<a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <form method="POST">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr class="text-nowrap">
                                <th>ลำดับ</th>
                                <th>บาร์โค้ด</th>
                                <th>ชื่อสินค้า</th>
                                <th>กำหนดราคาทุน</th>
                                <th>เมนู</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($row = mysqli_fetch_array($rp)) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td class="col-2"><a name="product_barcode[<?= $row['product_id'] ?>]"><?= $row['product_barcode'] ?></a></td>
                                    <td class="col-2"><a name="product_name[<?= $row['product_id'] ?>]"><?= $row['product_name'] ?></a></td>

                                    <td class="col-2">
                                        <input type="text" class="form-control" name="product_price_cost[<?= $row['product_id'] ?>]">
                                    </td>

                                    <td> <button  type="submit" name="save_one[<?= $row['product_id'] ?>]" type="submit" class="btn btn-success text-white"> บันทึกเฉพาะแถวนี้</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>