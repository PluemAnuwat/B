<?php
session_start();
session_destroy();


 unset($_SESSION['user_login']);
 unset($_SESSION['image_login']);

 
$alert = '<script type="text/javascript">';
// $alert .= 'alert(3);';
$alert .= 'window.location.href = "http://localhost/b/ProjectR/";';
// $alert .= 'alert(4);';
$alert .= '</script>';
echo $alert;
exit;
?>