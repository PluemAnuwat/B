<?php require 'detail_insert_store.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>คิดเงิน</h2>
    </div>
</div>
<hr />
<form method="post" name="frm">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อสินค้า</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col" >ราคา</th>
                                <!-- <th scope="col">รวม</th> -->
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $product_total = 0;
                            $total = 0;
                            $i=1;
                            foreach ($_SESSION['storeing'] as $product_id => $product_quantity) {
                                $sql = "SELECT * from view_product_stock a where a.product_id = '$product_id'";
                                $query = mysqli_query($con, $sql);
                                $row = mysqli_fetch_array($query);
                                $sum = $row['product_price_sell'] * $product_quantity;
                                $total += $sum;
                                $vat = 0.07 * $total;
                                $product_total = $total + $vat;
                                echo "<tr>";
                                echo "<td>" . $i++ . "</td>";
                                echo "<td>" . $row["product_name"] . "</td>";
                                echo "<td>";
                                $date2 = new DateTime($row['product_end_date']);
                                $date1 = new DateTime(date('Y-m-d'));
                                $difference = $date2->diff($date1);
                                                               echo "<input type='text' class='form-control' name='amount[$product_id]' value='$product_quantity' size='2' readonly/></td>";
                                echo "<td >" . number_format($row["product_price_sell"], 2) . "</td>";
                                // echo "<td>" . number_format($sum, 2) . "</td>";
                                echo "</tr>";
                            }
                            echo "<td colspan='3'><b>ราคารวม</b></td>";
                            echo "<td>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                            
                            echo "</tr>";

                            ?>

                            <tr>
                                <td></td>
                                <td class="col-5">ภาษี (7%)</td>
                                <td></td>
                                <td><?php echo number_format($vat, 2) ?> </td>
                            
                            </tr>

                            <tr>
                                <td></td>
                                <td class="col-5">ราคาหลังรวมภาษี</td>
                                <td></td>
                                <td><?php echo number_format($product_total, 2) ?></td>
                             
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p>(<?php echo num2wordsThai(number_format($product_total, 2)) ?>)</p>
                             
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>   <label class="control-label" for="inputSuccess">ลูกค้า</label></td>
                                <td class="col-12" colspan="4">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                         
                                            <select type="text" class="form-control" id="exampleInputUsername1" name="customer_id">
                                                <?php
                                                $sql = "SELECT * FROM Customer ";
                                                $query = mysqli_query($con , $sql);
                                                foreach ($query as $dataunit) : ?>
                                                    <option value="<?= $dataunit['customer_id'] ?>"><?= $dataunit['customer_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                
                                <td></td>
                                <td>รับเงินมา</td>
                                <td class="col-2" colspan="4"> <input type="text" name="sales_get" onKeyUp="chk()" class="form-control"> </td>
                            </tr>

                            <tr>

                                <td></td>
                                <td>เงินทอน</td>
                                <td class="col-2" colspan="4"> <input type="text" name="sales_change" class="form-control"> </td>
                            </tr>


                        </tbody>

                    </table>
                    <br>
                    <input type="submit" class="btn btn-info text-white" value="ยืนยันการขาย" />
                </div>
            </div>
        </div>

        <input type="text" name="product_total" style="display: none;" onKeyUp="chk()" value="<?php echo ($product_total) ?>">


    </div>
</form>

<script language="JavaScript">
    function chk() {
        var a1 = parseFloat(document.frm.product_total.value);
        var a2 = parseFloat(document.frm.sales_get.value);
        document.frm.sales_change.value = a2 - a1; //---- เปลี่ยนเอาจะ + - * /

    }
</script>