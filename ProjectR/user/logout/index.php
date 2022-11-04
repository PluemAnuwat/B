<?php
session_start();
session_destroy();


 unset($_SESSION['user_login']);
 unset($_SESSION['image_login']);


$alert = '<script type="text/javascript">';
$alert .= 'window.location.href = "../index.php"';
$alert .= '</script>';
echo $alert;
exit();
?>