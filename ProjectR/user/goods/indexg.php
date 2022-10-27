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
// $sql ="SELECT DISTINCT(goods_detailproduct.po_RefNo) 
// ,
// CASE 
// WHEN goods_detailproduct.product_start_date  IS NULL  
//     AND  goods_detailproduct.product_end_date  IS NULL  THEN 'ยังไม่ได้จัดเตรียมสินค้า'
// END AS msgstatus 
// FROM goods JOIN goods_detailproduct 
// ON goods.good_id = goods_detailproduct.goods_detailproid
// WHERE goods_detailproduct.product_start_date IS NULL 
// AND goods_detailproduct.product_end_date IS NULL 
// AND goods.good_create IS NULL  ";
$sql = "SELECT DISTINCT(b.po_RefNo) , 
CASE 
WHEN b.product_start_date  IS NULL  
  AND  b.product_end_date  IS NULL   THEN 'ยังไม่ได้จัดเตรียมสินค้า'
 WHEN b.product_end_date  IS NOT NULL   THEN 'จัดเตรียมสินค้าแล้ว'
   END AS msgstatus
FROM goods a JOIN goods_detailproduct b ON a.good_id = b.goods_detailproid";
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
            <th scope="col"></th>
            <th scope="col">วันที่ออกใบรับ</th>
            <th scope="col">รายการ</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ผู้สั่งซื้อ</th>
            <th scope="col">สถานะของใบรับสินค้า</th>
            <!-- <th scope="col">จัดเตรียมสินค้า</th> -->
        </tr>
    </thead>
    <tbody>
        <?php 
    $i = 1 ;
    while ($row = mysqli_fetch_array($result)) {
        $row_date = $row['product_start_date'] ; 
         ?>

        <tr>
            <td></td>
            <th style="text-align:center;"><?php echo $row['po_RefNo']?></th>
            <td>

                <?php 
                $no = 1;
                $sqlproduct = "SELECT  * FROM  goods_detailproduct b
                 JOIN product c ON b.product_id = c.product_id JOIN goods d ON d.good_id = b.goods_detailproid WHERE b.po_RefNo = '".$row['po_RefNo']."'";
                 $queryproduct = mysqli_query($connect , $sqlproduct); 
                while ($rowproduct = mysqli_fetch_array($queryproduct)) { 
        ?>

        <tr>
            <td><?php echo $no++; ?></td>
            <td></td>
            <td></td>
            <td>
                <?php echo $rowproduct['product_name'];  echo '<br>'; ?>
            </td>
            <td style="text-align:right;"><?php echo $rowproduct['product_quantity'];  echo '<br>'; ?></td>
            <td><?php echo $rowproduct['po_buyer'];  echo '<br>'; ?></td>
            <td><?php echo $row['msgstatus'] ; ?></td>
            <td></td>
        </tr>

        <?php  } ?>

    
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <!-- <td>
            <?php if($row_date <> "" ){ ?>

            <?php }else{ ?>
            <a href="?page=<?= $_GET['page'] ?>&function=detail&po_RefNo=<?= $row['po_RefNo'] ?>">
                <img src="../images/prepare.png" width="30px"></a>
            <?php } ?>
        </td>    
     -->
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