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
        // $sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
        // FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
        // INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
        // INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
        // INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id GROUP BY a.product_id ";

        $sql = "SELECT * FROM     product AS a INNER JOIN product_date b ON a.product_id = b.product_id ";
	} else if ($ds != "" && $de != "") {
        $sql = "SELECT * FROM     product AS a INNER JOIN product_date b ON a.product_id = b.product_id 
         WHERE b.product_start_date >= '$ds' AND b.product_end_date <=  '$de'  ";
	}
} else if ($report == 1) {

	if ($ds == "" && $de == "") {
        $sql = "SELECT * FROM     product AS a INNER JOIN product_date b ON a.product_id = b.product_id ";

	} else if ($ds != "" && $de != "") {
        $sql = "SELECT * FROM     product AS a INNER JOIN product_date b ON a.product_id = b.product_id 
        WHERE b.product_start_date >= '$ds' AND b.product_end_date <=  '$de'  ";
        //  print_r($sql);
	} 
}else if ($report == 2) {
	if ($ds == "" && $de == "") {
        $sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
        FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
        INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
        INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
        INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id
        WHERE DATEDIFF(b.product_end_date,b.product_start_date)  > '1' AND  
        DATEDIFF(b.product_end_date,b.product_start_date) <= '30'
        GROUP BY a.product_id  ";
        // print_r($sql);
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
	FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
	INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
	INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
	INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id 
	 WHERE product_start_date >= '$ds' AND product_end_date  <= '$de'  AND
     DATEDIFF(b.product_end_date,b.product_start_date)  > '1' AND  
        DATEDIFF(b.product_end_date,b.product_start_date) <= '30' GROUP BY a.product_id ";
        // print_r($sql);
	}
} else if ($report == 5) {
	if ($ds == "" && $de == "") {
	$sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
	FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
	INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
	INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
	INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id 
    WHERE  b.product_end_date <= NOW()   GROUP BY a.product_id ";
} else if ($ds != "" && $de != "") {
	$sql = "SELECT * , DATEDIFF(b.product_end_date,b.product_start_date) AS datediff 
	FROM product AS a INNER JOIN product_date b ON a.product_id = b.product_id  
	INNER JOIN product_quantity AS c ON a.product_id = c.product_id   
	INNER JOIN product_reorder AS bbb ON a.product_id = bbb.product_id
	INNER JOIN product_price AS ccc ON a.product_id = ccc.product_id 
	 WHERE b.product_start_date >= '$ds' AND b.product_end_date <= '$de' AND b.product_end_date <= NOW()  GROUP BY a.product_id ";
}
}
	$re = mysqli_query($connect, $sql);
    @$num = mysqli_num_rows($re);
?>

<table width="100%" border="0" align="center">
    <form name="form1" method="post" action="index.php?page=report_age_yes">
        <tr>
            <td><b>กรุณาเลือกรายงาน
                    <select class="form-control" name="price_op">
                        <option value="1">รายงานอายุของสินค้าทั้งหมด</option>
                        <option value="2">รายงานอายุของสินค้าที่ใกล้หมดอายุ</option>
                        <option value="5">รายงานอายุของสินค้าที่หมดอายุแล้ว</option>
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

<div id="divprint">
    <?php
	if ($report == 1 || $report == "") { ?>
    <center>
        <h3>รายงานอายุของสินค้าทั้งหมด</h3>
        <hr>
    </center>
    <table class="table table-striped table-bordered table-hover" id="example" cellspacing="1" cellpadding="3"
        width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
        <tbody>
        <tr bgcolor="#e5e5e5" align="center">
                            <th scope="col" rowspan="2">รหัสสินค้า</th>
                            <th scope="col" rowspan="2">ชื่อสินค้า</th>
                            <th scope="col" rowspan="2">วันผลิต</th>
                            <th scope="col" rowspan="2">วันหมดอายุ</th>
                            <th scope="col" colspan="5">ช่วงอายุของสินค้า</th>
                        </tr>
        </tbody>
        <?php  } elseif ($report == 2) {  ?>
                <center>
                    <h3>รายงานอายุของสินค้าที่ใกล้หมดอายุ</h3>
                </center>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
                    cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
                    <tbody>
                        <tr bgcolor="#e5e5e5" align="center">
                            <th scope="col" rowspan="2">รหัสสินค้า</th>
                            <th scope="col" rowspan="2">ชื่อสินค้า</th>
                            <th scope="col" rowspan="2">วันผลิต</th>
                            <th scope="col" rowspan="2">วันหมดอายุ</th>
                            <th scope="col" colspan="5">ช่วงอายุของสินค้า</th>
                        </tr>
                        </tbody>
                <?php  } elseif ($report == 5) {  ?>
                <center>
                    <h3>รายงานอายุของสินค้าที่หมดอายุแล้ว</h3>
                </center>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
                    cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
                    <tbody>
                        <tr bgcolor="#e5e5e5" align="center">
                            <th scope="col" rowspan="2">รหัสสินค้า</th>
                            <th scope="col" rowspan="2">ชื่อสินค้า</th>
                            <th scope="col" rowspan="2">วันผลิต</th>
                            <th scope="col" rowspan="2">วันหมดอายุ</th>
                            <th scope="col" colspan="5">ช่วงอายุของสินค้า</th>
                        </tr>
                        </tbody>
                                <?php } ?>
                                <?php
												$i = 1;
												if ($report == 1 || $report == "") { ?>
                                <?php if ($ds && $de) { ?>
                                <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                                <?php } ?>

                                <?php 
                                if($num > 0 ) {
													while ($rep = mysqli_fetch_assoc($re)) { 
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
                                    <?php }else{ ?>

<h3 class="text-danger"> *  ไม่มีข้อมูลที่ต้องการแสดง</h3> 
<?php     } ?>

                                    <?php } elseif ($report == 2) {
                                        if($num > 0 ) {
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
                                    <?php }else{ ?>

<h3 class="text-danger"> *  ไม่มีข้อมูลที่ต้องการแสดง</h3> 
<?php     } ?>


                                <?php } elseif ($report == 5) {
                                    if($num > 0 ) {
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
                                    <?php }else{ ?>

<h3 class="text-danger"> *  ไม่มีข้อมูลที่ต้องการแสดง</h3> 
<?php     } ?>



                                
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