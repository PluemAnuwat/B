<?php require 'functionDateThaiNotTime.php' ?>
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
   $sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff ,
   a.product_quantity AS product_quantity
   FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
   INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
   INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
   INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id 
   WHERE c.status = '0' 
   GROUP BY a.product_id ";
        //    print_r($sql);
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
            <th>รายการ</th>
            <th>จำนวนสินค้าทั้งหมด</th>
            <th>ราคาทุน</th>
            <th>ราคาขาย</th>
            <th>กำไร</th>
            <th>วันเดือนปีที่ผลิต</th>
            <th>วันเดือนปีที่หมดอายุ</th>
            <th>แจ้งหมดอายุ</th>
            <th>ตัดสต็อก</th>
            <th>จุดสั่งซื้อที่กำหนด</th>
            <th>จุดสั่งซื้อ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
      $profit = 0;
      while ($row = mysqli_fetch_array($result)) {
      $profit = $row['product_price_sell'] - $row['product_price_cost'];
      ?>

        <tr>
            <td><?php echo  $row['product_name'] ?></td>
            <td><?php echo $row['product_quantity'] ?> <?php echo $row['unit_name'] ?></td>
            <td><?php echo  number_format($row['product_price_cost'], 2) ?></td>
            <td><?php echo  number_format($row['product_price_sell'], 2) ?></td>
            <td>
                <?php if($profit <= 0 && $row['product_price_sell'] >  $row['product_price_cost']  ){ ?>
                <a class="text-danger"><?php echo "กำหนดราคา" ?>
            </td></a>
            <?php } else if($row['product_price_sell'] <  $row['product_price_cost'] ){ ?>
            <a class="text-danger"><?php echo "" ?><?php echo $profit ; ?></td></a>
            <?php } else{ ?>
            <?php echo  number_format($profit, 2) ?></td>
            <?php } ?>
            <td>
                <?php   $sqldate1 = "SELECT * 
                        FROM product_date 
                        WHERE product_id = '".$row['product_id']."' ";
                       $resultdate1 = mysqli_query($connect , $sqldate1); 
                       while ($rowdate1 = mysqli_fetch_array($resultdate1)) { 
                        echo datethai($rowdate1['product_start_date']) ; echo '<br>' ; 
                        } ?>
            </td>
            <td>
                <?php   $sqldate2 = "SELECT *                   
                        FROM product_date
                        WHERE product_id = '".$row['product_id']."' ";
                       $resultdate2 = mysqli_query($connect , $sqldate2); 
                       while ($rowdate2 = mysqli_fetch_array($resultdate2)) { 
                        echo datethai($rowdate2['product_end_date']); echo '<br>'   ; 
                        } ?>
            </td>
            <td>
                <?php
             $sqldate3 = "SELECT *                   
             FROM product_date
             WHERE product_id = '".$row['product_id']."' ";
            $resultdate3 = mysqli_query($connect , $sqldate3); 
            while ($rowdate3 = mysqli_fetch_array($resultdate3)) { 
            $case_notify = status_date_notify(($rowdate3['product_end_date']));
            switch ($case_notify) {
                case 5: { ?>
                <a class="text-danger"><?php echo "สินค้าหมดอายุ "; echo '<br>' ; ?></a>
                <?php break;
            } ?>
                <?php
            case 4: { ?>
                <?php echo "สินค้าจะหมดอายุในอีก 30 วัน ";  echo '<br>'   ;  ?>
                <?php break;
            } ?>
                <?php
            case 3: { ?>
                <a class="text-danger"><?php echo "สินค้าจะหมดอายุในอีก 15 วัน "; echo '<br>'   ;  ?></a>
                <?php break;
            } ?>
                <?php
            case 2 : { ?>
                <?php echo "สินค้าจะหมดอายุในอีก 7 วัน "; echo '<br>'   ;  ?>
                <?php break;
            } ?>
                <?php
            default: { ?>
                <?php echo "ยังไม่หมดอายุ";  echo '<br>'   ;  ?>
                <?php break;
            }
            } 
             } ?>
            </td>
            <td>
                <?php 
                    $atycut = "SELECT  c.product_quantity  as qtycut
                    FROM product AS a 
                    INNER JOIN product_date AS b ON a.product_id = b.product_id
                    INNER JOIN product_quantity AS c ON b.good_RefNo = c.good_RefNo
                    WHERE  b.product_id = '".$row['product_id']."'
                    AND   b.product_end_date  <= CURDATE() 
                     AND c.product_id = '".$row['product_id']."' AND b.status = '0'   ";
                        $querycut = mysqli_query($connect , $atycut);
                        $numcut = mysqli_num_rows($querycut);
                        // print_r($atycut);
                        while($resultcut = mysqli_fetch_array($querycut)){ 
                        ?>
                <?php 
                if($resultcut['qtycut'] != '' ){
                    echo $resultcut['qtycut'] ; echo "<br>" ;  echo "" ; 
                }else{
                    echo '0' ; echo  "<br>" ; 
                }
                ?>
                <?php } ?>
            </td>
            <td><?php
              $atypoint = "SELECT 
              point
              FROM product AS a 
              INNER JOIN product_reorder AS d ON a.product_id = d.product_id
              WHERE  a.product_id = '".$row['product_id']."' ";
                  $querypoint = mysqli_query($connect , $atypoint);
                  $numpoint = mysqli_num_rows($querypoint);
                  while($resultpoint = mysqli_fetch_array($querypoint)){ 
                        echo $resultpoint['point'];
                  ?>
                <?php } ?>
            <td>
                <?php
              $atycut1 = "SELECT CASE WHEN product_reorder.point >= product.product_quantity THEN 'ถึงจุดสั่งซื้อ' 
              WHEN product_reorder.point < product.product_quantity THEN 'ไม่ถึงจุดสั่งซื้อ' END AS msgpoint from product
               inner join product_reorder on product.product_id = product_reorder.product_id 
              WHERE  product.product_id = '".$row['product_id']."' ";
                  $querycut1 = mysqli_query($connect , $atycut1);
                  $numcut1 = mysqli_num_rows($querycut1);
                //   print_r($atycut1);
                  while( $resultcut1 = mysqli_fetch_array($querycut1)){ 
                        echo $resultcut1['msgpoint'] ; 
                  }
            ?>
            </td>
            <td>
                <?php if($numcut)  {            
                $atycut = "SELECT d.point , a.product_quantity
                FROM product AS a 
                INNER JOIN product_date AS b ON a.product_id = b.product_id
                INNER JOIN product_reorder AS d ON a.product_id = d.product_id
                WHERE  b.product_id = '".$row['product_id']."'
                AND b.status = '0'  ";
                    $querycut = mysqli_query($connect , $atycut);
                    $numcut = mysqli_num_rows($querycut);
                    $resultcut = mysqli_fetch_array($querycut) ; 
                    //  print_r($resultcut['good_RefNo']);
                    ?>
                <a
                    href="?page=<?= $_GET['page'] ?>&function=delete&good_RefNo=<?= $resultcut['good_RefNo'] ?>&product_id=<?= $row['product_id']?>"><img
                        src="../images/delete.png" width="20px"></a>
                <?php } ?>

            </td>
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