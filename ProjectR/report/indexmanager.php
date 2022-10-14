<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<?php include '../connect.php' ?>

<?php $sql ="SELECT * FROM employee WHERE employee_role = 'เจ้าของกิจการ' ";
      $result = mysqli_query($con , $sql);
?>

    <table class="table table-hover" id="example">
    <thead>
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">ชื่อ - นามสกุล</th>
            <th scope="col">เบอร์โทรศัพท์</th>
            <th scope="col">อีเมล์</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td scope="row"><?php echo $i++ ?></td>
            <td scope="row"><?php echo $row['employee_name']?></td>
            <td scope="row"><?php echo $row['employee_phone']?></td>
            <td scope="row"><?php echo $row['employee_email']?></td>
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