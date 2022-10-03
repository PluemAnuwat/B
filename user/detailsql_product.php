<?php
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM view_product_detail a left join view_product_price b on a.product_id = b.product_id left join reorder c ON a.product_id = c.product_id  WHERE a.product_id = '$product_id'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query);
}
?>