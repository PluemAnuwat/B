
<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if(isset($_POST["customer_name"], $_POST["customer_last"], $_POST["customer_phone"], $_POST["customer_drug"]))
{
 $customer_name = mysqli_real_escape_string($connect, $_POST["customer_name"]);
 $customer_last = mysqli_real_escape_string($connect, $_POST["customer_last"]);
 $customer_phone = mysqli_real_escape_string($connect, $_POST["customer_phone"]);
 $customer_drug = mysqli_real_escape_string($connect, $_POST["customer_drug"]);
 $create_date = date("Y-m-d H:i:s");
 $query = "INSERT INTO customer(customer_name, customer_last,customer_phone,customer_drug,create_date) VALUES('$customer_name', '$customer_last', '$customer_phone', '$customer_drug','$create_date')";
 if(mysqli_query($connect, $query))
 {
  echo 'เพิ่มเรียบร้อย';
 }
}
?>
