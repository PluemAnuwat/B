<?php 	session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">
<?php require 'include/head.php' ?>

<body>
    <?php require 'include/session.php' ?>

    <?php
$con = mysqli_connect("localhost", "root", "akom2006", "project");
if (isset($_GET['cate_id']) & isset($_GET['cate_name'])) {
  $cate_id = $_GET['cate_id'];
  $sql = "SELECT * , a.product_id , b.product_price_id , b.product_price_cost as product_price_cost  
  FROM product a join product_price b ON a.product_id = b.product_id WHERE product_category ='$cate_id'  ";
  $query = mysqli_query($con, $sql);
} else {
  $sql = "SELECT * , a.product_id , b.product_price_id , b.product_price_cost as product_price_cost  
  FROM product a join product_price b ON a.product_id = b.product_id ";
  $query = mysqli_query($con, $sql);
}

$sql2 = "SELECT * FROM category";
$query2  = mysqli_query($con, $sql2);
?>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="pill" href="#nav-tab-card">
                       ทั้งหมด</a>
                    </li>
                    <?php while ($row = mysqli_fetch_assoc($query2)) {  ?>
                    <li class="nav-item">
                        <a type="button" class="nav-link"
                            href="?page=<?= $_GET['page'] ?>&cate_id=<?= $row['cate_id'] ?>&cate_name=<?= $row['cate_name']; ?>">
                           <?= $row['cate_name']; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>


        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <?php  while ($row = mysqli_fetch_array($query)) {  ?>
                    <div class="col-md-4">
                        <figure class="card card-product">
                            <div class="img-wrap">
                                <img src="assets/images/items/3.jpg">
                            </div>
                            <figcaption class="info-wrap">
                                <a href="#" class="title"><?= $row['product_name']; ?></a>
                                <div class="action-wrap">
                                    <a href="session.php?product_id=<?php echo $row["product_id"];?>"
                                        class="btn btn-primary btn-sm float-right"> <i class="fa fa-cart-plus"></i>
                                        เพิ่ม
                                    </a>
                                    <div class="price-wrap ">
                                        <span class="price-new"><?php echo $row["product_price_cost"] ?> ฿ </span>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <?php } ?>
                </div>
            </div>


            <?php
			if(!isset($_SESSION["intLine1"]))
			{
				echo "ไม่มีรายการ กรุณาเพิ่มรายการ";
				exit();
			}
			?>

            <!-- ตะกร้าาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาาา -->
            <div class="col-md-6">

                <input type="text" id="show" class="form-control text-right text-red" style="font-size:50px;">

                <hr>
                <div class="card">
                    <span id="cart">

                        <table class="table table-hover shopping-cart-wrap">
                            <thead class="text-muted">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col" width="120">Qty</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" class="text-right" width="200">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
									$Total = 0;
									$SumTotal = 0;
									$Vat = 0.07;

									for($i=0;$i<=(int)$_SESSION["intLine1"];$i++)
									{
										if($_SESSION["strProductID1"][$i] != "")
										{
											$strSQL = "SELECT * , a.product_id , b.product_price_id , b.product_price_cost as product_price_cost  
											FROM product a join product_price b ON a.product_id = b.product_id  WHERE a.product_id = '".$_SESSION["strProductID1"][$i]."' ";
											$objQuery = mysqli_query($con , $strSQL);
											$objResult = mysqli_fetch_array($objQuery);
											$Total = $_SESSION["strQty1"][$i] * $objResult["product_price_cost"];
											$VatTotal =  (($Total * $Vat)  + $Total) ;  
											$SumTotal = $SumTotal + $Total;
											

										?>
                                <tr>
                                    <td>
                                        <figure class="media">
                                            <div class="img-wrap"><img src="assets/images/items/1.jpg"
                                                    class="img-thumbnail img-xs"></div>
                                            <figcaption class="media-body">
                                                <h6 class="title text-truncate">
                                                    <!-- <?php echo $_SESSION["strProductID1"][$i];?> -->
                                                    <?php echo $objResult["product_name"];?>
                                                </h6>
                                            </figcaption>
                                        </figure>
                                    </td>

                                    <td class="text-center">
                                        <div class="m-btn-group m-btn-group-pill btn-group mr-0" role="group"
                                            aria-label="...">
                                            <button type="button" onclick="delnum()" class="m-btn btn btn-default"><i
                                                    class="fa fa-minus"></i></button>
                                            <button type="button" class="m-btn btn btn-default" disabled>
                                                <input name="txtint" type="text" id="txtint"
                                                    value=<?php echo $_SESSION["strQty1"][$i]; ?>
                                                    style="width:40px;border-white">
                                            </button>
                                            <button onclick="addnum()" type="button" class="m-btn btn btn-default"><i
                                                    class="fa fa-plus"></i></button>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="price-wrap">
                                            <var class="price"> <?php echo number_format($Total,2) ?> </var>
                                        </div>
                                    </td>

                                    <td class="text-right">
                                        <a href="delete.php?Line=<?php echo $i;?>" class="btn btn-outline-danger"> <i
                                                class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                                <?php
									}
								}
								?>

                            </tbody>
                        </table>
                    </span>
                </div> <!-- card.// -->


                <div class="box">
                    <dl class="dlist-align">
                        <dt>Tax: </dt>
                        <dd class="text-right"> 7% </dd>
                    </dl>
                    <!-- <dl class="dlist-align">
                        <dt>ลดราคา:</dt>
                        <dd class="text-right"><a href="#">0%</a></dd>
                    </dl> -->
                    <dl class="dlist-align">
                        <dt>ยอดเงินรวม:</dt>
                        <dd class="text-right"><?php echo number_format($SumTotal,2) ?> </dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>ราคาทั้งหมด: </dt>
                        <dd class="text-right h4 b"> <?php echo number_format($VatTotal,2) ?> </dd>
                    </dl>
                    <br>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag"></i>
                                ยืนยันการขาย </a>
                        </div>
                    </div> -->
                </div>

                <style>
                .btncolor {
                    background: purple;
                    border: solid 0px;
                    ;
                    font-weight: bold;
                }
                </style>


                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <center>
                                <div class="col-md-12">
                                    <input class="btn btn-secondary mt-2 " style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="7" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="8" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="9" onclick="inputnum(this.value)">
                                    <a class="btn mt-2 btn-danger" style="width:20%;height:20%;font-size:40px;"
                                        type="button"><img src="../images/budget.png" style="width:50%;height:50%;"></a>
                                </div>
                                <div class="col-md-12">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="4" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="5" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="6" onclick="inputnum(this.value)">
                                    <a class="btn mt-2 btn-success" style="width:20%;height:20%;font-size:40px;"
                                        type="button"><img src="../images/budget.png" style="width:50%;height:50%;"></a>
                                </div>
                                <div class="col-md-12">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="1" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="2" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="3" onclick="inputnum(this.value)">
                                    <a class="btn mt-2 btn-primary" style="width:20%;height:20%;font-size:40px;"
                                        type="button"><img src="../images/budget.png" style="width:50%;height:50%;"></a>
                                </div>
                                <div class="col-md-12">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="0" onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="." onclick="inputnum(this.value)">
                                    <input class="btn btn-secondary mt-2" style="width:20%;height:20%;font-size:40px;"
                                        type="button" id="txt" value="00" onclick="inputnum(this.value)">
                                    <a class="btn mt-2 btncolor" style="width:20%;height:20%;font-size:40px;"
                                        type="button"><img src="../images/money.png" style="width:50%;height:50%;"></a>
                                </div>
                            </center>
                        </div>
                    </div>
                </nav>



            </div>

        </div>
    </div>

    <?php require 'include/script.php' ?>

</body>

</html>

<script>
function addnum() {
    document.all.txtint.value++;
}

function delnum() {
    document.all.txtint.value--;
}
</script>



<script type="text/javascript">
function inputnum(a) {
    document.getElementById("show").value += a;
}
</script>