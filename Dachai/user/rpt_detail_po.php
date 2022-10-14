<?php require 'rpt_detailsql_po.php' ?>
<?php require 'vendor.php' ?>

<style>
    body {
        font-family: 'Sarabun', sans-serif;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<?php
ob_start();
?>
<div class="row">
    <div class="col-md-12">

        ร้านขายยาดาชัย์ By เจ๊แนน<br><span>286/3 แขวง บางชัน เขต คลองสามวา จังหวัด กรุงเทพฯ 10510</span>
        <br>
        <br>

        <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="291" align="center"><span class="style2">ใบสั่งซื้อสินค้า</span></td>

            </tr>
            <tr>
                <td height="27" align="center"><span class="style2">เลขที่เอกสาร : <?php echo $result1['po_RefNo'] ?> </span></td>
            </tr>

        </table>
        <br>
        <table bordercolor="#424242" width="800" height="78" border="1" align="center" cellspacing="0" class="style3">
            <tr align="center">
                <td width="44" height="23" align="center" bgcolor="#D5D5D5"><strong>ลำดับ</strong></td>
                <td width="200" height="23" align="center" bgcolor="#D5D5D5"><strong>ซัพพลายเซน</strong></td>
                <td width="200" height="23" align="center" bgcolor="#D5D5D5"><strong>รายการสินค้า</strong></td>
                <td width="178" align="center" bgcolor="#D5D5D5"><strong>จำนวนสินค้า</strong></td>
                <td width="178" align="center" bgcolor="#D5D5D5"><strong>หน่วยนับ</strong></td>
                <td width="178" align="center" bgcolor="#D5D5D5"><strong>ราคาสินค้า</strong></td>
                <!-- <td width="178" align="center" bgcolor="#D5D5D5"><strong>ราคาสินค้าทั้งหมด</strong></td> -->
            </tr>
            <?php
            $i = 1; ?>
            <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                <tr class="text-center">
                    <td align="center" class="style3"><?= $i++ ?></td>
                    <td align="left" class="style3"><?= $result['partner_name'] ?></td>
                    <td align="left" class="style3"><?= $result['product_name'] ?></td>
                    <td align="right" class="style3"><?= $result['product_quantity'] ?></td>
                    <td align="right" class="style3"><?= $result['unit_name'] ?></td>
                    <td align="right" class="style3"><?= number_format($result['product_price_cost'], 2) ?></td>
                </tr>
                <tr>
                    <?php
                    $test = 0 ;
                    $testvat = 0;
                    $testok = 0 ;
                    // // $vat = (($result['product_quantity'] *  $result['product_price_cost'] * 0.07));
                    // $beforesum += ($result['product_quantity'] *  $result['product_price_cost']);
                    // $aftersum += $beforesum;
                    $vat = 0.07 ; 
                    $test = $result['product_quantity'] * $result['product_price_cost'];
                    @$testall += $test ; 
                    $testvat = $testall * $vat ;
                    $testok = $testall + $testvat;
                    // $sum += ($result['product_quantity'] *  $result['product_price_cost'] + $vat);
                    // echo $beforesum ; 
                    ?>
                <?php } ?>
                <td align="center" class="style3" colspan="4"><strong>รวม</strong></td>
                <td width="178" align="right" bgcolor="#D5D5D5"><strong><?php echo number_format($testok,2) ?></strong></td>
                </tr>
        </table>
        <?php
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output("MyReport.pdf");
        ob_end_flush();
        ?>
        <a href="MyReport.pdf" class="btn btn-primary">พิมพ์รายงาน PDF </a>
    </div>
</div>