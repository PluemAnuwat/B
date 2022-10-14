<?php require 'detailsql_good.php' ?>
<form class="forms-sample" enctype="multipart/form-data" method="POST" action="?page=good&function=insert">


    <div class="row">
        <div class="col-md-12">
            <h2>รายละเอียด</h2>
        </div>
    </div>
    <hr>
    <button class="btn btn-primary mr-2">ยืนยันการส่งสินค้า</button>
    <!-- <a  class="btn btn-primary" href="?page=<?= $_GET['page'] ?>&function=rptdetail&good_RefNo=<?php echo  $result1['good_RefNo'] ?>">PDF</a> -->
    <hr>
    <div class="col-md-12">
        <div class="panel panel-default">
            <table class="table table-hover text-center" id="">
                <tr>
                    <td colspan="7">
                        <strong>รายการสินค้า</strong>
                    </td>
                </tr>
                <tr>
                    <td>รหัสสินค้า</td>
                    <td>ชื่อสินค้า</td>
                    <td>วันที่ผลิต</td>
                    <td>วันหมดอายุ</td>
                    <td>จำนวน</td>
                    <td>จำนวน</td>
                    <td>ราคา</td>
                </tr>
                <tbody>
                    <?php
                    $sql = "SELECT *  ,(c.product_price_cost * a.product_quantity) as plusel   FROM view_good_show a left join view_product_detail b on 
                                 a.product_id = b.product_id left join view_product_price c on a.product_id = c.product_id  WHERE a.good_RefNo = '$good_RefNo'";
                    $query = mysqli_query($con, $sql);
                    while ($rowp = mysqli_fetch_assoc($query)) {

                    ?>
                        <tr>
                            <input type="hidden" name="good_RefNo[]" value="<?= $rowp['good_RefNo'] ?>">
                            <td class="col-1"> <input type="hidden" name="product_id[]" value="<?= $rowp['product_id'] ?>"><?php echo $rowp['product_id'] ?></td>
                            <td class="col-2"><a name="product_name[$product_id]"><?= $rowp['product_name'] ?></a></td>
                            <td class="col-1"><input type='datetime-local' class='form-control' name="product_start_date[]" /></td>
                            <td class="col-0"><input type='datetime-local' class='form-control' name="product_end_date[]" /></td>
                            <td class="col-1"><input type="hidden" name="product_quantity[]" value="<?= $rowp['product_quantity'] ?>"><?php echo  $rowp['product_quantity'] ?></td>
                            <td class="col-1"><input type="hidden" name="product_price_cost[]" value="<?= $rowp['product_price_cost'] ?>"><?php echo  $rowp['product_price_cost'] ?></td>
                            </td>
                            <td class="col-1"><?php echo  $rowp['plusel'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tr>
                    <td colspan="5"></td>
                    <td>ราคารวม</td>
                    <td><?php echo number_format($result1['qty'], 2) ?></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td>ภาษี(7%)</td>
                    <td><?php echo number_format($result1['vatt'], 2) ?> บาท</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td>ราคารวมภาษี</td>
                    <td><?php echo number_format($result1['vat'], 2) ?> บาท</td>
                </tr>
            </table>
        </div>
    </div>
</form>