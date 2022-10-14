<?php
// session_destroy();
unset($_SESSION['user_login']);
unset($_SESSION['image_login']);
$alert = '<script type="text/javascript">';
$alert .= 'alert("ออกจากระบบ!!");';
$alert .= 'window.location.href = "../login/";';
$alert .= '</script>';
echo $alert;
exit();
?>