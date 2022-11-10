<?php
session_start(); 
?>
<?php 
require 'order.php' ;
$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 12);
 $date = date('Y-m-d H:i:s');
 require 'functionDateThai.php'; 
 ?>

<?php
$connect = mysqli_connect("localhost","root","akom2006","project");
$strSQL = "SELECT * FROM product 
  INNER JOIN product_reorder  ON product.product_id = product_reorder.product_id
INNER JOIN unit ON product.product_unit = unit.unit_id";
$objQuery = mysqli_query($connect , $strSQL)  or die(mysqli_error());
?>
<form method="POST" action="?page=po&function=insert&act=update">
    <div class="row">
        <div class="col-md-5">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวนสินค้า</th>
                        <th>จุดสั่งซื้อ</th>
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
                        <td class="text-center"><?php echo $objResult["product_quantity"];?>
                            <?php echo $objResult["unit_name"] ; ?></td>
                        <td class="text-center"><?php echo $objResult["point"];?></td>
                        <td><a
                                href="?page=<?= $_GET['page'] ?>&function=insert&product_id=<?php echo $objResult["product_id"];?>&act=add"><img
                                    src="../images/check.png" width="10%"></a></td>
                    </tr>
                    <?php
  }
  ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-5">
       
            <table class="table table-bordered">
                <tr>
                    <td>ลำดับ</td>
                    <td>สินค้า</td>
                    <td>ราคา</td>
                    <td>จำนวน</td>
                    <td>รวม(บาท)</td>
                    <td>ลบ</td>
                </tr>
                <?php
$total=0;
if(!empty($_SESSION['cart']))
{
    $i = 1 ;
	foreach($_SESSION['cart'] as $product_id=>$product_quantity)
	{
		$sql = "select * from product inner join product_price on product.product_id = product_price.product_id where product.product_id= '$product_id' ";
		$query = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($query);
		$sum = $row['product_price_cost'] * $product_quantity;
		$total += $sum;
		echo "<tr>";
        echo "<td>" . $i++  . "</td>";
		echo "<td width='334'>" . $row["product_name"] . "</td>";
		echo "<td width='60' align='right'>" .number_format($row["product_price_cost"],2) . "</td>";
		echo "<td width='60' align='right'>";  
		echo "<input type='text' name='amount[$product_id]' value='$product_quantity' size='2'/></td>";
		echo "<td width='93' align='right'>".number_format($sum,2)."</td>";
		echo "<td width='46' align='center'><a class='btn btn-danger' href='?page=po&function=insert&product_id=$product_id&act=remove'>ลบ</a></td>";
		echo "</tr>";
	}
	echo "<tr>";
  	echo "<td colspan='3' bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
  	echo "<td align='right' bgcolor='#CEE7FF'>"."<b>".number_format($total,2)."</b>"."</td>";
  	echo "<td align='left' bgcolor='#CEE7FF'></td>";
	echo "</tr>";
}
?>
                <tr>
                    <td colspan="5" align="right">
                        <input class="btn btn-secondary" type="submit" name="button" id="button" value="ปรับปรุง" />
                        <input class="btn btn-success btn-rounded" value="รายการสรุปใบสั่งซื้อ" onclick="window.location='?page=po&function=insertcp';"></input>
                    </td>
                </tr>
            </table>
        </div>
    </div>
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