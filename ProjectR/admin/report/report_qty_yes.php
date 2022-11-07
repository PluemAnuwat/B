<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();

    document.body.innerHTML = originalContents;
}
</script>
<?php 
function status_date_notify($endDate)
{
	$chk_day_now = time();
	$chk_day_expire = strtotime($endDate);
	$chk_day30 = strtotime($endDate . " -30 day");
	$chk_day15 = strtotime($endDate . " -15 day");
	$chk_day7 = strtotime($endDate . " -7 day");
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
$connect = mysqli_connect("localhost","root","akom2006","project");

include "function_paginate.php";
require '../functionDateThai.php';
require 'functionthaitoeng.php';
// price_op
@$ds = thaistart1($_POST["datest"]);
@$de = thaistart1($_POST["dateed"]);
@$po = $_POST["product_id"];
@$report = $_POST["price_op"];
$sql = "";
if ($report == "") {
	if ($ds == "" && $de == "") {
		$date = date("Y/m/d");
		$sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (a.product_quantity * product_price_sell ) AS qtysell  
        FROM product AS a 
        INNER JOIN product_price AS c ON a.product_id = c.product_id 
        INNER JOIN product_date AS d ON a.product_id = d.product_id 
        INNER JOIN unit AS u ON a.product_unit = u.unit_id
    
        group by a.product_id";
                 
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (a.product_quantity * product_price_sell ) AS qtysell 
    FROM product AS a 
    INNER JOIN product_price AS c ON a.product_id = c.product_id
     INNER JOIN product_date AS d ON a.product_id = d.product_id 
     INNER JOIN unit AS u ON a.product_unit = u.unit_id
     group by a.product_id
	   WHERE sales_date  BETWEEN '$ds' AND '$de'  ";
    }
} else if ($report == 1) {

	if ($ds == "" && $de == "") {
		$date = date("Y/m/d");
		$sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (a.product_quantity * product_price_sell ) AS qtysell  
        FROM product AS a 
        INNER JOIN product_price AS c ON a.product_id = c.product_id 
        INNER JOIN product_date AS d ON a.product_id = d.product_id 
        INNER JOIN unit AS u ON a.product_unit = u.unit_id
        WHERE a.product_id = '$po'
        group by a.product_id";

	} else if ($ds != "" && $de != "") {
        $sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (a.product_quantity * product_price_sell ) AS qtysell 
        FROM product AS a 
        INNER JOIN product_price AS c ON a.product_id = c.product_id
         INNER JOIN product_date AS d ON a.product_id = d.product_id 
         INNER JOIN unit AS u ON a.product_unit = u.unit_id
         group by a.product_id
           WHERE sales_date  BETWEEN '$ds' AND '$de'  AND a.product_id = '$po' ";
	} 
}else if ($report == 2) {
	if ($ds == "" && $de == ""  ) {
		$sql = "SELECT *   
     FROM product  AS a 
    WHERE a.product_id = '$po'
    group by a.product_id";
//   print_r($sql);
	} else if ($ds != "" && $de != "") {
        $sql = "SELECT *   
        FROM product  AS a 
       WHERE a.product_id = '$po'
       group by a.product_id";
	}

}
	$re = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($re);
?>

<table width="100%" border="0" align="center">
    <form name="form1" method="post" action="index.php?page=report_qty_yes">
        <tr>
            <td><b>กรุณาเลือกรายงาน
                    <select class="form-control" name="price_op">
                        <option value="1">รายงานสินค้าคงเหลือ</option>
                        <!-- <option value="2">รายงานความเคลื่อนไหวสินค้าคงเหลือ</option> -->
                    </select>
                </b>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
                <div class="row">
                    <!-- <div class="col-md-4" id="searchdate">
                        <label>เลือกวัน
                            เริ่มจาก </label>
                      
                        <input id="my_date" name="datest"   class="form-control"  /></input>

                        <hr>
                    </div>
                    <div class="col-md-4">
                        <label>ถึง</label>
                        <input id="my_date2" name="dateed"   class="form-control"  /></input>
                      
                        <hr>
                    </div> -->

                    <div class="col-md-8">
                        <label>เลือกสินค้าที่ต้องการดู</label>
                        <select type="text" class="form-control" name="product_id">
                    <?php
                $sqlunit = "SELECT * FROM product";
                $queryunit = mysqli_query($connect, $sqlunit);
                 foreach ($queryunit as $dataunit) : ?>
                    <option value="<?= $dataunit['product_id'] ?>"><?= $dataunit['product_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                        <!-- <input type="date" class="form-control" name="dateed" id="dateed" value=""></input> -->
                        <hr>
                    </div>

                    <div class="col-md-4">
                    <label class="text-white">.</label>
                        <input type="submit" class="form-control btn btn-primary text-white" value="ดูรายงาน">
                        <!-- <input class="btn btn-success btn-rounded" value="ยืนยันการขาย" onclick="window.location='?page=rpt_po';"></input> -->
                    </div>
                    
                    <div class="col-md-4">
                        <!-- <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a> -->
                    </div>
                </div>
            </td>
        </tr>
    </form>
</table>

<div id="divprint">
    <?php
	if ($report == 1 || $report == "") { ?>
    <center>
        <h3>รายงานสินค้าคงเหลือ</h3>
        <hr>
    </center>
    <table class="table table-striped table-bordered table-hover" id="example" cellspacing="1" cellpadding="3"
        width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
        <tbody>
            <tr bgcolor="#e5e5e5" align="center">
                <th scope="col">ลำดับ</th>
                <th scope="col">รายการสินค้า</th>
                <th scope="col">รหัสสินค้า</th>
                <th scope="col">หน่วย</th>
                <th scope="col">จำนวนคงคลัง</th>
                <th scope="col">ราคาต่อหน่วย</th>
                <th scope="col">มูลค่าสินค้าคงเหลือ</th>
            </tr>
        </tbody>
        <?php  } elseif ($report == 2) { ?>
        <hr>
       
        <center>
            <h3>รายงานความเคลื่อนไหวสินค้าคงเหลือ</h3>
        </center>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
            cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
            <tbody>
                <tr bgcolor="#e5e5e5" align="center">
                    <th colspan="2"></th>
                    <th colspan="3" scope="col">เข้า</th>
                    <th colspan="3" scope="col">ออก</th>
                    <th></th>
                </tr>
                <tr bgcolor="#e5e5e5" align="center">
                    <th scope="col">วันที่</th>
                    <th scope="col">เลขที่เอกสาร</th>
                    <th scope="col">จำนวน</th>
                    <th scope="col">ราคาต่อหน่วย</th>
                    <th scope="col">ยอดรวม</th>
                    <th scope="col">จำนวน</th>
                    <th scope="col">ราคาต่อหน่วย</th>
                    <th scope="col">ยอดรวม</th>
                    <th scope="col">สินค้าคงเหลือ</th>
                </tr>
                        <?php } ?>

                        <?php  if ($report == 2 ) {   ?>
                        <?php if ($ds && $de ) { ?>
                        <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                        <?php } ?>
                        <?php 
                        if($num){
                            $product_quantity = "" ;
														while ($rep = mysqli_fetch_array($re)) { ?>
                                                        
                                                        <?php
                                 $sql = "SELECT * FROM goods_detailproduct 
                                 INNER JOIN goods ON goods_detailproduct.good_id = goods.good_id
                                 WHERE product_id  = '".$rep['product_id']."'";
                                 $query = mysqli_query($connect , $sql );
                                //  print_r($sql);
                                 while ($result = mysqli_fetch_array($query)) {
															  ?>
                            <tr bgcolor=#e5e5e5 class="text-right">
                            <td><?php echo datethai($result['good_create']) ; ?></td>
                            <td><?php echo $result['good_RefNo'] ; ?></td>
                            <td>
                               <?php 
                                 $sql1 = "SELECT * FROM goods 
                                 INNER JOIN product_quantity ON goods.good_RefNo = product_quantity.good_RefNo
                                 INNER JOIN product_price ON product_quantity.product_id = product_price.product_id
                                 WHERE  goods.good_RefNo = '".$result['good_RefNo']."' AND   product_quantity.product_id  = '".$rep['product_id']."'";
                                 $query1 = mysqli_query($connect , $sql1 );
                                //  print_r($sql1);
                                 while ($result1 = mysqli_fetch_array($query1)) { ?>
                                    <?= $result1['product_quantity'];?>
                            </td>
                            <td>
                               <?php 
                                 $sql1 = "SELECT * FROM goods 
                                 INNER JOIN product_quantity ON goods.good_RefNo = product_quantity.good_RefNo
                                 INNER JOIN product_price ON product_quantity.product_id = product_price.product_id
                                 WHERE  goods.good_RefNo = '".$result['good_RefNo']."' AND   product_quantity.product_id  = '".$rep['product_id']."'";
                                 $query1 = mysqli_query($connect , $sql1 );
                                //  print_r($sql1);
                                 while ($result1 = mysqli_fetch_array($query1)) { ?>
                                    <?= $result1['product_price_cost'];?>
                            </td>
                            <td>
                               <?php 
                                 $sql1 = "SELECT * FROM goods 
                                 INNER JOIN product_quantity ON goods.good_RefNo = product_quantity.good_RefNo
                                 INNER JOIN product_price ON product_quantity.product_id = product_price.product_id
                                 WHERE  goods.good_RefNo = '".$result['good_RefNo']."' AND   product_quantity.product_id  = '".$rep['product_id']."'";
                                 $query1 = mysqli_query($connect , $sql1 );
                                //  print_r($sql1);
                                 while ($result1 = mysqli_fetch_array($query1)) { ?>
                                    <?= $result1['product_price_cost'] * $result1['product_quantity'];?>
                                    <?php } ?>
                                </td>
                            
                         
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                        <td colspan="3" ></td>     
                               <?php 
                                 $sql3 = "SELECT * FROM goods 
                                 INNER JOIN product_quantity ON goods.good_RefNo = product_quantity.good_RefNo
                                 INNER JOIN product_price ON product_quantity.product_id = product_price.product_id
                                 WHERE  goods.good_RefNo = '".$result['good_RefNo']."' AND   product_quantity.product_id  = '".$rep['product_id']."'";
                                 $query3 = mysqli_query($connect , $sql3 );
                                //  print_r($sql1);
                                 while ($result3 = mysqli_fetch_array($query3)) { ?>
                                       <td><?=  $result3['product_quantity'];?></td>
                                    <?php } ?>
                            
                        <tr bgcolor=#e5e5e5 class="text-right">
                     <td >
                            <?php 
                                $sql2 = "SELECT * FROM sales 
                                WHERE   product_id  = '".$rep['product_id']."'";
                                $query2 = mysqli_query($connect , $sql2 );
                                while ($result2 = mysqli_fetch_array($query2)) { 
                                echo  datethai($result2['sales_date']) ; 
                                ?>
                               <?php } ?>
                        </td>
                        <td >
                            <?php 
                                $sql2 = "SELECT * FROM sales 
                                WHERE   product_id  = '".$rep['product_id']."'";
                                $query2 = mysqli_query($connect , $sql2 );
                                while ($result2 = mysqli_fetch_array($query2)) { 
                                echo  $result2['sales_RefNo'] ; 
                                ?>
                               <?php } ?>
                        </td>
                        <td colspan="3" ></td>
                        <td >
                            <?php 
                                $sql2 = "SELECT * FROM sales 
                                WHERE   product_id  = '".$rep['product_id']."'";
                                $query2 = mysqli_query($connect , $sql2 );
                                while ($result2 = mysqli_fetch_array($query2)) { 
                                echo  $result2['product_quantity'] ; 
                                ?>
                               <?php } ?>
                        </td>
                        <td >
                            <?php 
                                $sql2 = "SELECT * FROM sales INNER JOIN product_price 
                                ON sales.product_id = product_price.product_id
                                WHERE   sales.product_id  = '".$rep['product_id']."'";
                                $query2 = mysqli_query($connect , $sql2 );
                                while ($result2 = mysqli_fetch_array($query2)) { 
                                echo  $result2['product_price_sell'] ; 
                                ?>
                               <?php } ?>
                        </td>
                        <td >
                            <?php 
                                  $sql2 = "SELECT * FROM sales INNER JOIN product_price 
                                  ON sales.product_id = product_price.product_id
                                  WHERE   sales.product_id  = '".$rep['product_id']."'";
                                $query2 = mysqli_query($connect , $sql2 );
                                while ($result2 = mysqli_fetch_array($query2)) { 
                                    echo $result2['product_price_sell'] * $result2['product_quantity'];
                                ?>
                               <?php } ?>
                        </td>
                        
                     </tr>
                           </tr>
                          
                        </tr>
                      
                        
                        <?php } ?>
                        <?php }else{ ?>
                        <p>ไม่มี</p>
                        <?php } ?>

                        <tr class="text-right">
                            <?php 	 
                          $sql2 = "SELECT * , SUM(product_price.product_price_sell * sales.product_quantity) AS sumqtysell  
                           FROM sales INNER JOIN product_price 
                          ON sales.product_id = product_price.product_id";
                           $re = mysqli_query($connect, $sql2);	
                           $ree = mysqli_fetch_array($re); ?>
                            <td colspan="4" align="center">ยอดรวม</td>
                            <td><?php echo number_format($ree['sumqtysell'],2) ?>  </td>

                        <?php } ?>

                        <?php
							$i = 1;
							if ($report == 1 || $report == "" ) { ?>
                        <?php if ($ds && $de) { ?>
                        <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                        <?php } ?>

                        <?php 

													while ($rep = mysqli_fetch_assoc($re)) { 
                                                        $sum = 0 ;
                                                        $sum = $rep['product_quantity'] * $rep['product_price_sell'] ;
                                                          ?>
                        <tr bgcolor=#e5e5e5 class="text-right">
                            <th scope="row"><?php echo $i++   ?></th>
                            <td class="col-2"><?php echo  $rep['product_name'] ?></td>
                            <td class="col-2"><?php echo  $rep['product_id'] ?></td>
                            <td class="col-2"><?php echo  $rep['unit_name'] ?></td>
                            <td class="col-2"><?php echo  $rep['product_quantity'] ?></td>
                            <td class="col-2"><?php echo  number_format($rep['product_price_sell'],2) ?></td>
                            <td class="col-2"><?php echo  number_format($rep['qtysell'],2) ?></td>
                        </tr>
                        <?php } ?>
                        <!-- <tr class="text-right">
                            <?php 	 
                                                       $sql = "SELECT * , (b.product_quantity * c.product_price_sell )  AS sumqtysell 
                                                        FROM product AS a INNER JOIN product_quantity AS b ON a.product_id = b.product_id 
                                                        INNER JOIN product_price AS c ON a.product_id = c.product_id  ";
                                                       $re = mysqli_query($connect, $sql);	
                                                       $ree = mysqli_fetch_array($re);														 
                                                           ?>
                            <td colspan="6" align="center">ยอดรวม</td>
                            <td><?php echo number_format($ree['sumqtysell'],2) ?> บาท </td> -->
                  

                      

                        <?php } ?>



</div>





<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--  เรียกใช้ Font Awesome-->
<script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

<script src="http://fordev22.com/picker_date_thai.js"></script>
<!------ Include the above in your HEAD tag ---------->



<script>
picker_date(document.getElementById("my_date"), {
    year_range: "-45:+10"
});
picker_date(document.getElementById("my_date2"), {
    year_range: "-45:+10"
});
</script>