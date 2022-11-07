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
				  INNER JOIN product_price cc ON b.product_id = cc.product_id group by a.po_id ORDER BY a.po_create   DESC ";
                 
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
                 WHERE a.po_status = 'สั่งแล้ว'
                 group by a.po_id ORDER BY a.po_create DESC ";

	} else if ($ds != "" && $de != "") {
            $sql = "SELECT DISTINCT(a.po_RefNo) , a.po_create  , a.po_saler , a.po_buyer , a.po_status 
            FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
            INNER JOIN suppiles c ON a.po_saler = c.suppiles_id
            INNER JOIN product_price d ON b.product_id = d.product_id
            WHERE a.po_create>= '$ds' AND a.po_create<='$de' AND a.po_status = 'สั่งแล้ว' ";
            // print_r($sql);
            // exit;

	} 
}else if ($report == 2) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT * 
				 FROM po a 
                 INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
                 INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
				 INNER JOIN product_price cc ON b.product_id = cc.product_id 
                 WHERE a.po_status = 'รอยืนยัน'
                 group by a.po_id ORDER BY a.po_create DESC ";
	} else if ($ds != "" && $de != "") {
        $sql = "SELECT DISTINCT(a.po_RefNo) , a.po_create  , a.po_saler , a.po_buyer , a.po_status 
        FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
        INNER JOIN suppiles c ON a.po_saler = c.suppiles_id
        INNER JOIN product_price d ON b.product_id = d.product_id
        WHERE a.po_status = 'รอยืนยัน'
        WHERE a.po_create>= '$ds' AND a.po_create<='$de' ";
	}
} else if ($report == 5) {
	if ($ds == "" && $de == "") {
        $sql = "SELECT * 
        FROM po a 
        INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
        INNER JOIN suppiles c ON a.po_saler = c.suppiles_id 
        INNER JOIN product_price cc ON b.product_id = cc.product_id 
        WHERE a.po_status = 'ยกเลิก'
        group by a.po_id ORDER BY a.po_create DESC ";
} else if ($ds != "" && $de != "") {
    $sql = "SELECT DISTINCT(a.po_RefNo) , a.po_create  , a.po_saler , a.po_buyer , a.po_status 
    FROM po a INNER JOIN po_detailproduct b ON a.po_id = b.po_id 
    INNER JOIN suppiles c ON a.po_saler = c.suppiles_id
    INNER JOIN product_price d ON b.product_id = d.product_id
    WHERE a.po_status = 'ยกเลิก'
    WHERE a.po_create>= '$ds' AND a.po_create<='$de' ";
}

}
	$re = mysqli_query($connect, $sql);
    @$num = mysqli_num_rows($re);
?>

