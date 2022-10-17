<style>
.bgc {
    background-color: green;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
$sql = "SELECT * , DATEDIFF(product_end_date,product_start_date) AS datediff FROM product   ";
$result = mysqli_query($connect , $sql); 
?>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            STOCK PRODUCT
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>
<br>
<table class="table table-hover" id="example">
    <?php $i = 1;
          $profit = 0;
        while ($row = mysqli_fetch_array($result)) {
         $profit = $row['product_price_sell'] - $row['product_price_cost'];
          ?>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวนสินค้า</th>
            <th>ราคาทุน</th>
            <th>ราคาขาย</th>
            <th>กำไร</th>
            <th>วันเดือนปีที่ผลิต</th>
            <th>วันเดือนปีที่หมดอายุ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo  $row['product_name'] ?></td>
            <td><?php echo $row['product_quantity'] ?> <?php echo $row['unit_name'] ?></td>
            <td><?php echo  number_format($row['product_price_cost'], 2) ?></td>
            <td><?php echo  number_format($row['product_price_sell'], 2) ?></td>
            <td><?php echo  number_format($profit, 2) ?></td>
            <td><?php echo  datethai($row['product_start_date']) ?></td>
            <td><?php echo  datethai($row['product_end_date']) ?></td>
        </tr>
        <tr class="bg-success">
                                     <th colspan="1"></th>
                                     <th colspan="2">แจ้งหมดอายุ</th>
                                     <!-- <th colspan="1">จำนวนวันทั้งหมด</th> -->
                                     <th colspan="2">ระยะห่างวันปัจจุบันถึงวันใกล้หมดอายุ</th>
                                     <th colspan="3">จุดสั่งซื้อ</th>
                                     <!-- <th colspan="2">เมนู</th> -->
                                 </tr>
        <?php } ?>
    </tbody>
</table>
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