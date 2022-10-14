<center>
    <h3>รายงานสรุปยอดขายแบบรายเดือน</h3>
</center>
<div class="col-md-4">
					<a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
				</div>
                <br>
                <br>
                <br>
<?php
//เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
require_once 'connect.php';
//คิวรี่ข้อมูลมาแสดงในตาราง
$sql = ("SELECT DATE_FORMAT(sales_create, '%M-%Y') AS sales_create, #เปลี่ยนฟอแมตวันที่จาก ป-ด-ว ให้เป็น ด-ป
													SUM(product_total) as product_total #หาผลรวมของราคาขาย
													FROM view_sales_detail 
													GROUP BY DATE_FORMAT(sales_create, '%M-%Y') #จัดกลุ่มข้อมูลจาก ด-ป
													ORDER BY DATE_FORMAT(sales_create, '%m-%Y') DESC #เรียงลำดับข้อมูลจากมากไปน้อย
													");
$result = mysqli_query($con, $sql);
//  $result = mysqli_fetch_assoc($query);
?>
<div class="col-md-8">
<table class="table table-striped  table-hover table-responsive table-bordered">
    <thead>
        <tr>
            <th width="30%">เดือน</th>
            <th width="70%" class="text-center">ยอดขาย</th>
        </tr>
    </thead>
    <tbody>

        <?php
        //ประกาศตัวแปรผลรวม
        $total = 0;
        foreach ($result as $row) {
            //หาผลรวมยอดขายใน loop โดยใข้ +=
            $total += $row['product_total'];
        ?>
            <tr>
                <td><?= $row['sales_create']; ?></td>
                <td align="right"><?= number_format($row['product_total'], 2); ?></td>
            </tr>
        <?php } ?>
        <tr class="table-danger">
            <td class="text-center">Total</td>
            <td align="right"><?= number_format($total, 2); ?></td>
        </tr>
    </tbody>
</table>
</div>
