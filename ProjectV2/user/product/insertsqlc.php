<?php
$con = mysqli_connect("localhost", "root", "akom2006", "project");
if (isset($_POST) && !empty($_POST)) {
    $cate_name = $_POST['cate_name'];
    $sql = "INSERT INTO category(cate_name) VALUES ('$cate_name')";
    $query  = mysqli_query($con,$sql);
}
?>

