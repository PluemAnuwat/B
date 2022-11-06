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
@$report = $_POST["price_op"];
$sql = "";
if ($report == "") {
	if ($ds == "" && $de == "") {
		$sql = "SELECT * ,a.po_saler,c.suppiles_id,c.suppiles_name AS suppiles_name  , count(a.po_RefNo) as count ,
        SUM(cc.product_price_cost *  b.product_quantity) * 0.07 + sum(cc.product_price_cost * b.product_quantity) as sum
				 FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
				  INNER JOIN product_price cc ON b.product_id = cc.product_id group by a.po_id ORDER BY a.po_create DESC ";
                 
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT * ,a.po_saler,c.suppiles_id,c.suppiles_name AS suppiles_name  , count(a.po_RefNo) as count ,
        SUM(cc.product_price_cost *  b.product_quantity) * 0.07 + sum(cc.product_price_cost * b.product_quantity) as sum
				 FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
				  INNER JOIN product_price cc ON b.product_id = cc.product_id   WHERE a.po_create BETWEEN '$ds' AND '$de' ";
	}
} else if ($report == 1) {

	if ($ds == "" && $de == "") {
		$sql = "SELECT * 
				 FROM po a 
                 INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
                 INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
				 INNER JOIN product_price cc ON b.product_id = cc.product_id 
                 group by a.po_id ORDER BY a.po_create DESC ";

	} else if ($ds != "" && $de != "") {
		// $sql = "SELECT * ,a.po_saler,c.suppiles_id,c.suppiles_name AS suppiles_name  , count(a.po_RefNo) as count ,
        // SUM(cc.product_price_cost *  b.product_quantity) * 0.07 + sum(cc.product_price_cost * b.product_quantity) as sum
		// 		 FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
		// 		  INNER JOIN product_price cc ON b.product_id = cc.product_id   WHERE a.po_create>= '$ds' AND a.po_create<='$de' ";
        //           				 print_r($sql);

            $sql = "SELECT DISTINCT(a.po_RefNo) , a.po_create  , a.po_saler , a.po_buyer , a.po_status 
            FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
            INNER JOIN suppiles c ON a.po_saler = c.suppiles_id
            INNER JOIN product_price d ON b.product_id = d.product_id
            WHERE a.po_create>= '$ds' AND a.po_create<='$de' ";
            // print_r($sql);
            // exit;

	} 
}else if ($report == 2) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id   group by sales.sales_RefNo 
		 ";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id  
	WHERE sales.sales_date BETWEEN '$ds' AND '$de'   group by sales.sales_RefNo  ";
	}
} else if ($report == 5) {
	if ($ds == "" && $de == "") {
	$sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
	FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
	INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
	INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
	INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id GROUP BY a.product_id ";
} else if ($ds != "" && $de != "") {
	$sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
	FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
	INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
	INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
	INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id GROUP BY a.product_id
	 WHERE product_start_date BETWEEN '$ds' AND product_end_date  '$de'  ";
}
} else if ($report == 6) {
	if ($ds == "" && $de == "") {
		$date = date("Y/m/d");
		$sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (a.product_quantity * product_price_sell ) AS qtysell 
        FROM product AS a 
        INNER JOIN product_price AS c ON a.product_id = c.product_id INNER JOIN product_date AS d ON a.product_id = d.product_id group by a.product_id";
		
} else if ($ds != "" && $de != "") {
	$sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (a.product_quantity * product_price_sell ) AS qtysell 
    FROM product AS a 
    INNER JOIN product_price AS c ON a.product_id = c.product_id INNER JOIN product_date AS d ON a.product_id = d.product_id group by a.product_id
	   WHERE sales_date  BETWEEN '$ds' AND '$de'  ";
}
}
	$re = mysqli_query($connect, $sql);
?>

<table width="100%" border="0" align="center">
    <form name="form1" method="post" action="index.php?page=report_po">
        <tr>
            <td><b>กรุณาเลือกรายงาน
                    <select class="form-control" name="price_op">
                        <option value="1">รายงานการสั่งซื้อ</option>
                        <option value="2">รายงานยอดขาย</option>
                        <option value="5">รายงานอายุของสินค้า</option>
                        <option value="6">รายงานสินค้าคงเหลือ</option>
                    </select>
                </b>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
                <div class="row">
                    <div class="col-md-5" id="searchdate">
                        <label>เลือกวัน
                            เริ่มจาก </label>
                        <!-- <input type="date" class="form-control" name="datest" id="datest" value=""></input> -->
                        <input id="my_date" name="datest"   class="form-control"  /></input>

                        <hr>
                    </div>
                    <div class="col-md-5">
                        <label>ถึง</label>
                        <input id="my_date2" name="dateed"   class="form-control"  /></input>
                        <!-- <input type="date" class="form-control" name="dateed" id="dateed" value=""></input> -->
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <input type="submit" class="form-control btn btn-primary text-white" value="ดูรายงาน">
                        <!-- <input class="btn btn-success btn-rounded" value="ยืนยันการขาย" onclick="window.location='?page=rpt_po';"></input> -->
                    </div>
                    <div class="col-md-4">
                        <input type="button" class="form-control btn btn-success" value="PDF"
                            onClick="printDiv('divprint')">
                    </div>
                    <div class="col-md-4">
                        <!-- <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a> -->
                    </div>
                </div>
            </td>
        </tr>
    </form>
