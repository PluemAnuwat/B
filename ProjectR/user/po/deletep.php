<?php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
if (isset($_GET['po_RefNo']) && !empty($_GET['po_RefNo'])) {
    $po_RefNo = $_GET['po_RefNo'];

 
    $sql = "SELECT * FROM po a   WHERE a.po_RefNo = '$po_RefNo'";
    $query = mysqli_query($connect, $sql);
    $countnum = mysqli_num_rows($query);
 

}
while ($result = mysqli_fetch_assoc($query)) {
    $po_RefNo = $_GET['po_RefNo'];
  
    $sqlstatus = "UPDATE  po a  SET a.po_status = 'ยกเลิก'  WHERE a.po_RefNo = '$po_RefNo' ";
    // print_r($sqlstatus);
    // exit;
    // $querystatus = mysqli_query($connect, $sqlstatus);
    if(mysqli_query($connect , $sqlstatus)){
    echo "<script>";
    echo "alert(' ยกเลิกเรียบร้อย !');";
    echo "window.location='index.php?page=po';";
    echo "</script>";
    }
}
?>