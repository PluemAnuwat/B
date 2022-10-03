<?php
if (isset($_GET['customer_id']) && !empty($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    $sql = "SELECT  * FROM customer  WHERE customer_id = '$customer_id'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query);
}
?>  