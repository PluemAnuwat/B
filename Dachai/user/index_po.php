<?php require 'indexsql_po.php' ?>

<div class="row">
    <div class="col-md-12">
        <h2>รายการใบสั่งซื้อ</h2>
    </div>
</div>
<hr />
<a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill btn-primary">เพิ่มสินค้า</a>
<a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
<hr />
<table class="table table-striped table-bordered table-hover">
    <thead>
        <th scope="col">ลำดับ</th>
        <th scope="col">เลขที่เอกสาร</th>
        <th scope="col">วันที่ออกเอกสาร</th>
        <th scope="col">รหัสผู้ขาย</th>
        <th scope="col">ชื่อผู้ขาย</th>
        <th scope="col">จำนวนสินค้า</th>
        <th scope="col">จำนวนเงินทั้งสิ้น</th>
        <th scope="col">สถานะ</th>
        <th scope="col">ผู้รับผิดชอบ</th>
        <th scope="col">เมนู</th>
    </thead>
    <tbody>
        <?php $i = 1;
        while ($rowp = mysqli_fetch_array($rp)) { ?>
            <tr>
                <td class="col-2"><?php echo $i++ ?></td>
                <td class="col-2"><?php echo  $rowp['po_RefNo'] ?></td>
                <td class="col-2"><?php echo  datethai($rowp['po_Create']) ?></td>
                <td class="col-2"><?php echo  $rowp['partner_id'] ?></td>
                <td class="col-2"><?php echo  $rowp['partner_name'] ?></td>
                <td class="col-2"><?php echo  $rowp['count'] ?></td>
                <td class="col-2"><?php echo  number_format($rowp['sum'], 2) ?> บาท</td>
                <?php if ($rowp['po_status'] == "ยกเลิกการสั่งซื้อ") { ?>
                    <td class="col-2"><a class="text-danger"><?php echo  $rowp['po_status'] ?></a></td>
                <?php } elseif ($rowp['po_status'] == "ได้รับสินค้าแล้ว") { ?>
                    <td class="col-2"><a class="text-success"><?php echo  $rowp['po_status'] ?></a></td>
                <?php } else { ?>
                    <td class="col-2"><a class="text-primary"><?php echo  $rowp['po_status'] ?></a></td>
                <?php } ?>
                <td class="col-2"><?php echo  $_SESSION['user_login'] ?></td>
                <td>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">เมนู<span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <?php if ($rowp['po_status'] == 'ยกเลิกการสั่งซื้อ') { ?>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=detail&po_RefNo=<?= $rowp['po_RefNo'] ?>">ดูรายละเอียด</a></li>
                                <!-- <li><a href="?page=<?= $_GET['page'] ?>&function=good&po_id=<?= $rowp['po_id'] ?>">ทำการส่งใบสั่งซื้อ</a></li> -->
                                <!-- <li><a href="?page=<?= $_GET['page'] ?>&function=status&po_RefNo=<?= $rowp['po_RefNo'] ?>">ยกเลิกการสั่งซื้อ</a></li> -->
                            <?php } elseif ($rowp['po_status'] == 'สั่งซื้อสินค้าแล้ว รอใบรับสินค้า') { ?>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=detail&po_RefNo=<?= $rowp['po_RefNo'] ?>">ดูรายละเอียด</a></li>
                                <!-- <li><a href="?page=<?= $_GET['page'] ?>&function=good&po_id=<?= $rowp['po_id'] ?>">ทำการส่งใบสั่งซื้อ</a></li>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=status&po_RefNo=<?= $rowp['po_RefNo'] ?>">ยกเลิกการสั่งซื้อ</a></li> -->
                            <?php } elseif ($rowp['po_status'] == 'ได้รับสินค้า เข้าสต็อกแล้ว') { ?>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=detail&po_RefNo=<?= $rowp['po_RefNo'] ?>">ดูรายละเอียด</a></li>
                                <!-- <li><a href="?page=<?= $_GET['page'] ?>&function=good&po_id=<?= $rowp['po_id'] ?>">ทำการส่งใบสั่งซื้อ</a></li>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=status&po_RefNo=<?= $rowp['po_RefNo'] ?>">ยกเลิกการสั่งซื้อ</a></li> -->
                            <?php } elseif ($rowp['po_status'] == 'รอทำการส่งใบสั่งซื้อ') { ?>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=detail&po_RefNo=<?= $rowp['po_RefNo'] ?>">ดูรายละเอียด</a></li>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=good&po_RefNo=<?= $rowp['po_RefNo'] ?>">ทำการส่งใบสั่งซื้อ</a></li>
                                <li><a href="?page=<?= $_GET['page'] ?>&function=status&po_RefNo=<?= $rowp['po_RefNo'] ?>">ยกเลิกการสั่งซื้อ</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>