<table width="100%" border="0" align="center">
    <form name="form1" method="post" action="index.php?page=report_po_yes">
        <tr>
            <td><b>กรุณาเลือกรายงาน
                    <select class="form-control" name="price_op">
                        <option value="1">รายงานการสั่งซื้อที่ผ่านการยืนยันแล้ว</option>
                        <option value="2">รายงานการสั่งซื้อที่รอยืนยัน</option>
                        <option value="5">รายงานการสั่งซื้อที่ยกเลิก</option>
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
        <h3>รายงานการสั่งซื้อที่ผ่านการยืนยันแล้ว</h3>
        <hr>
    </center>
    <table class="table table-striped table-bordered table-hover" id="example" cellspacing="1" cellpadding="3"
        width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
        <tbody>
            <tr bgcolor=#e5e5e5>
                <!-- <th scope="col">ลำดับ</th> -->
                <th scope="col">เลขที่เอกสาร</th>
                <th scope="col">วันที่ออกเอกสาร</th>
                <th scope="col">ชื่อผู้ขาย</th>
                <th scope="col-1">รายการสินค้า</th>
                <th scope="col">จำนวนสินค้า</th>
                <th scope="col">ราคาต่อหน่วย</th>
                <!-- <th scope="col">ราคารวม</th> -->
                <th scope="col">สถานะ</th>
                <th scope="col">ผู้รับผิดชอบ</th>
            </tr>
        </tbody>
        <?php  } elseif ($report == 2) { ?>
        

        <hr>

        <center>
            <h3>รายงานการสั่งซื้อที่รอยืนยัน</h3>
        </center>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
            cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
            <tbody>
            <tr bgcolor=#e5e5e5>
                <!-- <th scope="col">ลำดับ</th> -->
                <th scope="col">เลขที่เอกสาร</th>
                <th scope="col">วันที่ออกเอกสาร</th>
                <th scope="col">ชื่อผู้ขาย</th>
                <th scope="col-1">รายการสินค้า</th>
                <th scope="col">จำนวนสินค้า</th>
                <th scope="col">ราคาต่อหน่วย</th>
                <!-- <th scope="col">ราคารวม</th> -->
                <th scope="col">สถานะ</th>
                <th scope="col">ผู้รับผิดชอบ</th>
            </tr>
                <?php  } elseif ($report == 5) {  ?>
                <center>
                    <h3>รายงานการสั่งซื้อที่ยกเลิก</h3>
                </center>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1"
                    cellpadding="3" width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
                    <tbody>
                    <tr bgcolor=#e5e5e5>
                <!-- <th scope="col">ลำดับ</th> -->
                <th >เลขที่เอกสาร</th>
                <th >วันที่ออกเอกสาร</th>
                <th >ชื่อผู้ขาย</th>
                <th scope="col-5">รายการสินค้า</th>
                <th >จำนวนสินค้า</th>
                <th >ราคาต่อหน่วย</th>
                <!-- <th >ราคารวม</th> -->
                <th >สถานะ</th>
                <th >ผู้รับผิดชอบ</th>
            </tr>
                                <?php } ?>
                                <?php
												$i = 1;
												if ($report == 1 || $report == "") { ?>
                                <?php if ($ds && $de) { ?>
                                <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                                <?php } ?>


                                            <?php 
                             if($num > 0) {
													while ($rep = mysqli_fetch_assoc($re)) { 
														
														
														?>
                                <tr bgcolor="#e5e5e5" align="">
                                    <!-- <td class=""><?php echo $i++ ?></td> -->
                                    <td class="col-1"><?php echo  $rep['po_RefNo'] ?></td>
                                    <td class="col-1"><?php echo datethai($rep['po_create']) ?></td>
                                    <td class="col-1">
                                    <?php 	echo  $rep['suppiles_name'] ;?>		
                                    </td>
                                    <td class="col-5">
                                        <?php $sss = "SELECT * FROM po aa INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id  
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        $i = 1 ;
                                        while($ccc = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo $i++ ; echo "." ;  echo  $ccc['product_name'] ; echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <td >
                                        <?php $sss = "SELECT a.product_quantity as product_quantity  FROM po aa
                                         INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                INNER JOIN unit u ON b.product_unit = u.unit_id
                                  WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        while($ccc1 = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo  $ccc1['product_quantity'] ; echo "  " ; echo $ccc1['unit_name'] ;   echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <td class=" text-right">
                                        <?php $sss = "SELECT * FROM po aa 
                                        INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
                                INNER JOIN product AS b ON a.product_id = b.product_id 
                                INNER JOIN unit u ON b.product_unit = u.unit_id
                                INNER JOIN product_price d ON b.product_id = d.product_id
                                  WHERE aa.po_RefNo = '".$rep['po_RefNo']."'";
                                        $qqq = mysqli_query($connect , $sss);
                                        while($ccc2 = mysqli_fetch_array($qqq)){ ?>
                                        <?php echo  number_format($ccc2['product_price_cost'],2)    ; echo " " ;    echo '<br>' ; ?>
                                        <?php } ?>
                                    </td>
                                    <!-- <td class="text-right">
                                        <?php $sss = "SELECT * ,(cc.product_price_cost * aa.product_quantity) as plusel ,
                                            aa.product_quantity as product_quantity
                                            FROM po a join po_detailproduct aa ON a.po_id = aa.po_id JOIN product b ON aa.product_id = b.product_id 
                                            join product c on aa.product_id = c.product_id JOIN product_price cc ON c.product_id = cc.product_id
                                            INNER JOIN suppiles ddk ON a.po_saler = ddk.suppiles_id
                                            WHERE a.po_RefNo = '".$rep['po_RefNo']."' " ;
                                            $qqq = mysqli_query($connect , $sss);
                                                $ccc3 = mysqli_fetch_array($qqq);
                                            ?>
                                        <?php echo  number_format($ccc3['plusel'],2)  ;  echo " " ;   echo '<br>' ; ?>
                                    </td> -->
                                    <?php if ($rep['po_status'] == "ยกเลิกการสั่งซื้อ") { ?>
                                    <td class="col-2"><a class="text-danger"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } elseif ($rep['po_status'] == "ได้รับสินค้าแล้ว") { ?>
                                    <td class="col-2"><a class="text-success"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } else { ?>
                                    <td class="col-2"><a class="text-primary"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } ?>
                                    <td class="col-2"><?php echo  $rep['po_buyer'] ?></td>
                                    <?php } ?>
                                    <?php }else{ ?>

                                        <h3 class="text-danger"> *  ไม่มีข้อมูลที่ต้องการแสดง</h3> 
                                <?php     } ?>
                      
                                 


                                    <?php  } elseif ($report == 2) {   ?>
                                    <?php if ($ds && $de) { ?>
                                    <center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
                                    <?php } ?>
                                    <?php 
														  if($num > 0) {
														while ($rep = mysqli_fetch_array($re)) {
															  ?>
                                <tr bgcolor=#e5e5e5>
                                    <!-- <td class=""><?php echo $i++ ?></td> -->
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
                                        <?php $sss = "SELECT a.product_quantity as product_quantity  FROM po aa INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
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
                                    <!-- <td class="col-2 text-right">
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
                                    </td> -->
                                    <?php if ($rep['po_status'] == "ยกเลิกการสั่งซื้อ") { ?>
                                    <td class="col-2"><a class="text-danger"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } elseif ($rep['po_status'] == "ได้รับสินค้าแล้ว") { ?>
                                    <td class="col-2"><a class="text-success"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } else { ?>
                                    <td class="col-2"><a class="text-primary"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } ?>
                                    <td class="col-2"><?php echo  $rep['po_buyer'] ?></td>
                                    <?php } ?>

                                    <?php }else{ ?>

                                    <h3 class="text-danger"> *  ไม่มีข้อมูลที่ต้องการแสดง</h3> 
                                    <?php     } ?>
                                
                                <?php } elseif ($report == 5) {
                                    		  if($num > 0) {
															while ($rep = mysqli_fetch_array($re)) {
																$case_notify = status_date_notify(($rep['product_end_date'])); ?>
                             <tr bgcolor=#e5e5e5>
                                    <!-- <td class=""><?php echo $i++ ?></td> -->
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
                                        <?php $sss = "SELECT a.product_quantity as product_quantity  FROM po aa INNER JOIN  po_detailproduct AS a ON aa.po_id = a.po_id
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
                                    <!-- <td class="col-2 text-right">
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
                                    </td> -->
                                    <?php if ($rep['po_status'] == "ยกเลิกการสั่งซื้อ") { ?>
                                    <td class="col-2"><a class="text-danger"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } elseif ($rep['po_status'] == "ได้รับสินค้าแล้ว") { ?>
                                    <td class="col-2"><a class="text-success"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } else { ?>
                                    <td class="col-2"><a class="text-primary"><?php echo  $rep['po_status'] ?></a></td>
                                    <?php } ?>
                                    <td class="col-2"><?php echo  $rep['po_buyer'] ?></td>
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