<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>
<?php
if (isset($_GET['good_RefNo']) && !empty($_GET['good_RefNo'])) {
  $good_RefNo = $_GET['good_RefNo'];
  $sql = "SELECT *  , sum(c.product_price_cost * a.product_quantity ) as qty ,
  sum(c.product_price_cost )  as sum ,
  sum(c.product_price_cost * a.product_quantity ) * 0.07 + sum(c.product_price_cost * a.product_quantity ) as vat ,
  sum(c.product_price_cost * a.product_quantity ) * 0.07 as vatt
   ,(c.product_price_cost * a.product_quantity) as plusel 
FROM  goods_detailproduct a JOIN product_price c ON a.product_id = c.product_id";
  $query = mysqli_query($connect, $sql);
  $result1 = mysqli_fetch_array($query);
}
?>

<form class="forms-sample" enctype="multipart/form-data" method="POST" action="?page=manager_goods_test&function=insert">
<a href=javascript:history.back(1)><img src="../images/back1.png" width="60px"></a>
    <button style="border:none;" class="mr-2"><img src="../images/yes.png" width="60px;"></button>
    <table class="table table-hover table-bordered text-center" id="">
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
                       $sql = "SELECT *
                       ,(d.product_price_cost * a.product_quantity) as plusel ,
                        a.product_quantity AS product_qty 
                        FROM   goods_detailproduct a join goods aaa ON a.goods_detailproid = aaa.good_id    
                        JOIN product b ON a.product_id = b.product_id 
                        JOIN product_price d ON a.product_id = d.product_id 
                        WHERE aaa.good_RefNo = '$good_RefNo'";
                   
                   
                //    $sql = "SELECT  a.* 
                //     --  , (d.product_price_cost * a.product_quantity) as plusel , a.product_quantity AS product_qty 
                //     FROM   goods_detailproduct a 
                //     JOIN goods aaa ON a.goods_detailproid = aaa.good_id
                //     JOIN product b ON a.product_id = b.product_id
                //     JOIN product_price d ON a.product_id = d.product_id
                //     JOIN product_quantity c ON a.product_id = c.product_id
                //     WHERE aaa.good_RefNo = '$good_RefNo'
                //     ";
                    // echo '<pre>'.print_r($sql, 1).'</pre>';
                    $query = mysqli_query($connect, $sql);
                    while ($rowp = mysqli_fetch_assoc($query)) {
                    ?>
            <tr>
                <input type="hidden" name="good_RefNo[]" value="<?= $rowp['good_RefNo']?>">
                <td class="col-1"> <input type="hidden" name="product_id[]"
                        value="<?= $rowp['product_id'] ?>"><?php echo $rowp['product_id'] ?></td>
                <td class="col-2"><a name="product_name[$product_id]"><?= $rowp['product_name'] ?></a></td>
                <td class="col-1"><input type='datetime-local' class='form-control' name="product_start_date[]" /></td>
                <td class="col-0"><input type='datetime-local' class='form-control' name="product_end_date[]" /></td>
                <td class="col-1"><input type="hidden" name="product_quantity[]"
                        value="<?= $result1['product_quantity'] ?>"><?php echo  $result1['product_quantity'] ?></td>
                <td class="col-1"><input type="hidden" name="product_price_cost[]"
                        value="<?= $rowp['product_price_cost'] ?>"><?php echo  number_format($rowp['product_price_cost'],2) ?></td>
                </td>
                <td class="col-1"><?php echo  number_format($rowp['plusel'],2) ?></td>
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
</form>