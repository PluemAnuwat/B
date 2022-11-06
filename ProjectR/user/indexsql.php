<?php include 'head.php' ?>

<?php 

$con = mysqli_connect("localhost","root","akom2006","project");
$user = $_GET['username'];
$sql = "SELECT * FROM employee WHERE username = '$user'";
$query = mysqli_query($con , $sql);
$result = mysqli_fetch_assoc($query);


if(isset($_POST) && !empty($_POST)){
    $employee_name = $_POST['employee_name'];
    $employee_phone = $_POST['employee_phone'];
    $employee_email = $_POST['employee_email'];
    $username = $_POST['username'];
    if(isset($_POST['profile'])){
        $sql = "UPDATE employee SET employee_name = '$employee_name' , employee_phone = '$employee_phone' , employee_email = '$employee_email' WHERE username = '$user'";
        if(mysqli_query($con ,  $sql)){
            $alert = '<script type="text/javascript">';
            $alert = 'alert("แก้ไขข้อมูลส่วนตัยวแล้ว")';
            $alert = 'window.location.href = "index.php"';
            $alert = '</script>';
        echo $alert;
        exit();
        }else{
            echo "Error : " . $sql . "<br>" . mysqli_errno($con); 
        }
        mysqli_close($con);

}else if(isset($_POST['checkpassword'])){
    // $oldpassword = sha1(md5($_POST['oldpassword']));
    $oldpassword = $_POST['oldpassword'];
      $newpassword = $_POST['newpassword'];
      $confirmpassword = $_POST['confirmpassword'];
      if (isset($oldpassword) && !empty($oldpassword)){
        $sql_check = "SELECT * FROM employee WHERE username = '$user' AND password = '$oldpassword' ";
    //         print_r($sql_check);
    // exit;
        $query_check = mysqli_query($con, $sql_check);
        $row_check = mysqli_num_rows($query_check);
    if(!$row_check){
      $alert = '<script type="text/javascript">';
            $alert .= 'alert("รหัสผ่านเก่าไม่ถูกต้อง กรุณาแก้ไขใหม่ !!");';
            $alert .= 'window.location.href = "index.php";';
            $alert .= '</script>';
            echo $alert;
            exit(); 
    }else{
if($newpassword != $confirmpassword){
  $alert = '<script type="text/javascript">';
            $alert .= 'alert("ยืนยันรหัสผ่านไม่ถูกต้อง กรุณาแก้ไขใหม่ !!");';
            $alert .= 'window.location.href = "index.php";';
            $alert .= '</script>';
            echo $alert;
            exit(); 
}else{
  $sql ="UPDATE employee SET password  = '$newpassword' WHERE username = '$user'";
  if (mysqli_query($con, $sql)) {
        $_SESSION['image_login'] = $filename;
          $alert = '<script type="text/javascript">';
          $alert .= 'alert("เปลี่ยนแปลงรหัสผ่านสำเร็จ !!");';
          $alert .= 'window.location.href = "index.php";';
          $alert .= '</script>';
          echo $alert;
          exit();
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
      }
      mysqli_close($con);
    }
  }
}
}
}
?>
<div class="container">
    <div class="row">
        <br>
        <form method="post" enctype="multipart/form-data">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ชื่อ</label>

                    <input type="text" class="form-control" name="employee_name"
                        value="<?= $result['employee_name'] ?>">

                </div>


                <div class="form-group">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">เบอร์โทรศัพท์</label>

                    <input type="text" class="form-control" name="employee_phone"
                        value="<?= $result['employee_phone'] ?>">
                </div>



                <div class="form-group">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">อีเมล์</label>

                    <input type="text" class="form-control" name="employee_email"
                        value="<?= $result['employee_email']?>">
                </div>

            </div>
            <br>
            <input type="hidden" name="profile">
            <button type="submit" class="btn btn-primary">บันทึกข้อมูลการเปลี่ยนแปลง</button>
        </form>




        <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านเดิม</label>

                    <input type="password" class="form-control" name="oldpassword">

                </div>


                <div class="form-group">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านใหม่</label>

                    <input type="password" class="form-control" name="newpassword">
                </div>



                <div class="form-group">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">ยืนยัน</label>

                    <input type="password" class="form-control" name="confirmpassword">
                </div>

            </div>
            <br>
            <input type="hidden" name="checkpassword">
            <input type="submit" class="btn btn-primary" value='ยืนยันการเปลี่ยนรหัสผ่าน' />

            <a type="button" class="btn btn-danger" href=javascript:history.back(1)>ย้อนกลับ</a>

        </form>


    </div>
</div>