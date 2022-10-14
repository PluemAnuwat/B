<?php
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
     $product_id = $_GET['product_id'];
     $sql = "SELECT * FROM view_product_detail  WHERE product_id = '$product_id'";
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
    if(mysqli_query($con,$sql)){
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
<?php
$sqlunit = "SELECT * FROM unit";
$queryunit = mysqli_query($con, $sqlunit);
?>
<?php
$sqltype = "SELECT * FROM type_product";
$querytype = mysqli_query($con, $sqltype);
?>
<?php
$ssymp = "SELECT * FROM sympton";
$qsymp = mysqli_query($con, $ssymp);
?>
<?php
$scat = "SELECT * FROM category";
$qcat = mysqli_query($con, $scat);
?>
