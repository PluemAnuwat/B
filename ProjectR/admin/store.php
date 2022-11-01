<!DOCTYPE html>
<html lang="en">
<?php include 'connect.php' ?>
<?php include 'head.php' ?>

<?php
if (isset($_GET['type_id']) & isset($_GET['type_name'])) {
  $type_id = $_GET['type_id'];
  $sql = "SELECT *   FROM product  WHERE product_type ='$type_id'  ";
  $query = mysqli_query($con, $sql);
} else {
  $sql = "SELECT *   FROM product   ";
  $query = mysqli_query($con, $sql);
}

$sql2 = "SELECT * FROM type_product";
$query2  = mysqli_query($con, $sql2);
?>

<body>
    <div class="mt-5">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <a href="?page=store" type="button" class="btn btn-primary">ทั้งหมด</a>
                    <?php while ($row = mysqli_fetch_assoc($query2)) {  ?>
                    <a href="?page=<?= $_GET['page'] ?>&type_id=<?= $row['type_id'] ?>&type_name=<?= $row['type_name']; ?>"
                        type="button" class="btn btn-primary"><?= $row['type_name']; ?></a>
                    <?php } ?>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-5">
                    <?php  while ($row = mysqli_fetch_array($query)) {  ?>
                        <div class="col-sm-4" style="margin-bottom:50px;">
                    <img src=".\image\<?= $row['product_img']; ?>" width="100" height="100">
                    <hr>
                    <?= $row['product_name']; ?> <br>
                    Qty : <?= $row['product_quantity']; ?> <?= $row['unit_name'] ?><br>
                    <?php
                    if ($row['product_quantity'] > 0 && $row['product_end_date'] < $date) { ?>
                        <a href="#" style="width:100%" class="btn btn-danger btn-sm disabled"> สินค้าเพียงพอ แต่หมดอายุ !!</a>
                    <?php } elseif ($row['product_quantity'] > 0 && $row['product_end_date'] > $date) { ?>
                        <a href='?page=<?= $_GET['page'] ?>&function=store&product_id=<?php echo $row['product_id'] ?>&functionn=addd' style="width:100%" class="btn btn-success btn-sm">เพิ่ม</a>
                    <?php } elseif ($row['product_quantity'] < 0 && $row['product_end_date'] < $date) { ?>
                        <a href="#" style="width:100%" class="btn btn-danger btn-sm disabled"> สินค้าไม่เพียงพอ แต่ไม่หมดอายุ</a>
                    <?php } else { ?>
                        <a href="#" style="width:100%" class="btn btn-danger btn-sm disabled"> สินค้าหมด !!</a>
                    <?php } ?>

                </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</body>
<?php include 'script.php' ?>

</html>


<!-- 
<script type="text/javascript">
function inputnum(a){
document.getElementById("show").value+=a;
}
</script>
<input type="text" id="show">
<input type="button" id="txt" value="1" onclick="inputnum(this.value)"> -->