</table>
<hr>
<!-- กดหน้ามาแล้วทำไหม เออเรอ -->
<!-- Warning: mysqli_fetch_assoc() expects parameter 1 to be mysqli_result, null given in C:\AppServ\www\B\ProjectR\user\report\report_po.php on line 187 -->

<div id="divprint">
    <?php
	if ($report == 1 || $report == "") { ?>
    <center>
        <h3>รายงานการสั่งซื้อ</h3>
        <hr>
    </center>
    <table class="table table-striped table-bordered table-hover" id="example" cellspacing="1" cellpadding="3"
        width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
        <tbody>
            <tr bgcolor=#e5e5e5>
                <th scope="col">ลำดับ</th>
                <th scope="col">เลขที่เอกสาร</th>
                <th scope="col">วันที่ออกเอกสาร</th>
                <th scope="col">ชื่อผู้ขาย</th>
                <th scope="col-1">รายการสินค้า</th>
                <th scope="col">จำนวนสินค้า</th>
                <th scope="col">ราคาต่อหน่วย</th>
                <th scope="col">ราคารวม</th>
                <th scope="col">สถานะ</th>
                <th scope="col">ผู้รับผิดชอบ</th>
            </tr>
        </tbody>
        <?php  } elseif ($report == 2) { ?>
        <hr>
        <div class="col-md-12">
            <!-- <a href="?page=<?= $_GET['page'] ?>&function=rptsales_chart" type="button" class="btn btn-success ">รายงานยอดขายแบบแผนภูมิแท่ง</a> -->
            <a href="?page=<?= $_GET['page'] ?>&function=rptsales_day" type="button"
                class="btn btn-info  text-white">รายงานสรุปยอดขายแบบรายวัน</a>
            <a href="?page=<?= $_GET['page'] ?>&function=rptsales_month" type="button"
                class="btn btn-primary  text-white">รายงานสรุปยอดขายแบบรายเดือน</a>
            <a href="?page=<?= $_GET['page'] ?>&function=rptsales_year" type="button"
                class="btn btn-danger  text-white">รายงานสรุปยอดขายแบบรายปี</a>
        </div>
        <hr>

        <hr>

        <center>
            <h3>รายงานการขายทั้งหมด</h3>
        </center>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
            cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
            <tbody>
                <tr bgcolor="#e5e5e5" align="center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">วันที่ขาย</th>
                    <th scope="col">หมายเลขการขาย</th>
                    <th scope="col">รายการสินค้า</th>
                    <th scope="col">ราคาขายสินค้า</th>
                    <th scope="col">จำนวนสินค้า</th>
                    <th scope="col">ราคาสินค้ารวมต่อหน่วย</th>
                    <th scope="col">ผู้ขาย</th>
                </tr>
                <?php  } elseif ($report == 5) {  ?>
                <center>
                    <h3>รายงานอายุของสินค้า</h3>
                </center>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
                    cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
                    <tbody>
                        <tr bgcolor="#e5e5e5" align="center">
                            <th scope="col" rowspan="2">รหัสสินค้า</th>
                            <th scope="col" rowspan="2">ชื่อสินค้า</th>
                            <!-- <th scope="col" rowspan="2">ซัพพลายเซน / ผู้ขาย </th> -->
                            <th scope="col" rowspan="2">วันผลิต</th>
                            <th scope="col" rowspan="2">วันหมดอายุ</th>
                            <th scope="col" colspan="5">ช่วงอายุของสินค้า</th>
                            <!--<th scope="col">จำนวนวันคงเหลือ</th> -->
                        </tr>
                        <tr bgcolor="#e5e5e5" align="center">
                            <th scope="col">จำนวนวัน</th>
                        </tr>
                        <?php  } elseif ($report == 6) {  ?>
                        <center>
                            <h3>รายงานสินค้าคงเหลือ</h3>
                        </center>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                            cellspacing="1" cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center"
                            height="10">
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
                                <?php } ?>
                                <?php
												$i = 1;
												if ($report == 1 || $report == "") { ?>
                                <?php if ($ds && $de) { ?>
                                <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                                <?php } ?>

                                <?php 
													while ($rep = mysqli_fetch_assoc($re)) { 
														
														
														?>
                                <tr bgcolor="#e5e5e5" align="">
                                    <td class=""><?php echo $i++ ?></td>
                                    <td class="col-2"><?php echo  $rep['po_RefNo'] ?></td>
                                    <td class="col-2"><?php echo datethai($rep['po_create']) ?></td>
                                    <td class="col-2">
                                    <?php 	echo  $rep['suppiles_name'] ;?>		
                                    </td>
                                    <td class="col-2">
                                        <?php $sss = "SELECT * FROM po aa INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id  
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        $i = 1 ;
                                        while($ccc = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo $i++ ; echo "." ;  echo  $ccc['product_name'] ; echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="col-1">
                                        <?php $sss = "SELECT b.product_quantity as product_quantity  FROM po aa INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                INNER JOIN unit u ON b.product_unit = u.unit_id
                                  WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        while($ccc = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo  $ccc['product_quantity'] ; echo "  " ; echo $ccc['unit_name'] ;   echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="col-2 text-right">
                                        <?php $sss = "SELECT * FROM po aa INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                INNER JOIN unit u ON b.product_unit = u.unit_id
                                INNER JOIN product_price d ON b.product_id = d.product_id
                                  WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        while($ccc = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo  $ccc['product_price_cost']    ; echo " " ;  echo "บาท" ;    echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <td class="col-2 text-right">
                                        <?php $sss = "SELECT * FROM po aa 
                                        INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                INNER JOIN unit u ON b.product_unit = u.unit_id
                                INNER JOIN product_price d ON b.product_id = d.product_id
                                  WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        while($ccc = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo  $ccc['product_quantity'] * $ccc['product_price_cost'] ;  echo " " ;  echo "บาท" ;    echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <?php if ($rep['po_status'] == "ยกเลิกการสั่งซื้อ") { ?>
                                    <td class="col-2"><a class="text-danger"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } elseif ($rep['po_status'] == "ได้รับสินค้าแล้ว") { ?>
                                    <td class="col-2"><a class="text-success"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } else { ?>
                                    <td class="col-2"><a class="text-primary"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } ?>
                                    <td class="col-2"><?php echo  $rep['po_buyer'] ?></td>
                                    <?php } ?>
                                    <?php  } elseif ($report == 2) {   ?>
                                    <?php if ($ds && $de) { ?>
                                    <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                                    <?php } ?>
                                    <?php 
														
														while ($rep = mysqli_fetch_array($re)) {
															  ?>
                                <tr bgcolor=#e5e5e5>
                                    <th scope="row"><?php echo $i++ ?></th>
                                    <td class="col-2"><?php echo  datethai($rep['sales_date']) ?></td>
                                    <td class="col-2"><?php echo  $rep['sales_RefNo'] ?></td>
                                    <td>
                                        <?php $sql = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  FROM sales INNER JOIN product ON sales.product_id = product.product_id
																 JOIN product_price AS c ON sales.product_id = c.product_id 
																 WHERE sales_RefNo = '".$rep['sales_RefNo']."'    " ;
																	  $query = mysqli_query($connect , $sql);
																	  while ($result = mysqli_fetch_array($query)){ ?>
                                        <?php echo  $result['product_name'] ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                    <?php $sql = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  FROM sales INNER JOIN product ON sales.product_id = product.product_id
																 JOIN product_price AS c ON sales.product_id = c.product_id 
																 WHERE sales_RefNo = '".$rep['sales_RefNo']."'    " ;
																	  $query = mysqli_query($connect , $sql);
																	  while ($result = mysqli_fetch_array($query)){ ?>
                                    <?php echo  $result['product_price_sell'] ?>
                                    <?php } ?>
                                    </td>
                                        <td>
                                        <?php $sql = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  FROM sales INNER JOIN product ON sales.product_id = product.product_id
                                                                    JOIN product_price AS c ON sales.product_id = c.product_id 
                                                                    WHERE sales_RefNo = '".$rep['sales_RefNo']."'    " ;
                                                                        $query = mysqli_query($connect , $sql);
                                                                        while ($result = mysqli_fetch_array($query)){ ?>
                                        <?php echo  $result['product_quantity'] ?>
                                        <?php } ?>
                                        </td>
                                        <td>
                                    <?php $sql = "SELECT sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name  FROM sales INNER JOIN product ON sales.product_id = product.product_id
																 JOIN product_price AS c ON sales.product_id = c.product_id 
																 WHERE sales_RefNo = '".$rep['sales_RefNo']."'    " ;
																	  $query = mysqli_query($connect , $sql);
																	  while ($result = mysqli_fetch_array($query)){ ?>
                                    <?php echo  $result['product_price_sell'] * $result['product_quantity'] ; ?>
                                    <?php } ?>
                                    </td>
                                    <td class="col-2"><?php echo  $rep['user_login'] ?></td>

                                </tr>

                                <?php } ?>
                                <?php if ($ds != '' && $de != '') { ?>
                                <?php $sql = "select SUM(product_price_sell) AS sumproduct_price_sell , SUM(product_quantity) AS sumproduct_quantity , 
														SUM(product_total) AS sumproduct_total 
														from sales INNER JOIN product_price ON sales.product_id = product_price.product_id
                                                        WHERE sales_date BETWEEN '$ds' AND '$de' ";
														$query = mysqli_query($connect, $sql);
														$retotal = mysqli_fetch_assoc($query); ?>
                                <footer>
                                    <tr style="background-color:#cccccc">
                                        <td colspan="4" class="text-center">รวม</td>
                                        <td colspan="1">
                                            <?php echo  number_format($retotal['sumproduct_price_sell'], 2) ?></td>
                                        <td colspan="1"><?php echo  ($retotal['sumproduct_quantity']) ?></td>
                                        <td colspan="1"><?php echo  number_format($retotal['sumproduct_total'], 2) ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                </footer>
                                <?php }else{?>
                                <?php $sql = "select SUM(product_price_sell) AS sumproduct_price_sell , SUM(product_quantity) AS sumproduct_quantity , 
														SUM(product_total) AS sumproduct_total 
														from sales INNER JOIN product_price ON sales.product_id = product_price.product_id
                                                    ";
														$query = mysqli_query($connect, $sql);
														$retotal = mysqli_fetch_assoc($query); ?>
                                <footer>
                                    <tr style="background-color:#cccccc">
                                        <td colspan="4" class="text-center">รวม</td>
                                        <td colspan="1">
                                            <?php echo  number_format($retotal['sumproduct_price_sell'], 2) ?></td>
                                        <td colspan="1"><?php echo  ($retotal['sumproduct_quantity']) ?></td>
                                        <td colspan="1"><?php echo  number_format($retotal['sumproduct_total'], 2) ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                </footer>
                                <?php } ?>
                                <?php } elseif ($report == 5) {
															while ($rep = mysqli_fetch_array($re)) {
																$case_notify = status_date_notify(($rep['product_end_date'])); ?>
                                <tr bgcolor=#e5e5e5>
                                    <th scope="row"><?php echo $rep['product_id'] ?></th>
                                    <td class="col-2"><?php echo ($rep['product_name']) ?></td>
                                    <!-- <td class="col-2"><?php echo ($rep['po_buyer']) ?></td> -->
                                    <td class="col-2"><?php echo dateThai($rep['product_start_date']) ?></td>
                                    <td class="col-2"><?php echo dateThai($rep['product_end_date']) ?></td>
                                    <?php switch ($case_notify) {
																	case 5: ?>
                                    <td scope="col" class="text-center">หมดอายุ</td>
                                    <td></td>
                                    <?php break;
																	case 4: ?>
                                    <td scope="col" class="text-center">1-7 วัน</td>

                                    <?php break;
																	case 3: ?>
                                    <td scope="col" class="text-center">8-15 วัน</td>

                                    <?php break;
																	case 2: ?>


                                    <td scope="col" class="text-center">16-30 วัน</td>

                                    <?php break;
																	default ?>
                                    <td scope="col" class="text-center">ยังไม่หมดอายุ</td>
                                    <?php } ?>
                                    <?php } ?>


                                    <?php  } elseif ($report == 6) {
														$i=1; ?>
                                    <?php while ($rep = mysqli_fetch_array($re)) {
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
                                <tr class="text-right">
                                    <?php 	 
															$sql = "SELECT * , SUM(b.product_quantity * c.product_price_sell )  AS sumqtysell 
															 FROM product AS a INNER JOIN product_quantity AS b ON a.product_id = b.product_id 
															 INNER JOIN product_price AS c ON a.product_id = c.product_id  ";
															$re = mysqli_query($connect, $sql);	
															$ree = mysqli_fetch_array($re);														 
																?>
                                    <td colspan="6" align="center">ยอดรวม</td>
                                    <td><?php echo number_format($ree['sumqtysell'],2) ?> บาท </td>
                                </tr>
                                <a class="text-danger"> *ถ้าราคาต่อหน่วย เป็นเลข 0 แปลว่า ยังไม่ได้กำหนดราคาขาย </a>
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

picker_date(document.getElementById("my_date"),{year_range:"-45:+10"});
picker_date(document.getElementById("my_date2"),{year_range:"-45:+10"});

</script>