<style>
p.inline {display: inline-block;}
span { font-size: 16px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   
        margin: 0mm;

    }
</style>
<?php
$con = mysqli_connect("localhost", "root", "", "dachai");
?>
<?php
$sql = "SELECT * FROM view_product_detail  ";
$rp = mysqli_query($con, $sql);
?>
<body onload="window.print();">
	<div style="margin-left: 5%">
		<?php
        if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $sql = "SELECT * FROM view_product_detail  WHERE product_id = '$product_id'";
            $query = mysqli_query($con, $sql);  
            $result = mysqli_fetch_assoc($query);
           }
        if(isset($_POST) && !empty($_POST)){
            include 'barcode128.php';
            $product_name = $_POST['product_name'];
            $product_id = $_POST['product_id'];
            $product_barcode = $_POST['product_barcode'];
    
            for($i=1;$i<=$_POST['print_qty'];$i++){
                echo "<p class='inline'><span ><b>ชื่อสินค้า: $product_name</b></span>"."<span ><b>รหัสสินค้า: ".bar128(stripcslashes($_POST['product_id']))."<span ><b>รหัสบาร์โค้ด: ".$product_barcode." </b><span></p>&nbsp&nbsp&nbsp&nbsp";
            }
        }
		?>
	</div>
</body>
