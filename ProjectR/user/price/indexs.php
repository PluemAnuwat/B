<?php require 'updatesql.php' ?>
<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<?php require 'script.php' ?>

<?php
$connect = mysqli_connect("localhost","root","akom2006","project");
$qp = "SELECT * FROM product a join product_price b on a.product_id = b.product_id   ";
$rp = mysqli_query($connect, $qp);
?>

<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            MANAGER SALE PRODUCT
        </a>
        <a  type="button" name="add" id="add" class="btn rounded-pill"><img src="../images/money-management.png"
                width="80px"></a>
    </div>
</nav>

<div class="container box">
    <div class="table-responsive">
        <br />
        <div id="alert_message"></div>
        <form method="POST">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th>ลำดับ</th>
                                <th>ชื่อสินค้า</th>
                                <th>ราคาทุน</th>
                                <th>กำหนดราคาขาย</th>
                                <th>เมนู</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($row = mysqli_fetch_array($rp)) { ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td class="col-2"><a name="product_name[<?= $row['product_id'] ?>]"><?= $row['product_name'] ?></a></td>
                                    <td class="col-2"><a name="product_price_cost[<?= $row['product_id'] ?>]"><?= $row['product_price_cost'] ?></a></td>

                                    <td class="col-2">
                                        <input type="text" class="form-control" name="product_price_sell[<?= $row['product_id'] ?>]" value="<?php echo $row['product_price_sell']?>">
                                    </td>

                                    <td> <button  type="submit" name="save_one[<?= $row['product_id'] ?>]" type="submit" class="btn btn-success text-white"> บันทึกเฉพาะแถวนี้</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง_MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });
    $('#example').DataTable();

    $('#example')
        .removeClass('display')
        .addClass('table table-bordered');
});



</script>