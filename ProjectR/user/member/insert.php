
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["employee_name"], $_POST["employee_phone"], $_POST["employee_email"], $_POST["employee_role"], $_POST["username"], $_POST["password"]))
{
 $employee_name = mysqli_real_escape_string($connect, $_POST["employee_name"]);
 $employee_phone = mysqli_real_escape_string($connect, $_POST["employee_phone"]);
 $employee_email = mysqli_real_escape_string($connect, $_POST["employee_email"]);
 $employee_role = mysqli_real_escape_string($connect, $_POST["employee_role"]);
 $username = mysqli_real_escape_string($connect, $_POST["username"]);
 $password = mysqli_real_escape_string($connect, $_POST["password"]);
 $query = "INSERT INTO employee(employee_name, employee_phone,employee_email,employee_role , username , password) VALUES('$employee_name', '$employee_phone', '$employee_email', '$employee_role' , '$username', '$password')";
 if(mysqli_query($connect, $query))
 {
  echo 'เพิ่มเรียบร้อย';
 }
}
?>
