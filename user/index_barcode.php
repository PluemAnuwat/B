<?php
$sql = "SELECT * FROM view_product_detail  ";
$rp = mysqli_query($con, $sql);
?>
    <div class="row">
        <div class="col-md-12">
            <h2>พิมพ์บาร์โค้ด</h2>
        </div>
    </div>
    <hr />

<form method="post" action="indexsql_barcode.php">
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <th scope="col"></th>
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ฃื่อสินค้า</th>
                    <th scope="col">บาร์โค้ด</th>
                    <th scope="col">จำนวนบาร์โค้ด</th>
                    <th scope="col">Manager</th>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($rowp = mysqli_fetch_array($rp)) { ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><input autocomplete="OFF" type="product_id" class="form-control" id="product_id" name="product_id" value="<?= $rowp['product_id']?>"></a></td>
                            <td><input autocomplete="OFF" type="product_name" class="form-control" id="product_name" name="product_name" value="<?= $rowp['product_name']?>"></td>
                            <td><input autocomplete="OFF" type="product_barcode" class="form-control" id="product_barcode" name="product_barcode" value="<?= $rowp['product_barcode']?>"></a></td>
                            <td> <input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty" name="print_qty" required></td>
                            <td> <button class="btn btn-warning text-white" type="submit"><i class="fas fa-download me-2"></i>พิมพ์บาร์โค้ด</button></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</form>