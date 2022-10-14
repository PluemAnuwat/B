<?php
$qp = "SELECT * FROM view_product_detail a join view_product_price b on a.product_id = b.product_id 
WHERE b.product_price_cost =  0   ";
$rp = mysqli_query($con, $qp);
?>
<?php
if (isset($_POST['save_one'])) {
    $array_id = array_values(array_flip($_POST['save_one']));
    $_ID = $array_id[0];
    $product_price_cost = $_POST['product_price_cost'];
    $sql2 = "UPDATE  product_price SET  product_price_cost='$product_price_cost[$_ID]' , product_id = '$_ID' WHERE product_id = '$_ID' ";
    // print_r($sql2);
    // exit;
        if(mysqli_query($con,$sql2)){
            $alert = '<script type="text/javascript">';
            $alert .= 'window.location.href = "?page=price";';
            $alert .= '</script>';
            echo $alert;
            exit();
       } else {
            echo "Error: " . $sqlp . "<br>" . mysqli_error($con);
       }
       mysqli_close($con);
}
?>