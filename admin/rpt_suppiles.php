<?php require 'rpt_detailsql_suppiles.php' ?>
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
<?php $today = date("Y-M-d");   ?>
<div class="row">
    <div class="col-md-12">

        ร้านขายยาดาชัย์ By เจ๊แนน<br><span>286/3 แขวง บางชัน เขต คลองสามวา จังหวัด กรุงเทพฯ 10510</span>
        <br>
        <br>

        <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="291" align="center"><span class="style2">รายการซัพพลายเซน</span></td>

            </tr>
            <tr>
                <td height="27" align="center"><span class="style2">วันที่ : <?php echo datethai($today) ?> </span></td>
            </tr>

        </table>
        <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
               </table>
        <br>
        <table bordercolor="#424242" width="800" height="78" border="1" align="center" cellspacing="0" class="style3">
            <tr align="center">
                <td width="44" height="23" align="center" bgcolor="#D5D5D5"><strong>ลำดับ</strong></td>
                <td width="200" height="23" align="center" bgcolor="#D5D5D5"><strong>รายชื่อ</strong></td>
                <td width="178" align="center" bgcolor="#D5D5D5"><strong>อีเมล์</strong></td>
                <td width="178" align="center" bgcolor="#D5D5D5"><strong>เบอร์โทรศัพท์มือถือ</strong></td>
                <!-- <td width="178" align="center" bgcolor="#D5D5D5"><strong>ราคาสินค้าทั้งหมด</strong></td> -->
            </tr>
            <?php
            $i = 1; ?>
            <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                <tr class="text-center">
                    <td align="center" class="style3"><?= $i++ ?></td>
                    <td align="left" class="style3"><?= $result['partner_name'] ?></td>
                    <td align="right" class="style3"><?= $result['partner_email'] ?></td>
                    <td align="right" class="style3"><?= $result['partner_phone'] ?></td>
                </tr>
                <tr>
                            <?php } ?>
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