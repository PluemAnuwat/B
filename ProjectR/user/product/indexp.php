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

<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>

<?php $sql ="SELECT * FROM product a JOIN unit b ON a.product_unit = b.unit_id 
JOIN type_product c ON a.product_type = c.type_id
JOIN product_price d ON a.product_id = d.product_id
 ";
      $result = mysqli_query($connect , $sql);
?>

<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            PRODUCT
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"><img
                src="../images/add-product.png" width="80px"></a>
    </div>
</nav>
<br>
<table class="table table-hover" id="example">
    <thead>
        <tr>
            <th>รหัสสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>หน่วยนับสินค้า</th>
            <th>ประเภทสินค้า</th>
            <th>ราคาทุน</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td scope="row"><img src=".\image\<?= $row['product_img']; ?>" width="100" height="100"></td>
            <td><?php echo  $row['product_name'] ?></td>
            <td><?php echo  $row['unit_name'] ?></td>
            <td><?php echo  $row['type_name'] ?></td>
            <td scope="row"><?php echo  number_format($row['product_price_cost'],2) ?></td>
            <td scope="row"><img src="../images/edit.png" width="20px"></td>
            <!-- <td scope="row"><img src="../images/delete.png" width="20px"></td> -->
            <td>  <a href="?page=<?= $_GET['page'] ?>&function=delete&product_id=<?= $row['product_id'] ?>" class="btn  btn-danger  text-white" onclick="return confirm('ยืนยันการลบข้อมูล')"><i class="fa-solid fa-rectangle-xmark "></i>Delete</a></td>
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