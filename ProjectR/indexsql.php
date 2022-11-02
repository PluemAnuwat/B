<?php session_start(); ?>
<?php $con = mysqli_connect("localhost", "root", "akom2006", "project"); ?>
<?php
if (isset($_POST) && !empty($_POST)) {
    print_r($_POST);
	$username = $_POST['username'];
    $password = $_POST['password'];
	$sql = "SELECT * FROM employee WHERE username = '".$username."' AND password = '".$password."'";
	$query = mysqli_query($con, $sql);

	$row = mysqli_num_rows($query);
    // print_r($query);
    if ($row == 1) {
        $result = mysqli_fetch_assoc($query);
        $_SESSION['user_login'] = $result['username'];
        $_SESSION['posit_login'] = $result['employee_role'];
        $_SESSION['image_login'] = $result['employee_img'];
        $_SESSION['name_login'] = $result['employee_name'];

        
        if ($_SESSION['posit_login']  == 'ผู้ดูแลระบบ') {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("WELCOME ผู้ดูแลระบบ");';
            $alert .= 'window.location.href = "Admin";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else if ($_SESSION['posit_login'] == 'เภสัชกร') {
            $alert = '<script type="text/javascript">';
            $alert .= 'window.location.href = "user";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } elseif ($_SESSION['posit_login'] == 'เจ้าของกิจการ') {
            $alert = '<script type="text/javascript">';
            $alert .= 'alert("WELCOME เจ้าของกิจการ");';
            $alert .= 'window.location.href = "Manager";';
            $alert .= '</script>';
            echo $alert;
            exit();
        }
    }   else {
        $alert = '<script type="text/javascript">';
        $alert .= 'alert("username and password ไม่ถูกต้อง !!");';
        $alert .= 'window.location.href = "index.php";';
        $alert .= '</script>';
        echo $alert;
        exit();
    }
  }
?>
