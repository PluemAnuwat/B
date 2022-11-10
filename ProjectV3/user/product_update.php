<?php
$con = mysqli_connect("localhost", "root", "akom2006", "project");

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
     $product_id = $_GET['product_id'];
     $sql = "SELECT * FROM product as a  INNER JOIN product_price b ON  a.product_id = b.product_id INNER JOIN product_reorder c ON a.product_id = c.product_id WHERE a.product_id = '$product_id'";
     $query = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($query);
  
}
if (isset($_POST) && !empty($_POST)) {
     $product_name = $_POST['product_name'];
     $product_common = $_POST['product_common'];
     $product_type = $_POST['product_type'];
     $product_category = $_POST['product_category'];
     $product_symp = $_POST['product_symp'];
     $product_unit = $_POST['product_unit'];
     $product_barcode = $_POST['product_barcode'];
     $product_price_cost = $_POST['product_price_cost'];
     $point = $_POST['point'];
     $oldimage = $_POST["oldimage"];
     if (isset($_FILES['product_img']['name']) && !empty($_FILES['product_img']['name'])) {
          $extension = array("jpeg", "jpg", "png");
          $target = './product/image/';
          $filename = $_FILES['product_img']['name'];
          $filetmp = $_FILES['product_img']['tmp_name'];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          if (in_array($ext, $extension)) {
               if (!file_exists($target . $filename)) {
                    if (move_uploaded_file($filetmp, $target . $filename)) {
                         $filename = $filename;
                    } else {
                         echo 'เพิ่มไม่สำเร็จ';
                    }
               } else {
                    $newfilename = time() . $filename;
                    if (move_uploaded_file($filetmp, $target . $newfilename)) {
                         $filename = $newfilename;
                    } else {
                         echo 'เพิ่มเข้าไม่ได้';
                    }
               }
          } else {
               echo 'ประเภทไม่ถูกต้อง';
          }
     } else {
          $filename = $oldimage;
     }
     $sql = "UPDATE product SET product_name='$product_name',product_common='$product_common' , product_img= '$filename' , 
    product_type = '$product_type'  , product_category = '$product_category' ,  product_symp = '$product_symp'  , product_unit = '$product_unit' ,
    product_barcode = '$product_barcode'  WHERE product_id = '$product_id'";
    $query = mysqli_query($con , $sql);
    // print_r($sql);
    // exit;
     $sql1 = "UPDATE product_price SET product_price_cost = '$product_price_cost'  WHERE product_id = '$product_id' " ;
     $query1 = mysqli_query($con , $sql1);

     $sql2 = "UPDATE product_reorder SET point = '$point'  WHERE product_id = '$product_id' " ;
    
    if(mysqli_query($con,$sql2)){
     $alert = '<script type="text/javascript">';
     $alert .= 'alert("แก้ไขเรียบร้อย !!");';
     $alert .= 'window.location.href = "?page=product";';
     $alert .= '</script>';
     echo $alert;
     exit();
} else {
     echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
}
?>

<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}

.borderstyle1 {
    border: 1px solid white;
}
</style>
<?php 


function random_char($len)
{
     $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //ตัวอักษรที่สามารถสุ่มได้
     $ret_char = "";
     $num = strlen($chars);
     for ($i = 0; $i < $len; $i++) {
          $ret_char .= $chars[rand() % $num];
          $ret_char .= "";
     }
     return $ret_char;
}

?>



<?php
$conn = new mysqli('localhost', 'root', 'akom2006', 'dachai');
?>
<div class="card shadow mb-4 ">
    <form role="form" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <img id="preview" width="250" height="250" src="./image/<?= $result['product_img'] ?>">
                <hr>
                <input type="file" class="form-control" name="product_img" id="product_img">
                <input type="hidden" name="oldimage" value="<?= $result['product_img'] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <p>ชื่อสินค้า</p>
                <input type="text" class="form-control form-control-user" placeholder="ชื่อสินค้า" name="product_name"
                    value="<?php echo $result['product_name'];?>" required>
            </div>
            <div class="col-sm-3">
                <p>ราคาต้นทุน</p>
                <input type="text" class="form-control form-control-user" placeholder="ราคาต้นทุน"
                    value="<?php echo $result['product_price_cost'];?>" name="product_price_cost" required>
            </div>
            <div class="col-sm-3">
                <p>จุดสั่งซื้อ</p>
                <input type="text" class="form-control form-control-user" placeholder="จุดสั่งซื้อ" name="point"
                    value="<?php echo $result['point'];?>" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <p>หน่วยนับ</p>
                <select type="text" class="form-control" id="exampleInputUsername1" name="product_unit">
                    <?php
                                         $sqlunit = "SELECT * FROM unit";
                                         $queryunit = mysqli_query($con, $sqlunit);
                                        while ($row = mysqli_fetch_assoc($queryunit)) { ?>
                    <option value="<?= $row['unit_id'] ?>"
                        <?= $result['product_unit'] == $row['unit_id'] ? 'selected' : '' ?>>
                        <?= $row['unit_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <p>หมวดหมู่ของสินค้า</p>
                <select type="text" class="form-control" id="exampleInputUsername1" name="product_category">
                    <?php
                                         $sqlunit = "SELECT * FROM category";
                                         $queryunit = mysqli_query($con, $sqlunit);
                                        while ($row = mysqli_fetch_assoc($queryunit)) { ?>
                    <option value="<?= $row['cate_id'] ?>"
                        <?= $result['product_category'] == $row['cate_id'] ? 'selected' : '' ?>>
                        <?= $row['cate_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <p>หมวดหมู่แยกตามอาการ</p>
                <select type="text" class="form-control" id="exampleInputUsername1" name="product_symp">
                    <?php
                                         $sqlunit = "SELECT * FROM symptons";
                                         $queryunit = mysqli_query($con, $sqlunit);
                                        while ($row = mysqli_fetch_assoc($queryunit)) { ?>
                    <option value="<?= $row['symp_id'] ?>"
                        <?= $result['product_symp'] == $row['symp_id'] ? 'selected' : '' ?>>
                        <?= $row['symp_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-sm-6">
                <p>ประเภทสินค้า</p>
                <select type="text" class="form-control" id="exampleInputUsername1" name="product_type">
                    <?php
                                         $sqlunit = "SELECT * FROM type_product";
                                         $queryunit = mysqli_query($con, $sqlunit);
                                        while ($row = mysqli_fetch_assoc($queryunit)) { ?>
                    <option value="<?= $row['type_id'] ?>"
                        <?= $result['product_type'] == $row['type_id'] ? 'selected' : '' ?>>
                        <?= $row['type_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <center>
            <button type="submit" class="btn btn-primary" style="width:100%;" id="button">แก้ไขข้อมูล</button>
        </center>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script type="text/javascript">
function ReadURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#product_img").change(function() {
    ReadURL(this);
});
</script>