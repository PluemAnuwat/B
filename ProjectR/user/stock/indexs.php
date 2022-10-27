<?php require '../functionDateThai.php' ?>
<style>
.bgc {
    background-color: green;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>
<?php
   function balanceDate($expDate)
   {
       // set parameter
       $totalDay = 0;
       $todayDate = strtotime(date("Y-m-d"));
       $expDate = strtotime($expDate);
       if ($todayDate < $expDate) {
       }
       return $totalDay;
   }
   function status_date_notify($endDate)
   {
       $chk_day_now = time();
       $chk_day_expire = strtotime($endDate);
       $chk_day30 = strtotime($endDate . " -30 day");
       $chk_day15 = strtotime($endDate . " -15 day");
       $chk_day7 = strtotime($endDate . " -7 day");
       //  สามารถเพิ่มตัวแปร และเงื่อนไข เพิ่มเติมสำหรับตรวจสอบได้ตามต้องการ
       if ($chk_day_now >= $chk_day_expire) {
           return 5; // เงื่อนไขรายการเมื่อหมดอายุ
       } else {
           if ($chk_day_now >= $chk_day30 && $chk_day_now < $chk_day15) {
               return 4; // เงื่อนไขรายการจะหมดอายุในอีก 30 วัน
           } elseif ($chk_day_now >= $chk_day15 && $chk_day_now < $chk_day7) {
               return 3; // เงื่อนไขรายการจะหมดอายุในอีก 15 วัน
           } elseif ($chk_day_now >= $chk_day7 && $chk_day_now < $chk_day_expire) {
               return 2; // เงื่อนไขรายการจะหมดอายุในอีก 7 วัน
           } else {
               return 1; // เงื่อนไขรายการยังไม่หมดอายุ
           }
       }
   }
   ?>
<?php
   $connect = mysqli_connect("localhost", "root", "akom2006", "project");
   $sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
   FROM product a JOIN product_date b ON a.product_id = b.product_id  
   JOIN product_quantity c ON a.product_id = c.product_id   
   JOIN product_reorder bbb ON a.product_id = bbb.product_id ";
   $result = mysqli_query($connect , $sql); 
   ?>
<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            STOCK PRODUCT
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>
<br>
<table class="table table-hover" id="example">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th>จำนวนสินค้า</th>
            <th>ราคาทุน</th>
            <th>ราคาขาย</th>
            <th>กำไร</th>
            <th>วันเดือนปีที่ผลิต</th>
            <th>วันเดือนปีที่หมดอายุ</th>
        </tr>
    </thead>
    <?php $i = 1;
      $profit = 0;
      while ($row = mysqli_fetch_array($result)) {
      $profit = $row['product_price_sell'] - $row['product_price_cost'];
      ?>
    <tbody>
        <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo  $row['product_name'] ?></td>
            <td><?php echo $row['product_quantity'] ?> <?php echo $row['unit_name'] ?></td>
            <td><?php echo  number_format($row['product_price_cost'], 2) ?></td>
            <td><?php echo  number_format($row['product_price_sell'], 2) ?></td>
            <td><?php echo  number_format($profit, 2) ?></td>
            <td><?php echo  datethai($row['product_start_date']) ?></td>
            <td><?php echo  datethai($row['product_end_date']) ?></td>
        </tr>
    </tbody>


            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>แจ้งหมดอายุ</td>
            <td>จุดสั่งซื้อ</td>
  

    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php
            $case_notify = status_date_notify(($row['product_end_date']));
            switch ($case_notify) {
                case 5: { ?>
            <td colspan=""><a class="text-danger"><?php echo "สินค้าหมดอายุ "; ?></a></td>
            <?php break;
            } ?>
            <?php
            case 4: { ?>
            <td colspan=""><?php echo "สินค้าจะหมดอายุในอีก 30 วัน "; ?></td>
            <?php break;
            } ?>
            <?php
            case 3: { ?>
            <td colspan=""><a class="text-danger"><?php echo "สินค้าจะหมดอายุในอีก 15 วัน "; ?></a></td>
            <?php break;
            } ?>
            <?php
            case 2 : { ?>
            <td colspan=""><?php echo "สินค้าจะหมดอายุในอีก 7 วัน "; ?></td>
            <?php break;
            } ?>
            <?php
            default: { ?>
            <td colspan=""><?php echo "ยังไม่หมดอายุ"; ?></td>
            <?php break;
            } ?>
            <?php } ?>
            <?php
            $productqty = $row['product_quantity'];
            $point = $row['point'];
                                    ?>
            <?php if ($productqty <= $point) { ?>
            <td colspan=""><?php echo "ถึงจุดสั่งซื้อ" ?></td>
            <?php } else { ?>
            <td colspan=""><?php echo "ยังไม่ถึงจุดสั่งซื้อ" ?></td>
            <?php } 
            ?>
        </tr>
    </tbody>
    <?php } ?>
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