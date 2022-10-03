<?php require 'indexsql_good.php' ?>

<div class="row">
    <div class="col-md-12">
        <h2>รายการใบรับสินค้า</h2>
    </div>
</div>
<hr />
<table class="table table-striped table-bordered table-hover">
    <thead>
        <th scope="col">ลำดับ</th>
        <th scope="col">วันที่ออกใบรับสินค้า</th>
        <th scope="col">หมายเลขใบรับสินค้า</th>
        <th scope="col">หมายเลขใบสั่งซื้อสินค้า</th>
        <th scope="col">จำนวนรายการสินค้า</th>
        <th scope="col">ผู้สั่งซื้อ</th>
        <th scope="col">สถานะของใบรับสินค้า</th>
        <th scope="col">Manager</th>
    </thead>
    <tbody>
        <?php $i = 1;
        while ($rowp = mysqli_fetch_array($query)) { ?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td class="col-2"><?php echo  datethai($rowp['good_create']) ?></td>
                <td class="col-2"><?php echo  $rowp['good_RefNo'] ?></td>
                <td class="col-2"><?php echo  $rowp['po_RefNo'] ?></td>
                <td class="col-2"><?php echo  $rowp['count'] ?></td>
                <td class="col-2"><?php echo  $rowp['po_buyer'] ?></td>
                <?php if ($rowp['status'] == 0) { ?>
                    <td class="col-2"><a class="text-danger"><?php echo  $rowp['status'] ?></a></td>
                <?php } else {  ?>
                    <td class="col-2"><a class="text-success"><?php echo  $rowp['status'] ?></a></td>
                <?php } ?>
                <td><a href="?page=<?= $_GET['page'] ?>&function=detail&good_RefNo=<?= $rowp['good_RefNo'] ?>" class="btn  btn-primary">รายละเอียด</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>