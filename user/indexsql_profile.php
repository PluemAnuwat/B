<?php 
$user = $_SESSION['user_login'];
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
            $alert = 'window.location.href = "?page=profile"';
            $alert = '</script>';
        echo $alert;
        exit();
        }else{
            echo "Error : " . $sql . "<br>" . mysqli_errno($con); 
        }
        mysqli_close($con);
    }
}
?>