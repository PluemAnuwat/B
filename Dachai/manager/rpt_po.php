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
<?php require 'rptsql_po.php' ?>
<div class="row">
	<div class="col-md-12">
		<h2>เรียกดูรายงาน</h2>
	</div>
</div>
<hr />
<table width="91%" border="0" align="center">
	<form name="form1" method="POST" action="?page=rpt_po">
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

				<div class="col-md-6" id="searchdate">
					<label>เลือกวัน
						เริ่มจาก </label>
					<input type="date" class="form-control" name="datest" id="datest" value=""></input>

					<hr>
				</div>
				<div class="col-md-6">
					<label>ถึง</label>
					<input type="date" class="form-control" name="dateed" id="dateed" value=""></input>
					<hr>
				</div>

				<div class="col-md-4">
					<input type="submit" class="form-control btn btn-primary" value="ดูรายงาน">
					<!-- <input class="btn btn-success btn-rounded" value="ยืนยันการขาย" onclick="window.location='?page=rpt_po';"></input> -->
				</div>
				<div class="col-md-4">
					<input type="button" class="form-control btn btn-success" value="print" onClick="printDiv('divprint')">
				</div>
				<div class="col-md-4">
					<a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
				</div>



			</td>
		</tr>
	</form>
</table>


<div id="divprint">
	<?php
	if ($report == 1 || $report == "") { ?>
		<center>
			<h3>รายงานการสั่งซื้อ</h3>
			<hr>
		</center>
		<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1" cellpadding="3" width="100%" bgcolor="#FFFFFF" border="1" align="center" height="10">
			<tbody>
				<tr bgcolor=#e5e5e5>
					<th scope="col">ลำดับ</th>
					<th scope="col">เลขที่เอกสาร</th>
					<th scope="col">วันที่ออกเอกสาร</th>
					<th scope="col">รหัสผู้ขาย</th>
					<th scope="col">ชื่อผู้ขาย</th>
					<th scope="col">จำนวนสินค้า</th>
					<th scope="col">จำนวนเงินทั้งสิ้น</th>
					<th scope="col">สถานะ</th>
					<th scope="col">ผู้รับผิดชอบ</th>
				</tr>
			</tbody>
		<?php  } elseif ($report == 2) { ?>
			<hr>
			<div class="col-md-12">
				<a href="?page=rptsales_chart" type="button" class="btn btn-success btn-lg">รายงานยอดขายแบบแผนภูมิแท่ง</a>
				<a href="?page=rptsales_day" type="button" class="btn btn-info btn-lg text-white">รายงานสรุปยอดขายแบบรายวัน</a>
				<a href="?page=rptsales_month" type="button" class="btn btn-primary btn-lg text-white">รายงานสรุปยอดขายแบบรายเดือน</a>
				<a href="?page=rptsales_year" type="button" class="btn btn-danger btn-lg text-white">รายงานสรุปยอดขายแบบรายปี</a>
			</div>
			<hr>
			<hr>
			<hr>

			<center>
				<h3>รายงานการขายทั้งหมด</h3>
			</center>
			<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1" cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
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
				<?php  } elseif ($report == 3) {  ?>
					<center>
						<h3>รายงานผู้ใช้งานระบบ</h3>
					</center>
					<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1" cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
						<tbody>
							<tr bgcolor="#e5e5e5" align="center">
								<th scope="col">ลำดับ</th>
								<th scope="col">รายชื่อ</th>
								<th scope="col">อีเมล์</th>
								<th scope="col">เบอร์โทรศัพท์มือถือ</th>
							</tr>
						<?php  } elseif ($report == 4) {  ?>
							<center>
								<h3>รายงานซัพพลายเซน</h3>
							</center>
							<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1" cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
								<tbody>
									<tr bgcolor="#e5e5e5" align="center">
										<th scope="col">ลำดับ</th>
										<th scope="col">รายชื่อ</th>
										<th scope="col">อีเมล์</th>
										<th scope="col">เบอร์โทรศัพท์</th>
									</tr>
								<?php  } elseif ($report == 5) {  ?>
									<center>
										<h3>รายงานอายุของสินค้า</h3>
									</center>
									<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1" cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
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
												<th scope="col">หมดอายุแล้ว</th>
												<th scope="col">1-7 วัน</th>
												<th scope="col">8-15 วัน</th>
												<th scope="col">16-30 วัน</th>
												<th scope="col">มากกว่า 30 วัน </th>
											</tr>
										<?php  } elseif ($report == 6) {  ?>
											<center>
												<h3>รายงานสินค้าคงเหลือ</h3>
											</center>
											<table class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="1" cellpadding="3" width="93%" bgcolor="#FFFFFF" border="1" align="center" height="10">
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
													<?php while ($rep = mysqli_fetch_assoc($re)) { ?>
														<tr bgcolor="#e5e5e5" align="center">
															<td class="col-2"><?php echo $i++ ?></td>
															<td class="col-2"><?php echo  $rep['po_RefNo'] ?></td>
															<td class="col-2"><?php echo datethai($rep['po_Create']) ?></td>
															<td class="col-2"><?php echo  $rep['partner_id'] ?></td>
															<td class="col-2"><?php echo  $rep['partner_name'] ?></td>
															<td class="col-2"><?php echo  $rep['count'] ?></td>
															<td class="col-2"><?php echo  number_format($rep['sum'], 2) ?> บาท</td>
															<?php if ($rep['po_status'] == "ยกเลิกการสั่งซื้อ") { ?>
																<td class="col-2"><a class="text-danger"><?php echo  $rep['po_status'] ?></a></td>
															<?php } elseif ($rep['po_status'] == "ได้รับสินค้าแล้ว") { ?>
																<td class="col-2"><a class="text-success"><?php echo  $rep['po_status'] ?></a></td>
															<?php } else { ?>
																<td class="col-2"><a class="text-primary"><?php echo  $rep['po_status'] ?></a></td>
															<?php } ?>
															<td class="col-2"><?php echo  $_SESSION['user_login'] ?></td>
														<?php } ?>
													<?php  } elseif ($report == 2) {   ?>
														<?php if ($ds && $de) { ?>
															<center> เริ่มจากวันที่ <?php echo $ds; ?> ถึงวันที่ <?php echo $de; ?> </center>
														<?php } ?>
														<?php while ($rep = mysqli_fetch_array($re)) {  ?>
														<tr bgcolor=#e5e5e5>
															<th scope="row"><?php echo $i++ ?></th>
															<td class="col-2"><?php echo  datethai($rep['sales_create']) ?></td>
															<td class="col-2"><?php echo  $rep['sales_RefNo'] ?></td>
															<td class="col-2"><?php echo  $rep['product_name'] ?></td>
															<td class="col-2"><?php echo  number_format($rep['product_price_sell'], 2) ?></td>
															<td class="col-2"><?php echo  number_format($rep['product_quantity'], 2) ?></td>
															<td class="col-2"><?php echo  number_format($rep['product_total'], 2)  ?></td>
															<td class="col-2"><?php echo  $_SESSION['user_login'] ?></td>
														<?php } ?>
														<?php $sql = "select SUM(product_price_sell) AS sumproduct_price_sell , SUM(product_quantity) AS sumproduct_quantity , 
														SUM(product_total) AS sumproduct_total from view_sales_detail LEFT JOIN product_price ON view_sales_detail.product_id = product_price.product_id";
														$query = mysqli_query($con, $sql);
														$retotal = mysqli_fetch_assoc($query); ?>
														<footer>
														<tr style="background-color:#cccccc">
															<td colspan="4" class="text-center">รวม</td>
															<td colspan="1"><?php echo  number_format($retotal['sumproduct_price_sell'], 2) ?></td>
															<td colspan="1"><?php echo  number_format($retotal['sumproduct_quantity'], 2) ?></td>
															<td colspan="1"><?php echo  number_format($retotal['sumproduct_total'], 2) ?></td>
														</tr>
														</footer>
													<?php  } elseif ($report == 3) { ?>
														<?php while ($rep = mysqli_fetch_array($re)) {  ?>
															<tr bgcolor=#e5e5e5>
																<th scope="row"><?php echo $i++ ?></th>
																<td class="col-2"><?php echo ($rep['employee_name']) ?></td>
																<td class="col-2"><?php echo  $rep['employee_email'] ?></td>
																<td class="col-2"><?php echo  $rep['employee_role'] ?></td>
																<td class="col-2"><?php echo  $rep['employee_phone'] ?></td>
															<?php } ?>
														<?php } elseif ($report == 4) { ?>
															<?php while ($rep = mysqli_fetch_array($re)) {  ?>
															<tr bgcolor=#e5e5e5>
																<th scope="row"><?php echo $i++ ?></th>
																<td class="col-2"><?php echo ($rep['partner_name']) ?></td>
																<td class="col-2"><?php echo  $rep['partner_email'] ?></td>
																<td class="col-2"><?php echo  $rep['partner_phone'] ?></td>
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
																		<td scope="col">หมดอายุ</td>
																	<?php break;
																	case 4: ?>
																		<td scope="col">1-7 วัน</td>
																	<?php break;
																	case 3: ?>
																		<td scope="col">8-15 วัน</td>
																	<?php break;
																	case 2: ?>
																		<td scope="col">16-30 วัน</td>
																	<?php break;
																	default ?>
																	<td scope="col">ยังไม่หมดอายุ</td>
															<?php } ?>
														<?php } ?>
													<?php  } elseif ($report == 6) {
														$i=1; ?>
														<?php while ($rep = mysqli_fetch_array($re)) {
															 $sum = 0 ;
															 $sum = $rep['product_quantity'] * $rep['product_price_sell'] ;
															   ?>
															<tr bgcolor=#e5e5e5>
																<th scope="row"><?php echo $i++   ?></th>					
																<td class="col-2"><?php echo  $rep['product_name'] ?></td>
																<td class="col-2"><?php echo  $rep['product_id'] ?></td>
																<td class="col-2"><?php echo  $rep['unit_name'] ?></td>
																<td class="col-2"><?php echo  $rep['product_quantity'] ?></td>
																<td class="col-2"><?php echo  number_format($rep['product_price_sell'],2) ?></td>
																<td class="col-2"><?php echo  number_format($rep['qtysell'],2) ?></td>
															</tr>
															<?php } ?>
															<tr>
																<?php 	 
															$sql = "SELECT * , SUM(product_quantity * product_price_sell )  AS sumqtysell  FROM view_product_stockv3  ";
															$re = mysqli_query($con, $sql);	
															$ree = mysqli_fetch_array($re);														 
																?>
																<td colspan="6" align="center">ยอดรวม</td>
																<td><?php echo number_format($ree['sumqtysell'],2) ?> บาท </td>
															</tr>
															<a class="text-danger"> *ถ้าราคาต่อหน่วย เป็นเลข 0 แปลว่า ยังไม่ได้กำหนดราคาขาย </a>
														<?php } ?>
												</tbody>
											</table>
											<br>
											</td>
											</tr>
									</table>
</div>