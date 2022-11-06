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
WHEN  a.good_status = 0 THEN 'รอส่ง' 
WHEN  a.good_status = 1 THEN 'ส่งแล้ว'
END AS status ,
count(a.good_RefNo) AS count 
FROM goods a 
INNER JOIN goods_detailproduct b ON a.good_id = b.good_id
-- WHERE a.good_status = 0   AND b.product_start_date <> ''
GROUP BY  a.good_RefNo DESC";
// print_r($sql);
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
            <th scope="col">หมายเลขใบสั่งซื้อ / หมายเลขใบรับ</th>
            <!-- <th scope="col">หมายเลขใบสั่งซื้อ</th> -->
            <th scope="col">รายการสินค้า</th>
            <th scope="col">จำนวน</th>
            <!-- <th scope="col">จำนวนรายการ</th> -->
            <th scope="col">ผู้สั่งซื้อ</th>
            <th scope="col">สถานะของใบรับสินค้า</th>
            <!-- <th scope="col">โน๊ต</th> -->
            <th scope="col">จัดการ</th>
            <!-- <th scope="col"></th> -->
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    require 'functionDateThaiOnTime.php'; 
    while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td scope="row"><?php echo $i++ ?></td>
            <?php if($row['good_create'] == '' ){ ?>
            <td scope="row"><?php echo 'ยังไม่ได้ทำการส่งใบ' ?></td>
            <?php }else{ ?>
            <td scope="row"><?php echo datethai($row['good_create']) ?></td>
            <?php } ?>
            <td scope="row"><?php echo $row['po_RefNo'] ; echo "<br>" ; echo $row['good_RefNo']?></td>
            <!-- <td scope="row"><?php echo $row['po_RefNo']?></td> -->
            <td scope="row" class="col-4">
            <?php $sql1 = "SELECT * FROM goods 
                            INNER JOIN goods_detailproduct ON goods.good_id = goods_detailproduct.good_id
                            INNER JOIN product ON goods_detailproduct.product_id = product.product_id
                            WHERE goods.good_RefNo = '".$row['good_RefNo']."'";
                  $query1 = mysqli_query($connect , $sql1 );
                  $ii = 1 ;
                  while($result1 = mysqli_fetch_array($query1)){ ?>
            <?php echo $ii++ ; echo "." ; echo  $result1['product_name'] ; echo '<br>' ?>
                  <?php } ?>
                  </td>
            <td scope="row">
            <?php $sql1 = "SELECT * , goods_detailproduct.product_quantity AS product_quantity FROM goods 
                            INNER JOIN goods_detailproduct ON goods.good_id = goods_detailproduct.good_id
                            INNER JOIN product ON goods_detailproduct.product_id = product.product_id
                            WHERE goods.good_RefNo = '".$row['good_RefNo']."'";
                  $query1 = mysqli_query($connect , $sql1 );
                  $ii = 1 ;
                  while($result1 = mysqli_fetch_array($query1)){ ?>
            <?php echo  $result1['product_quantity'] ; echo '<br>' ?>
                  <?php } ?>
            </td>
            <!-- <td scope="row"><?php echo $row['count']?></td>  -->
            <td scope="row"><?php echo $row['po_buyer']?></td>
            <?php if ($row['good_status'] == 0) { ?>
            <td class="col-1"><a class="text-danger"><img src="../images/waithands.png" width="30px;"><br><?php echo  $row['status'] ?></a></td>
            <!-- <td scope="row"> ยกเลิกได้ </td> -->
            <td><a href="?page=<?= $_GET['page'] ?>&function=detail&good_RefNo=<?= $row['good_RefNo'] ?>"><img src="../images/prepare.png" width="30px"></a>
          <!-- <td scope="row"><a href="?page=<?= $_GET['page'] ?>&function=delete&good_RefNo=<?= $row['good_RefNo'] ?>"><img src="../images/delete.png" width="30px"></a></td> -->
            <?php } else {  ?>
            <td class="col-2"><a class="text-success"><img src="../images/handsok.png" width="30px;"><?php echo  $row['status'] ?></a></td>
            <!-- <td scope="row">ยกเลิกไม่ได้ </td> -->
            <td></td>
            <!-- <td></td> -->
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


