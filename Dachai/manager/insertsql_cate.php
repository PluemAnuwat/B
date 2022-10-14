<?php
$con = mysqli_connect("localhost", "root", "", "dachai");
if (isset($_POST) && !empty($_POST)) {
    $category_name = $_POST['category_name'];
    $sql = "INSERT INTO category(category_name) VALUES ('$category_name')";
    if(mysqli_query($con,$sql)){ ?>
    <Meta http-equiv="refresh"content="1;URL=?page=type">
<?PHP } else { 
     echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con); 
}
?>

