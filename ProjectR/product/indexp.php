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

<?php $sql ="SELECT * ,
 a.product_unit,b.unit_id,unit_name as unit_name ,  
 a.product_category , c.category_id, c.category_name as category_name ,  
 a.product_type , d.type_id, d.type_name as category_name 
 FROM product a join unit b ON a.product_unit = b.unit_id
JOIN category c ON a.product_category = c.category_id 
JOIN type_product d ON a.product_type = d.type_id
JOIN product_price e ON a.product_id = e.product_id
 ";
      $result = mysqli_query($con , $sql);
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
            <th>รูปภาพ</th>
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
            <td scope="row"><?php echo  $row['product_price_cost'] ?></td>
            <td scope="row"><img src="../images/edit.png" width="20px"></td>
            <td scope="row"><img src="../images/delete.png" width="20px"></td>
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