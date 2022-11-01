
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["suppiles_name"], $_POST["suppiles_company"], $_POST["suppiles_phone"], $_POST["suppiles_email"]))
{
 $suppiles_name = mysqli_real_escape_string($connect, $_POST["suppiles_name"]);
 $suppiles_company = mysqli_real_escape_string($connect, $_POST["suppiles_company"]);
 $suppiles_phone = mysqli_real_escape_string($connect, $_POST["suppiles_phone"]);
 $suppiles_email = mysqli_real_escape_string($connect, $_POST["suppiles_email"]);
 $query = "INSERT INTO suppiles(suppiles_name, suppiles_company,suppiles_phone,suppiles_email) VALUES('$suppiles_name', '$suppiles_company', '$suppiles_phone', '$suppiles_email')";
 if(mysqli_query($connect, $query))
 {
  echo 'เพิ่มเรียบร้อย';
 }
}
?>
