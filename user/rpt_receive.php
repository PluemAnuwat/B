<?php
$sql = " SELECT * FROM sales a left join customer b ON a.customer_id = b.customer_id ";
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_assoc($query);
$date = date('Y-m-d , H:i:s');
?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <p>ร้านขายยาดาชัย์</p>
                </h4>
            </div>
            <div class="modal-body">
                <p align="center">ใบเสร็จรับเงิน</p>
                <div class="col-md-6">
                    <div class="row">
                        <p>รหัสลูกค้า : <?php echo $result['customer_id']; ?></p>
                        <p>ชื่อลูกค้า : <?php echo $result['customer_name'], $result['customer_last'] ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <p>หมายเลขใบเสร็จ : <?php echo $result['sales_RefNo']; ?></p>
                        <p>วันที่ออกใบเสร็จ : <?php echo  $date ?></p>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">รายการ</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">หน่วย</th>
                            <th scope="col">ราคาต่อหน่วย</th>
                            <th scope="col">ราคารวม</th>
                        </tr>
                    </thead>
                    <?php
                    $product_total = 0;
                    $total = 0;
                    $i = 1;
                    foreach ($_SESSION['storeing'] as $product_id => $product_quantity) { 
                        ?>
                        <?php
                        $sql = "SELECT * from view_product_stock a where a.product_id = '$product_id'";
                        $query = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($query);
                        $sum = $row['product_price_sell'] * $product_quantity;
                        $total += $sum;
                        $vat = 0.07 * $total;
                        $product_total = $total + $vat;
                        ?>          
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td><?php echo $row['product_id'] ?></td>
                                <td><input type="text" class="form-control" name="amount[$product_id]" value="<?php echo $product_quantity ?>" size="1" style="width:50px" readonly/></td>
                                <td><?php echo $row['unit_name'] ?></td>
                                <td><?php echo number_format($row['product_price_sell'],2) ?></td>
                                <td><?php echo number_format($sum,2) ?></td>
                            </tr>
                            <tr>
                        </tbody>
                        <?php } ?>
                        <footer>
                            <tr>
                                <td><?php echo num2wordsThai(number_format($product_total,2))?></td>
                            <td colspan="4" align="right">ราคารวม</td>
                            <td><?php echo number_format($total,2) ?></td>
                            </tr>
                    <tr>
                    <td colspan="5" align="right">ภาษี</td>
                            <td><?php echo number_format($vat,2) ?></td>
                    </tr>
                    <tr>
                    <td colspan="5" align="right">รวมทั้งหมด</td>
                            <td><?php echo number_format($product_total,2) ?></td>
                    </tr>
                        </footer>
                </table>
            <!-- echo "<tr>";
                                echo "<td>" . $i++ . "</td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>" . "<input type='text' class='form-control' name='amount[$product_id]' value='$product_quantity' size='1' style='width:50px' readonly/></td>";
                                echo "<td >" . number_format($row["product_price_sell"], 2) . "</td>";
                                echo "</tr>";
                            }
                            echo "<td colspan='3'><b>ราคารวม</b></td>";
                            echo "<td>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                            
                            echo "</tr>";

                            ?> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</div>