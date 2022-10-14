<?php require 'indexsql_sell_product.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>กำหนดราคาขาย</h2>
    </div>
</div>
<hr />
<a class="btn btn-danger rounded-pill" href="?page=store">ย้อนกลับ</a>
<hr />
<form action="" method="post">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="text-nowrap">
                <th>ลำดับ</th>
                <th>บาร์โค้ด</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาทุน</th>
                <th>กำหนดราคาขาย</th>
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
                    <td class="col-2"><a name="product_price_cost[<?= $row['product_id'] ?>]"><?= $row['product_price_cost'] ?></a></td>
                    <td class="col-2">
                        <input type="text" class="form-control" name="product_price_sell[<?= $row['product_id'] ?>]">
                    </td>

                    <td> <button style="background-color:purple;" type="submit" name="save_one[<?= $row['product_id'] ?>]" type="submit" class="btn btn-primary text-white"><i class="fa-solid fa-address-book"></i> บันทึกเฉพาะแถวนี้</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</form>