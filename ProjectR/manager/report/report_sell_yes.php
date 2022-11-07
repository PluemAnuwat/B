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
        $sql = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id   group by sales.sales_RefNo ";
                 
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id  
	WHERE sales.sales_date BETWEEN '$ds' AND '$de'   group by sales.sales_RefNo  ";
	}
}else if ($report == 1) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id   group by sales.sales_RefNo 
		 ";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *   FROM sales  INNER JOIN product_price ON sales.product_id =  product_price.product_id  
	WHERE sales.sales_date BETWEEN '$ds' AND '$de'   group by sales.sales_RefNo  ";
	}
}
	$re = mysqli_query($connect, $sql);
    @$num = mysqli_num_rows($re);

?>

<table width="100%" border="0" align="center">
    <form name="form1" method="post" action="index.php?page=report_sell_yes">
        <tr>
            <td><b>กรุณาเลือกรายงาน
                    <select class="form-control" name="price_op">
                        <option value="1">รายงานยอดขาย</option>
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
                        <input id="my_date" name="datest" class="form-control" /></input>

                        <hr>
                    </div>
                    <div class="col-md-5">
                        <label>ถึง</label>
                        <input id="my_date2" name="dateed" class="form-control" /></input>
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
        <h3>รายงานการขาย</h3>
        <hr>
    </center>
    <table class="table table-striped table-bordered table-hover" id="example" cellspacing="1" cellpadding="3"
        width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
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
                <?php } ?>
                <?php
												$i = 1;
												if ($report == 1 || $report == "") { ?>
                <?php if ($ds && $de) { ?>
                <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                <?php } ?>

                <?php 
                
                if($num > 0 ){ 

                    
													while ($rep = mysqli_fetch_assoc($re)) { 
														
														
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
                        <?php echo  number_format($result['product_price_sell'],2) ?>
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
                                                                   
																	  while ($result = mysqli_fetch_array($query)){
                                                                      
                                                                        // print_r($qty); 
                         echo  number_format($result['product_price_sell'] * $result['product_quantity'],2) ; ?>
                        <?php } ?>
                    </td>
                    <td class="col-2"><?php echo  $rep['user_login'] ?></td>
                    <?php } ?>

                <tr class="text-right">
                    <?php 	 
                           $sql = "SELECT  sum(c.product_price_cost * sales.product_quantity ) AS vat ,  sales.product_id , c.product_price_sell , sales.product_quantity , sales.product_total , product.product_name 
                            FROM sales INNER JOIN product ON sales.product_id = product.product_id
                                                JOIN product_price AS c ON sales.product_id = c.product_id 
                                                WHERE sales_RefNo = '".$rep['sales_RefNo']."'    " ;
                                                     $query = mysqli_query($connect , $sql);
                                                //   print_r($sql);
                                                     while ($result = mysqli_fetch_array($query)){
                                                                              
                                                           ?>
                    <!-- <td colspan="6" align="center">ยอดรวม</td>
                    <td> <?php echo  number_format($result['vat'],2) ; ?> </td>
                    <?php     } ?> -->
                    <td></td>
                    <?php }else{ ?>

                    <h3 class="text-danger"> * ไม่มีข้อมูลที่ต้องการแสดง</h3>
                    <?php     } ?>


                    <?php  } elseif ($report == 2) {   ?>
                    <?php if ($ds && $de) { ?>
                    <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                    <?php } ?>
                    <?php 
													if($num > 0 ) {	
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

                <?php }else{ ?>

                <h3 class="text-danger"> * ไม่มีข้อมูลที่ต้องการแสดง</h3>
                <?php     } ?>

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