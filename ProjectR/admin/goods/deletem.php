<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>
<?php
if (isset($_GET['good_RefNo']) && !empty($_GET['good_RefNo'])) {
     $good_RefNo = $_GET['good_RefNo'];
     $sql = "SELECT * FROM goods  WHERE good_RefNo = '$good_RefNo'";
     $query = mysqli_query($connect, $sql);
     $result = mysqli_fetch_assoc($query);

}
if (isset($_POST) && !empty($_POST)) {

     $sql = "UPDATE goods SET good_status ='2' WHERE good_RefNo = '".$result['good_RefNo']."'";
    if(mysqli_query($connect,$sql)){
     $alert = '<script type="text/javascript">';
     $alert .= 'alert("แก้ไขเรียบร้อย !!");';
     $alert .= 'window.location.href = "?page=manager_goods_test";';
     $alert .= '</script>';
     echo $alert;
     exit();
} else {
     echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}
mysqli_close($connect);
}
?>

