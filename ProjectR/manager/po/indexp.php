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
require '../functionDateThai.php'; 
?>

<?php $sql ="SELECT * FROM po ORDER BY po_id DESC ";
      $result = mysqli_query($connect , $sql);
?>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            PURCHASE ORDER
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"><img
                src="../images/insert.png" width="80px"></a>
    </div>
</nav>
<br>
<table class="table table-hover" id="example">
    <thead>
        <tr>
            <th scope="col">เลขที่เอกสาร</th>
            <th scope="col">วันที่ออกเอกสาร</th>
            <th scope="col">ชื่อผู้สั่งซื้อ</th>
            <th scope="col">สถานะ</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td class="col-2"><?php echo  $row['po_RefNo'] ?></td>
            <td class="col-2"><?php echo  datethai($row['po_create']) ?></td>
            <td class="col-2"><?php echo  $row['po_buyer'] ?></td>
            <td class="col-2"><?php echo  $row['po_status'] ?></td>
            <td scope="row">
            <a href="?page=<?= $_GET['page'] ?>&function=detail&po_RefNo=<?= $row['po_RefNo'] ?>"><img src="../images/detail.png" width="20px"></a>  
            <!-- <a href="?page=<?= $_GET['page'] ?>&function=update&po_RefNo=<?= $row['po_RefNo'] ?>"><img src="../images/yes.png" width="30px"></a>     -->
            <?php if($row['po_status'] != 'สั่งแล้ว' &&  $row['po_status'] != 'รับสินค้าแล้ว') { ?>
            <a href="?page=<?= $_GET['page'] ?>&function=delete&po_RefNo=<?= $row['po_RefNo'] ?>"><img src="../images/delete.png" width="20px"></a>  
            <?php } ?>
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