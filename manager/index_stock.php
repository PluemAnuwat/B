         <?php require 'indexsql_stock.php' ?>

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
         <div class="row">
             <div class="col-md-12">
                 <h2>สต็อกสินค้า</h2>
             </div>
         </div>
         <hr />

         <div class="row">
             <div class="col-md-12">
                 <div class="panel panel-default">
                     <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                         <?php $i = 1;
                                    $profit = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        $profit = $row['product_price_sell'] - $row['product_price_cost'];
                                    ?>
                             <thead>
                                     <tr class="text-nowrap bg-primary">
                                         <th>ลำดับ</th>
                                         <th>ชื่อสินค้า</th>
                                         <th>จำนวนสินค้า</th>
                                         <th>ราคาทุน</th>
                                         <th>ราคาขาย</th>
                                         <th>กำไร</th>
                                         <th>วันเดือนปีที่ผลิต</th>
                                         <th>วันเดือนปีที่หมดอายุ</th>
                                     </tr>
                             </thead>
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
                                 <tr class="bg-success">
                                     <th colspan="1"></th>
                                     <th colspan="2">แจ้งหมดอายุ</th>
                                     <!-- <th colspan="1">จำนวนวันทั้งหมด</th> -->
                                     <th colspan="2">ระยะห่างวันปัจจุบันถึงวันใกล้หมดอายุ</th>
                                     <th colspan="3">จุดสั่งซื้อ</th>
                                     <!-- <th colspan="2">เมนู</th> -->
                                 </tr>
                             <tbody>
                                 <td colspan="1"></td>
                                 <?php
                                        $case_notify = status_date_notify(($row['product_end_date']));
                                        switch ($case_notify) {
                                            case 5: { ?>
                                             <td colspan="2"><a class="text-danger"><?php echo "สินค้าหมดอายุ "; ?></a></td>
                                         <?php break;
                                                } ?>
                                         <?php
                                            case 4: { ?>
                                             <td colspan="2"><?php echo "สินค้าจะหมดอายุในอีก 30 วัน "; ?></td>
                                         <?php break;
                                                } ?>
                                         <?php
                                            case 3: { ?>
                                             <td colspan="2"><a class="text-danger"><?php echo "สินค้าจะหมดอายุในอีก 15 วัน "; ?></a></td>
                                         <?php break;
                                                } ?>
                                         <?php
                                            case 2: { ?>
                                             <td colspan="2"><?php echo "สินค้าจะหมดอายุในอีก 7 วัน "; ?></td>
                                         <?php break;
                                                } ?>
                                         <?php
                                            default: { ?>
                                             <td colspan="2"><?php echo "ยังไม่หมดอายุ"; ?></td>
                                         <?php break;
                                                } ?>
                                 <?php } ?>
                                 <!-- <td><?php echo balanceDate(($row['product_end_date']), ($row['product_end_date'])) ?></td> -->
                                 <td colspan="2"><?php echo $row['datediff']?>วัน</td>
                                 <?php
                                        $query = "SELECT * FROM view_product_stock a LEFT JOIN reorder b ON a.product_id = b.product_id";
                                        $results = mysqli_query($con, $query);
                                        $fetch = mysqli_fetch_array($results);
                                      
                                        $productqty = $fetch['product_quantity'];
                                        $point = $fetch['point'];
                              
                                    ?>
                                 <?php if ($productqty <= $point) { ?>
                                     <td colspan="3"><?php echo "ถึงจุดสั่งซื้อ" ?></td>
                                 <?php } else { ?>
                                     <td colspan="3"><?php echo "ยังไม่ถึงจุดสั่งซื้อ" ?></td>
                                 <?php } ?>
                             
                             </tbody>
                         <?php 
                        } ?>
                         </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>