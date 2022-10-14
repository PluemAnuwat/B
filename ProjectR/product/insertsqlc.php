<?php
$con = mysqli_connect("localhost", "root", "akom2006", "dachai");
if (isset($_POST) && !empty($_POST)) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO category(category_name) VALUES ('$category_name')";
    $query  = mysqli_query($con,$sql);
}
?>

