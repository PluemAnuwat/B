<?php
require 'order.php' ;
$connect = mysqli_connect("localhost","root","akom2006","project");
$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 12);
$date = date("Y-m-d")
?>
<style>
    .buttonr{
        float: right;
    }
</style>
<form class="forms-sample" enctype="multipart/form-data" method="POST" action="insertsqlp.php">
    <div class="row">
        <div class="col-md-12">
            <h2>ยืนยันรายการสั่งซื้อ</h2>
        </div>
    </div>
    <hr />
    <div class="col-md-12">
        <?php require 'functionDateThai.php' ?>
        <div class="row">
            <div class="col-md-3">
                วันที่ออกเอกสาร
                <p><?php echo datethai($date) ?></p>
            </div>
            <div class="col-md-6">
                ซัพพลายเซน
                <select type="text" class="form-control" name="po_saler">
                    <?php
                    $sql = "SELECT * FROM suppiles ";
                    $query =  mysqli_query($connect, $sql);
                    foreach ($query as $data)  : ?>
                    <option value="<?= $data['suppiles_id'] ?>"><?= $data['suppiles_name']?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="col-md-3">
                เลขที่เอกสาร <span class="text-danger">จะป้อนอัตโนมัติ</span>
                <input type="text" class="form-control" type="text" name="po_RefNo" value="PO-<?= $s ?>">
            </div>

        </div>
        <br>
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
                <td class='text-end'>ราคา</td>
                <td class='text-end'>รวม(บาท)</td>
            </tr>
            <?php
            $i = 1;
            $product_total = 0;
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $product_quantity) {
            $sql  = "select * from product INNER JOIN product_price on product.product_id = product_price.product_id where product.product_id = '$product_id'";
            $query  = mysqli_query($connect, $sql);
            $row  = mysqli_fetch_array($query);
            $sum  = $row['product_price_cost'] * $product_quantity;
            $total += $sum;
            $vat = 0.07 * $total;
            $product_total = $total + $vat;
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>" . $product_quantity . "</td>";
            echo "<td class='text-end'>" . number_format($row['product_price_cost'], 2) . "</td>";
            echo "<td class='text-end'>" . number_format($sum, 2) . "</td>";
            echo "</tr>";
        }
        echo "<td colspan='4'><b>ราคารวม</b></td>";
        echo "<td class='text-end'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";

        echo "</tr>";
        echo "<td colspan='4'><b>ภาษี(7%)</b></td>";
        echo "<td class='text-end'>" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";

        echo "</tr>";
        echo "<td colspan='4'><b>ราคารวมภาษี</b></td>";
        echo "<td class='text-end'>" . "<b>" . number_format($product_total, 2) . "</b>" . "</td>";

        echo "</tr>";
        ?>
        </table>
        <input type="submit" name="Submit2" class="btn btn-success text-white buttonr m-2" value="ยืนยันการสั่งซื้อสินค้า" />
        <a class="btn btn-danger buttonr m-2" href='index.php?page=po&function=insert'>เปลี่ยนรายการ</a>
</form>