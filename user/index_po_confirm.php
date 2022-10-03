<?php require 'indexsql_po_confirm.php' ?>
<?php
$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 12);
$date = date("Y-m-d")
?>

<form class="forms-sample" enctype="multipart/form-data" method="POST">
    <div class="row">
        <div class="col-md-12">
            <h2>ยืนยันรายการสั่งซื้อ</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <label class="col-md-2">หมายเลขเอกสารใบสั่งซื้อ</label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="po_RefNo" value="PO-<?= $s ?>" />
            </div>
            <label class="col-md-2">วันที่ออกใบสั่งซื้อ</label>
            <div class="col-md-4">
                <input class="form-control" type="datetime-local" value="<?= $date ?>" name="po_create" />
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label class="col-md-2">ชื่อผู้ขาย / บริษัท</label>
            <div class="col-md-4">
                <select type="text" class="form-control" id="exampleInputUsername1" name="po_saler">
                    <?php
                    $sql = "SELECT * FROM partner ";
                    $query =  mysqli_query($con, $sql);
                    foreach ($query as $data) : ?>
                        <option value="<?= $data['partner_id'] ?>"><?= $data['partner_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <hr />
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <tr>
            <td colspan="7 ">
                <strong>รายการใบสั่งซื้อ</strong>
            </td>
        </tr>
        <tr>
            <td>ลำดับ</td>
            <td>รหัสสินค้า / รายละเอียด</td>
            <td>จำนวน</td>
            <td>หน่วยละ</td>
            <!-- <td>วันที่ผลิต</td>
                                <td>วันที่หมดอายุ</td> -->
            <td>ราคา</td>
            <td>รวม(บาท)</td>
        </tr>
        <?php
        $i = 1;
        $product_total = 0;
        $total = 0;
        foreach ($_SESSION['carting'] as $product_id => $product_quantity) {
            $sql  = "select * from view_product_detail a JOIN view_product_quantity b on a.product_id = b.product_id 
                                join view_product_price c on a.product_id = c.product_id where a.product_id = '$product_id'";
            $query  = mysqli_query($con, $sql);
            $row  = mysqli_fetch_array($query);
            $sum  = $row['product_price_cost'] * $product_quantity;
            $total += $sum;
            $vat = 0.07 * $total;
            $product_total = $total + $vat;
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>" . $product_quantity . "</td>";
            echo "<td>" . $row['unit_name'] . "</td>";
            // echo "<td >";
            // echo "<input type='datetime-local' id='date2' class='form-control'  name='product_start_date[$product_id]' /></td>";
            // echo "<td >";
            // echo "<input type='datetime-local' id='date3' class='form-control' name='product_end_date[$product_id]'/></td>";
            echo "<td>" . number_format($row['product_price_cost'], 2) . "</td>";
            echo "<td>" . number_format($sum, 2) . "</td>";
            echo "</tr>";
        }
        echo "<td colspan='5'><b>ราคารวม</b></td>";
        echo "<td>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";

        echo "</tr>";
        echo "<td colspan='5'><b>ภาษี(7%)</b></td>";
        echo "<td>" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";

        echo "</tr>";
        echo "<td colspan='5'><b>ราคารวมภาษี</b></td>";
        echo "<td>" . "<b>" . number_format($product_total, 2) . "</b>" . "</td>";

        echo "</tr>";
        ?>
    </table>
    <input type="submit" name="Submit2" class="btn btn-success text-white" value="ยืนยันการสั่งซื้อสินค้า" />
    <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>เปลี่ยนรายการ</a>
</form>