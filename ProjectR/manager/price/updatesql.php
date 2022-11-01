<?php
$connect = mysqli_connect("localhost","root","akom2006","project");
if (isset($_POST['save_one'])) {
    $array_id = array_values(array_flip($_POST['save_one']));
    $_ID = $array_id[0];
    $product_price_sell = $_POST['product_price_sell'];
    $sql2 = "UPDATE  product_price SET  product_price_sell='$product_price_sell[$_ID]' , product_id = '$_ID' WHERE product_id = '$_ID' ";
    // print_r($sql2);
    // exit;
        if(mysqli_query($connect,$sql2)){
            $alert = '<script type="text/javascript">';
            $alert .= 'window.location.href = "index.php?page=sale";';
            $alert .= '</script>';
            echo $alert;
            exit();
       } else {
            echo "Error: " . $sqlp . "<br>" . mysqli_error($connect);
       }
       mysqli_close($connect);
}
?>