<?php
require '../functionDateThai.php'; 
require 'convert.php'; 
$connect = mysqli_connect("localhost", "root", "akom2006", "project"); 
if (isset($_GET['po_RefNo']) && !empty($_GET['po_RefNo'])) {
     $po_RefNo = $_GET['po_RefNo'];
     $sql = "SELECT * ,(cc.product_price_cost * aa.product_quantity) as plusel 
     FROM po a join po_detailproduct aa ON a.po_id = aa.po_id JOIN product b ON aa.product_id = b.product_id 
    join product c on aa.product_id = c.product_id JOIN product_price cc ON c.product_id = cc.product_id
      WHERE a.po_RefNo = '$po_RefNo'";
      $query = mysqli_query($connect, $sql);
      $resultq = mysqli_num_rows($query);

      $sql1 = "SELECT * , sum(cc.product_price_cost * aa.product_quantity ) as qty ,
      sum(cc.product_price_cost )  as sum ,
      sum(cc.product_price_cost * aa.product_quantity ) * 0.07 + sum(cc.product_price_cost * aa.product_quantity ) as vat ,
      sum(cc.product_price_cost * aa.product_quantity ) * 0.07 as vatt
      FROM po a join po_detailproduct aa ON a.po_id = aa.po_id  join product b ON aa.product_id = b.product_id 
     join product c on aa.product_id = c.product_id  JOIN product_price cc ON c.product_id = cc.product_id 
       WHERE a.po_RefNo = '$po_RefNo'";
  $query1 = mysqli_query($connect, $sql1);
  $result1 = mysqli_fetch_assoc($query1);
  $po_create = $result1['po_create'];
  $po_status = $result1['po_status'];
  
  $sql2 = "SELECT * FROM po_status    WHERE po_RefNo = '$po_RefNo' group by po_RefNo"; 
  $query2 = mysqli_query($connect , $sql2);
  $result2 = mysqli_num_rows($query2);
}
?>


<!-- <a  class="btn btn-primary" href="?page=<?= $_GET['page'] ?>&function=reportp&po_RefNo=<?php echo  $result1['po_RefNo'] ?>">PDF</a> -->
<a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
<button type="button" style="border:none;"  onClick="window.print()"><img src="../images/printer.png" width="80px;"></button>
<hr>
<div class="card">
    <div class="card-body">

        <div>ร้านขายยาดาชัย์</div>
        <div>เลขที่  286/3 เขต มีนบุรี เเขวง จังหวัด กรุงเทพมหานคร</div>

        <br>

        <center>
            <h3>รายการใบสั่งซื้อ หมายเลข : <?php echo $po_RefNo ?> </h3>
        </center>
        <p>ผู้สั่งซื้อ : <?php echo $result1['po_buyer'] ?> </p>
        <p>วันที่สั่งซื้อ : <?php echo datethai($po_create) ?></p>




        <table class="table table-bordered " border="3">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รายการสินค้า</th>
                    <th style="text-align: right;" scope="col">จำนวน</th>
                    <th style="text-align: right;" scope="col">ราคา</th>
                    <th style="text-align: right;" scope="col">ราคาทั้งสิ้น</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td class="col-2"><?php echo  $i++  ?></td>
                    <td class="col-2"><?php echo  $row['product_name'] ?></td>
                    <td class="col-2" style="text-align: right;"><?php echo  $row['product_quantity'] ?></td>
                    <td class="col-2" style="text-align: right;">
                        <?php echo  number_format($row['product_price_cost'], 2) ?></td>
                    <td class="col-2" style="text-align: right;"><?php echo  number_format($row['plusel'], 2) ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right;">ราคารวม</td>
                    <td style="text-align: right;"><?php echo number_format($result1['qty'], 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right;">ภาษี(7%)</td>
                    <td style="text-align: right;"><?php echo number_format($result1['vatt'], 2) ?> บาท</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right;">ราคารวมภาษี</td>
                    <td style="text-align: right;"><?php echo number_format($result1['vat'], 2) ?> บาท</td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo convert(number_format($result1['vat'], 2)) ?> </td>
                    <td ></td>
                    <td ></td>
                </tr>
            </tbody>
     
        </table>
       <center>
       <a>ผู้สั่งซื้อ____________________________________________</a>
       </center>
       
       
    
    </div>
</div>
