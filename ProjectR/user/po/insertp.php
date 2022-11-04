<?php
$connect = mysqli_connect("localhost","root","akom2006","project");
// mysqli_select_db("project");
$strSQL = "SELECT * FROM product INNER JOIN product_quantity ON product.product_id = product_quantity.product_id 
INNER JOIN unit ON product.product_unit = unit.unit_id";
$objQuery = mysqli_query($connect , $strSQL)  or die(mysqli_error());
?>

<?php
session_start();
?>

<form action="insertsqlp.php" method="post">

<button type="button"  class="btn rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
<img src="../images/list.png" width="30px" height="30px">
<p>รายการสินค้า</p>
</button>
    <button onclick="return confirm('ต้องการสั่งซื้อหรือไม่ ??')" type="submit"  class="btn rounded-pill"  name="Submit" value="Submit"><img src="../images/check.png" width="30px" height="30px">
    <p>ยืนยันการสั่งซื้อ</p>   
</button>
<!-- <a  href="insertsqlp.php" class="btn" style="border:none;"><img src="../images/check11.png" width="7%"></a > -->

<hr>




<style>
    .modal {
  background: gray;
  position: absolute;
  float: left;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
</style>




<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวนสินค้า</th>
                            <th>ลงรายการสั่งซื้อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                      ?>
                        <tr>
                            <td><?php echo $objResult["product_name"];?></td>
                            <td class="text-center"><?php echo $objResult["product_quantity"];?>    <?php echo $objResult["unit_name"] ; ?></td>
                            <td><a href="order.php?product_id=<?php echo $objResult["product_id"];?>"><img src="../images/check.png" width="10%"></a></td>
                        </tr>
                        <?php
  }
  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>













<?php

if(isset($_SESSION["intLine4000"]))
{
}
$connect = mysqli_connect("localhost","root","akom2006","project");
?>

<?php 
$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 12);
 $date = date('Y-m-d H:i:s');
 require '../functionDateThai.php'; 
 ?>


<div class="row">
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
        เลขที่เอกสาร  <span class="text-danger">จะป้อนอัตโนมัติ</span>
        <input type="text" class="form-control" type="text" name="po_RefNo" value="PO-<?= $s ?>">
    </div>
    <div class="col-md-3">
        วันที่ออกเอกสาร
        <p><?php echo datethai($date) ?></p>
    </div>
</div>

<br>
<table class="table table-bordered">
    <tr>
        <th>ผู้สั่งซื้อ</th>
    </tr>
    <tr>
        <td><?= $_SESSION['posit_login']?> </td>
    </tr>
</table>

    <table class="table table-bordered table-striped">
        <tr class="bg-secondary text-white">
            <th>รหัสสินค้า</th>
            <th>รายการสินค้า</th>
            <th>ราคาต่อหน่วย</th>
            <th>จำนวน</th>
            <th>จำนวนเงิน</th>
            <th></th>
        </tr>


        <?php
$Total = 0;
$SumTotal = 0;


for($i=0;$i<=(int)$_SESSION["intLine4000"];$i++)
{ ?>


        <?php
  if($_SESSION["strProductID4000"][$i] != "")
  {
  $strSQL = "SELECT * FROM product a JOIN product_price b ON a.product_id = b.product_id WHERE a.product_id = '".$_SESSION["strProductID4000"][$i]."' ";
  $objQuery = mysqli_query($connect , $strSQL)  or die(mysqli_error());
  $objResult = mysqli_fetch_array($objQuery);
  $Total = $_SESSION["strQty"][$i] * $objResult["product_price_cost"];
  $SumTotal = $SumTotal + $Total;
  ?>
        <tr>
            <td class="col-2"><?php echo $_SESSION["strProductID4000"][$i];?></td>
            <td class="col-4"><?php echo $objResult["product_name"];?></td>
            <td class="col-2 text-end"><?php echo number_format($objResult["product_price_cost"],2);?></td>
            <td class="col-1 text-end"><?php echo $_SESSION["strQty"][$i];?></td>
            <td class="col-1 text-end"><?php echo number_format($Total,2);?></td>
            <td><a href="delete.php?Line=<?php echo $i;?>"><img src="../images/remove.png" width="10%"></a></td>
        </tr>

        <?php
  }
}
?>
        <tr>
            <td colspan="3"></td>
            <td class="text-center">รวม</td>
            <td class="text-end"><?php echo number_format($SumTotal,2);?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="text-center">ภาษี<input class="form-control text-end" value="7%" disabled></td>
            <td class="text-end"><?php echo number_format($SumTotal * 0.07,2) ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="text-center">รวมทั้งสิ้น</td>
            <td class="text-end" name="product_total"><?php echo number_format(($SumTotal * 0.07) + $SumTotal,2) ?></td>
            <td></td>
        </tr>
    </table>
   

</form>














<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง_MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });
    $('#example').DataTable();

    $('#example')
        .removeClass('display')
        .addClass('table table-bordered');
});
</script>