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

<?php 

$sql = "SELECT DISTINCT(b.po_RefNo) , b.po_create , 
CASE 
WHEN
    a.good_create  IS NULL   THEN 'ยังไม่ได้จัดเตรียมสินค้า' 
 WHEN   a.good_create  IS NOT NULL   THEN 'จัดเตรียมสินค้าแล้ว'
   END AS msgstatus
FROM goods a JOIN goods_detailproduct b ON a.good_id = b.good_id ";
$result = mysqli_query($connect , $sql);
?>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            GOODS ORDER
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"><img
                src="../images/add-user.png" width="80px" style="display:none;"></a>
    </div>
</nav>
<br>
<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
    <thead>
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">หมายเลขใบสั่งซื้อ</th>
            <th scope="col">วันที่ออกใบรับ</th>
            <th scope="col">รายการ</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ผู้สั่งซื้อ</th>
            <th scope="col">สถานะของใบรับสินค้า</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        require '../functionDateThai.php';
    $no = 1 ;
    while ($row = mysqli_fetch_array($result)) {
        $row_date = $row['product_start_date'] ; 
         ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td style="text-align:center;"><?php echo $row['po_RefNo']?></td>
            <td><?php echo DateThai($row['po_create']); ?></td>
            <td>
            <?php 
                $sqlproduct = "SELECT  * FROM  goods_detailproduct b
                 JOIN product c ON b.product_id = c.product_id JOIN goods d ON d.good_id = b.good_id WHERE b.po_RefNo = '".$row['po_RefNo']."'";
                 $queryproduct = mysqli_query($connect , $sqlproduct); 
                 $i = 1 ;
                while ($rowproduct = mysqli_fetch_array($queryproduct)) { ?>            
                   <?php echo $i++ ; echo "." ; echo $rowproduct['product_name'];  echo '<br>'; ?>
            <?php  } ?>
            </td>
            <td class="text-center">
            <?php 
                $sqlproduct = "SELECT  * FROM  goods_detailproduct b
                 JOIN product c ON b.product_id = c.product_id JOIN goods d ON d.good_id = b.good_id WHERE b.po_RefNo = '".$row['po_RefNo']."'";
                 $queryproduct = mysqli_query($connect , $sqlproduct); 
                while ($rowproduct = mysqli_fetch_array($queryproduct)) { ?>            
                <?php echo $rowproduct['product_quantity'];  echo '<br>'; ?>
            <?php  } ?>
            </td>
            <td>
            <?php 
                $sqlproduct = "SELECT  * FROM  goods_detailproduct b
                 JOIN product c ON b.product_id = c.product_id JOIN goods d ON d.good_id = b.good_id WHERE b.po_RefNo = '".$row['po_RefNo']."'";
                 $queryproduct = mysqli_query($connect , $sqlproduct); 
                while ($rowproduct = mysqli_fetch_array($queryproduct)) { ?>            
             <?php echo $rowproduct['po_buyer'];  echo '<br>'; ?>
            <?php  } ?>
            </td>
            <?php if($row['msgstatus'] == 'ยังไม่ได้จัดเตรียมสินค้า') { ?>
                <td class="text-danger">   <?php echo $row['msgstatus'] ; ?>     </td> 
                <?php }else{ ?>
                    <td class="text-success">   <?php echo $row['msgstatus'] ; ?>     </td> 
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