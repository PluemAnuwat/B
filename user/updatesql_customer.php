<?php
if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
     $customer_id = $_GET['customer_id'];
     $sql = "SELECT * FROM customer  WHERE customer_id = '$customer_id'";
     $query = mysqli_query($con, $sql);
     $result = mysqli_fetch_assoc($query);
}
if (isset($_POST) && !empty($_POST)) {
     $customer_name = $_POST['customer_name'];
     $customer_last = $_POST['customer_last'];
     $customer_phone = $_POST['customer_phone'];
     // $customer_role = $_POST['customer_role'];
     $customer_drug = $_POST["customer_drug"];
     $sql = "UPDATE customer SET customer_name='$customer_name',customer_phone='$customer_phone' , customer_last= '$customer_last' , 
    customer_drug = '$customer_drug'    WHERE customer_id = '$customer_id'";
    if(mysqli_query($con,$sql)){
     $alert = '<script type="text/javascript">';
     $alert .= 'alert("แก้ไขเรียบร้อย !!");';
     $alert .= 'window.location.href = "?page=customer";';
     $alert .= '</script>';
     echo $alert;
     exit();
} else {
     echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
}
?>
