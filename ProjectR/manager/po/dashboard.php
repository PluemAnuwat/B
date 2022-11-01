<style>
.bgc {
    background-color: brown;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>

<?php $sql ="SELECT * FROM product";
      $result = mysqli_query($connect , $sql);
?>

<div class="row">


    <div class="col-md-4">
        <table class="table table-hover" id="example">
            <thead>
                <tr>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">จำนวน</th>
                    <th scope="col">เมนู</th>
                </tr>
            </thead>
            <tbody>
                <?php 
    while ($row = mysqli_fetch_array($result)) { ?>
                <td class="col-2"><?php echo  ($row['product_name']) ?></td>
                <td class="col-2"><?php echo  ($row['product_quantity']) ?></td>
                <td><a href="order.php?product_id=<?php echo $row["product_id"];?>">ลงรายการใบสั่งซื้อ</a></td>

                <?php } ?>
            </tbody>
        </table>
    </div>



    <?php
session_start();

if(!isset($_SESSION["intLine30"]))
{
	echo "Cart empty";
	exit();
}

mysql_connect("localhost","root","akom2006");
mysql_select_db("project");

?>

    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <td>ลำดับ</td>
                <td>รหัสสินค้า</td>
                <td>ชื่อสินค้า</td>
                <td>หน่วยนับ</td>
                <td>จำนวน</td>
                <td>ราคา/หน่วย</td>
                <td>จำนวนเงิน</td>
                <td>ลบ</td>
            </tr>
            <?php
  $Total = 0;
  $SumTotal = 0;
  $i = 0 ; 
  for($i=0;$i<=(int)$_SESSION["intLine30"];$i++)
  {
	  if($_SESSION["strProductID30"][$i] != "")
	  {
		$strSQL = "SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID30"][$i]."' ";
		$objQuery = mysql_query($strSQL)  or die(mysql_error());
		$objResult = mysql_fetch_array($objQuery);
		$Total = $_SESSION["strQty"][$i] * $objResult["Price"];
		$SumTotal = $SumTotal + $Total;
	  ?>
            <tr>
                <td><?php echo $i++ ;?></td>
                <td><?php echo $_SESSION["strProductID30"][$i];?></td>
                <td><?php echo $objResult["product_name"];?></td>
                <td><?php echo $objResult["Price"];?></td>
                <td><?php echo $_SESSION["strQty"][$i];?></td>
                <td><?php echo number_format($Total,2);?></td>
                <td><a href="delete.php?Line=<?php echo $i;?>">x</a></td>
            </tr>
            <?php
	  }
  }
  ?>
        </table>
    </div>
</div>
















































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