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

<?php $sql ="SELECT * , 
CASE  
WHEN  a.good_status = 0 THEN 'รอการส่งสิินค้า' 
WHEN  a.good_status = 1 THEN 'ส่งสินค้าไปแล้ว'
END AS status ,
count(a.good_RefNo) AS count 
FROM goods a 
INNER JOIN goods_detailproduct b ON a.good_id = b.goods_detailproid
WHERE a.good_status = 0  
GROUP BY  a.good_RefNo DESC";
      $result = mysqli_query($connect , $sql);
?>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            MANAGER GOODS ORDER
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>
<br>
<table class="table table-hover" id="example">
    <thead>
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">วันที่ออกใบรับสินค้า</th>
            <th scope="col">หมายเลขใบรับสินค้า</th>
            <th scope="col">หมายเลขใบสั่งซื้อสินค้า</th>
            <th scope="col">จำนวนรายการสินค้า</th>
            <th scope="col">ผู้สั่งซื้อ</th>
            <th scope="col">สถานะของใบรับสินค้า</th>
            <th scope="col">ทำการส่งสินค้า</th>
            <th scope="col">ยกเลิกใบสั่งซื้อสินค้านี้</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td scope="row"><?php echo $i++ ?></td>
            <td scope="row"><?php echo $row['good_create']?></td>
            <td scope="row"><?php echo $row['good_RefNo']?></td>
            <td scope="row"><?php echo $row['po_RefNo']?></td>
            <td scope="row"><?php echo $row['count']?></td>
            <td scope="row"><?php echo $row['po_buyer']?></td>
            <?php if ($row['status'] == 0) { ?>
            <td class="col-2"><a class="text-danger"><img src="../images/waithands.png" width="30px;"><?php echo  $row['status'] ?></a></td>
            <?php } else {  ?>
            <td class="col-2"><a class="text-success"><img src="../images/handssok.png" width="30px;"><?php echo  $row['status'] ?></a></td>
            <?php } ?>
            <td scope="row"><img src="../images/yes.png" width="20px"></td>
            <td scope="row"><img src="../images/cencle.png" width="20px"></td>
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