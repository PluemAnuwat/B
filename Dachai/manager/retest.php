<?php
$report = $_POST["price_op"];
?>

<form name="form1" method="POST" action="">
    <select name="price_op">
        <option value="1">รายงานการสั่งซื้อ</option>
        <option value="2">รายงานการขาย</option>
    </select>
    <input type="submit" value="ดูรายงาน">
</form>

<?php if ($report == 1 || $report == "")  { ?>
<?php echo 'hello'; ?>
<?php  } elseif($report == 2) { ?>
<?php echo 'pluemmer'; ?>
<?php  } ?>