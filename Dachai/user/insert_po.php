<?php require 'function_po.php' ?>
<form method="POST" action="?page=po&function=insert&fuction=update">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        เลือกรายการสินค้า
    </button>
    <input type="submit" class="btn btn-warning btn-rounded" value="ปรับปรุงราคาใหม่"></input>
    <input class="btn btn-success btn-rounded" value="คอนเฟิร์มใบสั่งซื้อ" onclick="window.location='?page=po&function=confirm';"></input>
    <hr>
    <table class="table table-striped table-bordered table-hover" style="max-width: 60%;">
        <tr>
            <td>ลำดับ</td>
            <td>รายการ</td>
            <td>จำนวน</td>
            <td>ราคา</td>
            <td>รวม(บาท)</td>
            <td>ลบรายการสินค้า</td>
        </tr>
        <?php
        $product_total = 0;
        $total = 0;
        $i = 1;
        if (!empty($_SESSION['carting'])) {
            foreach ($_SESSION['carting'] as $product_id => $product_quantity) {
                $sql = "SELECT * from view_product_detail a JOIN view_product_quantity b on a.product_id = b.product_id 
                                    join view_product_price c on a.product_id = c.product_id where a.product_id = '$product_id'";
                $query = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($query);
                $sum = $row['product_price_cost'] * $product_quantity;
                $total += $sum;
                $vat = 0.07 * $total;
                $product_total = $total + $vat;
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td >" . $row["product_name"] . "</td>";
                echo "<td >";
                echo "<input type='text' class='form-control' name='amount[$product_id]' value='$product_quantity' size='2'/></td>";
                echo "<td >" . number_format($row["product_price_cost"], 2) . "</td>";
                echo "<td>" . number_format($sum, 2) . "</td>";
                //remove product
                echo "<td><a href='?page=po&function=insert&product_id=$product_id&fuction=remove' class='btn btn-danger'>ไม่เลือกรายการนี้</a></td>";
                echo "</tr>";
            }
            echo "<td colspan='4'><b>ราคารวม</b></td>";
            echo "<td>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
            echo "<td ></td>";
            echo "</tr>";
            echo "<td colspan='4'><b>ภาษี</b></td>";
            echo "<td>" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";
            echo "<td ></td>";
            echo "</tr>";
            echo "<td colspan='4' class='bg-warning text-white'><b>ราคารวม(รวมภาษี)</b></td>";
            echo "<td class='bg-warning text-white'>" . "<b>" . number_format($product_total, 2) . "</b>" . "</td>";
            echo "<td class='bg-warning text-white'></td>";
            echo "</tr>";
        }
        ?>
    </table>
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายการสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $sql = "SELECT * from view_product_quantity a join view_product_price b on a.product_id = b.product_id WHERE b.product_price_cost <> 0 ";
                $result = mysqli_query($con, $sql);
                if ($count = mysqli_num_rows($result) < 1) {
                    echo '<p class="text-danger">กรุณากำหนดราคาทุนของสินค้าก่อนนะครับ<a href="?page=price">คลิกไปหน้ากำหนดราคาทุน</a></p>';
                }
                ?>
                <table class="table table-hover" id="tableall">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รูป</th>
                            <th>รายการสินค้า</th>
                            <th>จำนวนสินค้าคงเหลือ</th>
                            <th>ราคาทุน</th>
                            <th>เมนูการจัดการ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><img src=".\image\<?= $row['product_img']; ?>" width="150" height="150"></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td><?php echo $row['product_quantity'] ?></td>
                                <td><?php echo $row['product_price_cost'] ?></td>
                                <td><a class="btn btn-primary" href='?page=<?= $_GET['page'] ?>&function=insert&product_id=<?php echo $row['product_id'] ?>&fuction=add'> เพิ่มลงใบสั่งซื้อ </a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                <button type="button" class="btn btn-primary">เลือกรายการนี้</button>
            </div>
        </div>
    </div>
</div>