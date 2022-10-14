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

<?php include '../connect.php' ?>

<?php $sql ="SELECT * FROM po";
      $result = mysqli_query($con , $sql);
?>


    <nav class="navbar navbar-light bgc">
        <div class="container-fluid">
            <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
            <a class="navbar-brand text-white" href="#">
                PURCHASE ORDER
            </a>
            <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"><img src="../images/add-user.png"
                    width="80px"></a>
        </div>
    </nav>
<br>
    <table class="table table-hover" id="example">
    <thead>
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">หมายเลขใบสั่งซื้อ</th>
            <th scope="col">ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <th scope="row"><?php echo $i++ ?></th>
            <th scope="row"><?php echo $row['po_RefNo']?></th>
            <th scope="row"><img src="../images/delete.png" width="20px"></th>
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