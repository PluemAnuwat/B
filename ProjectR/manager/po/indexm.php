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

<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project");
require 'functionDateThaiOnTime.php';  ?>

<?php $sql ="SELECT * ,a.po_saler,c.suppiles_id,c.suppiles_name AS suppiles_name FROM po a 
INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
 WHERE a.po_status = 'รอยืนยัน'  group by a.po_id ORDER BY po_create DESC  ";
      $result = mysqli_query($connect , $sql);
?>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            MANAGER PURCHASE ORDER
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>
<br>
<table class="table table-hover" id="example">
    <thead>
        <tr>
            <th scope="col">วันที่ออกใบสั่งซื้อ</th>
            <th scope="col">หมายเลขใบสั่งซื้อ</th>
            <th scope="col">รายการสินค้า</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ซัพพลายเซน</th>
            <th scope="col">ผู้สั่งซื้อ</th>
            <th scope="col">ยืนยันการสั่งซื้อ</th>
            <th scope="col">ยกเลิกใบสั่งซื้อ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) 
    { ?>
        <tr>
            <td scope="row"><?php echo datethai($row['po_create'])?></td>
            <td scope="row"><?php echo $row['po_RefNo']?></td>
            <td class="col-5">
                <?php $sql1 = "SELECT * FROM po AS a 
                INNER JOIN po_detailproduct AS b ON a.po_id = b.po_id
                INNER JOIN product AS c ON b.product_id = c.product_id
                WHERE a.po_RefNo = '".$row['po_RefNo']."'";
                $query1 = mysqli_query($connect , $sql1);
                $iii = 1 ;
                while($row1 = mysqli_fetch_array($query1)){
                    echo $iii++ ; echo "." ; echo $row1['product_name'] ; echo '</br>';
                 } ?>
            </td>
            <td class="">
                <?php $sql1 = "SELECT * ,b.product_quantity AS product_quantity FROM po AS a 
                INNER JOIN po_detailproduct AS b ON a.po_id = b.po_id
                INNER JOIN product AS c ON b.product_id = c.product_id
                INNER JOIN unit AS d ON c.product_unit = d.unit_id
                WHERE a.po_RefNo = '".$row['po_RefNo']."'";
                $query1 = mysqli_query($connect , $sql1);
                $iii = 1 ;
                while($row1 = mysqli_fetch_array($query1)){
                   echo $row1['product_quantity'] ; echo "   " ; echo $row1['unit_name'] ;  echo '</br>';
                 } ?>
            </td>
            <!-- <td scope="row"></td> -->
            <td scope="row"><?php echo $row['suppiles_name']?></td>
            <td scope="row"><?php echo $row['po_buyer']?></td>
            <td scope="row"><a href="?page=<?= $_GET['page'] ?>&function=good&po_RefNo=<?php echo $row['po_RefNo'] ?>" onclick="return confirm('ต้องการสั่งซื้อ  : <?= $row['po_RefNo'] ?> หรือไม่ ??')"><img src="../images/yes.png" width="25px"></a></td>
            <td scope="row"><a href="?page=<?= $_GET['page'] ?>&function=delete&po_RefNo=<?php echo $row['po_RefNo'] ?>" onclick="return confirm('ต้องการยกเลิก  : <?= $row['po_RefNo'] ?> หรือไม่ ??')" ><img src="../images/cencle.png" width="25px"></a></td>
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