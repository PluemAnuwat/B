<?php require 'indexsql_store.php' ?>
<?php include 'function_store.php' ?>
<form method="POST" id="form1" action="?page=store&functionn=update">
    <div class="row">
        <div class="col-md-12">
            <h2>ร้านค้า</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6">
            <a href="?page=store" type="button" class="btn btn-primary">ทั้งหมด</a>
            <?php while ($row = mysqli_fetch_assoc($query2)) {  ?>
                <a href="?page=<?= $_GET['page'] ?>&type_id=<?= $row['type_id'] ?>&type_name=<?= $row['type_name']; ?>" type="button" class="btn btn-primary"><?= $row['type_name']; ?></a>
            <?php } ?>
        </div>
        <div class="col-md-6">
            <a href="?page=<?= $_GET['page'] ?>&function=sell">กำหนดราคาขายของสินค้าถ้าไม่แสดงราคา</a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-5">
            <?php
            while ($row = mysqli_fetch_array($query)) {  
                // echo $query ; 
                // exit; ?>
                <?php
                $date = date('Y-m-d H:i:s'); ?>
                <div class="col-sm-4" style="margin-bottom:50px;">
                    <img src=".\image\<?= $row['product_img']; ?>" width="100" height="100">
                    <hr>
                    <?= $row['product_name']; ?> <br>
                    Qty : <?= $row['product_quantity']; ?> <?= $row['unit_name'] ?><br>
                    <?php
                    if ($row['product_quantity'] > 0 && $row['product_end_date'] < $date) { ?>
                        <a href="#" style="width:100%" class="btn btn-danger btn-sm disabled"> สินค้าเพียงพอ แต่หมดอายุ !!</a>
                    <?php } elseif ($row['product_quantity'] > 0 && $row['product_end_date'] > $date) { ?>
                        <a href='?page=<?= $_GET['page'] ?>&function=store&product_id=<?php echo $row['product_id'] ?>&functionn=addd' style="width:100%" class="btn btn-success btn-sm">เพิ่ม</a>
                    <?php } elseif ($row['product_quantity'] < 0 && $row['product_end_date'] < $date) { ?>
                        <a href="#" style="width:100%" class="btn btn-danger btn-sm disabled"> สินค้าไม่เพียงพอ แต่ไม่หมดอายุ</a>
                    <?php } else { ?>
                        <a href="#" style="width:100%" class="btn btn-danger btn-sm disabled"> สินค้าหมด !!</a>
                    <?php } ?>

                </div>
            <?php } ?>
        </div>
        <div class="col-md-7">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <tr>
                    <td>รายการ</td>
                    <td>จำนวน</td>
                    <td>ราคา</td>
                    <td>รวม(บาท)</td>
                    <td>เมนู</td>
                </tr>

                <?php
                $product_total = 0;
                $total = 0;

                foreach ($_SESSION['storeing'] as $product_id => $product_quantity) {
                    $sql = "SELECT * from view_product_stockv2 a where a.product_id = '$product_id'";
                    $query = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($query);
                    $sum = $row['product_price_sell'] * $product_quantity;
                    $total += $sum;
                    $vat = 0.07 * $total;
                    $product_total = $total + $vat;
                    echo "<tr>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>";
                    $date2 = new DateTime($row['product_end_date']);
                    $date1 = new DateTime(date('Y-m-d'));
                    $difference = $date2->diff($date1);
                    if (@$_POST['amount'][@$row['product_id']] > @$row['product_quantity']) {
                        echo "<div class='text-danger'>จำนวนไม่เพียงพอ</div>";
                    } else {
                        echo "<div class='text-success'>สินค้าเพียงพอ</div>";
                    }
                    echo "<input type='text' class='form-control' name='amount[$product_id]' value='$product_quantity' size='2'/></td>";
                    echo "<td >" . number_format($row["product_price_sell"], 2) . "</td>";
                    echo "<td>" . number_format($sum, 2) . "</td>";

                    echo "<td><a href='?page=store&product_id=$product_id&functionn=remove' class='btn btn-danger'>ลบ</a></td>";
                    echo "</tr>";
                    }
                // }
                echo "<td colspan='3'><b>ราคารวม</b></td>";
                echo "<td>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                echo "<td ></td>";
                echo "</tr>";


                ?>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-warning btn-rounded" value="ปรับปรุงราคาใหม่"></input>
                    <input class="btn btn-success btn-rounded" value="ยืนยันการขาย" onclick="window.location='?page=store&function=confirm';"></input>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php require 'function_Cal.php' ?>
    <script>
        function submitForm(action) {
            document.getElementById('form1').action = action;
        }
    </script>
</form>