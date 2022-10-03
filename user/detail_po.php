<?php require  'detailsql_po.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>รายละเอียดใบสั่งซื้อ</h2>
    </div>
</div>
<hr />
<h6 class="text-muted"><a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a></h6>
<a  class="btn btn-primary" href="?page=<?= $_GET['page'] ?>&function=rptdetail&po_RefNo=<?php echo  $result1['po_RefNo'] ?>">PDF</a>


<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                รายการสินค้า
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">รายการ</a>
                    </li>
                    <li class=""><a href="#profile" data-toggle="tab">สถานะ</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                        <br>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="text-nowrap">
                                    <td>วันที่ออกใบสั่งซื้อ</td>
                                    <td>รายการ</td>
                                    <td>จำนวน</td>
                                    <td>ราคา</td>
                                    <td>รวม(บาท)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td><?php echo  datethai($row['po_Create'])  ?></td>
                                        <td class="col-2"><?php echo  $row['product_name'] ?></td>
                                        <td class="col-2"><?php echo  $row['product_quantity'] ?></td>
                                        <td class="col-2"><?php echo  number_format($row['product_price_cost'], 2) ?></td>
                                        <td class="col-2"><?php echo  number_format($row['plusel'], 2) ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>ราคารวม</td>
                                    <td><?php echo number_format($result1['qty'], 2) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>ภาษี(7%)</td>
                                    <td><?php echo number_format($result1['vatt'], 2) ?> บาท</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>ราคารวมภาษี</td>
                                    <td><?php echo number_format($result1['vat'], 2) ?> บาท</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="profile">
                        <br>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="text-nowrap">
                                    <td>วันที่เปลี่ยนสถานะ</td>
                                    <td>สถานะ</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row = mysqli_fetch_array($query2)) { ?>
                                    <tr>
                                        <td><?php echo  datethai($row['status_create'])  ?></td>
                                        <td class="col-2"><?php echo  $row['po_status'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>