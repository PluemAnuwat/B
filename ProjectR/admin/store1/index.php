<?php 	session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <title>Squanchy POS</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logos/squanchy.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/logos/squanchy.jpg">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logos/squanchy.jpg">
    <!-- jQuery -->
    <!-- Bootstrap4 files-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ui.css" rel="stylesheet" type="text/css" />
    <link href="assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
    <link href="assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet" />
    <!-- Font awesome 5 -->
    <style>
    .avatar {
        vertical-align: middle;
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }

    .bg-default,
    .btn-default {
        background-color: #f2f3f8;
    }

    .btn-error {
        color: #ef5f5f;
    }
    </style>
    <!-- custom style -->
</head>

<body>

    <?php
$con = mysqli_connect("localhost", "root", "akom2006", "project");
if (isset($_GET['cate_id']) & isset($_GET['cate_name'])) {
  $cate_id = $_GET['cate_id'];
  $sql = "SELECT DISTINCT(a.product_id) , a.product_img , b.product_price_sell as product_price_sell    , a.product_quantity AS product_quantity , a.product_name ,
   a.product_id , b.product_price_id , b.product_price_cost as product_price_cost  
  FROM product a join product_price b ON a.product_id = b.product_id
  JOIN product_quantity c ON a.product_id = c.product_id
   WHERE product_category ='$cate_id' AND c.status = '0'";
  $query = mysqli_query($con, $sql);
} else {
  $sql = "SELECT DISTINCT(a.product_id) , a.product_img , a.product_quantity AS product_quantity  , b.product_price_sell as product_price_sell ,  a.product_name ,
  a.product_id , b.product_price_id , b.product_price_cost as product_price_cost  
  FROM product a join product_price b ON a.product_id = b.product_id 
  JOIN product_quantity c ON a.product_id = c.product_id 
  WHERE  c.status = '0' 
  ";
  $query = mysqli_query($con, $sql);
}

$sql2 = "SELECT * FROM category";
$query2  = mysqli_query($con, $sql2);
?>
    <form action="insertsql.php" class="search-wrap" method="post">
        <section class="header-main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="brand-wrap">
                            <img class="logo" src="assets/images/logos/squanchy.jpg">
                            <h2 class="logo-text">DACHAI POS</h2>
                        </div> <!-- brand-wrap.// -->
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="widgets-wrap d-flex justify-content-end">
                            <div class="widget-header">
                                <a href="#" class="icontext">
                                    <a href="../index.php" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </a>
                            </div> <!-- widget .// -->
                            <div class="widget-header dropdown">
                                <a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
                                    <img src="assets/images/avatars/bshbsh.png" class="avatar" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
                                </div> <!--  dropdown-menu .// -->
                            </div> <!-- widget  dropdown.// -->
                        </div> <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- container.// -->
        </section>
        <!-- ========================= SECTION CONTENT ========================= -->
        <section class="section-content padding-y-sm bg-default ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 card padding-y-sm card ">
                        <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="pill" href="?page=<?= $_GET['page'] ?>">
                                    <i class="fa fa-tags"></i> ทั้งหมด</a>
                            </li>
                            <?php while ($row = mysqli_fetch_assoc($query2)) {  ?>
                            <li class="nav-item ">
                                <a type="button" class="nav-link"
                                    href="?page=<?= $_GET['page'] ?>&cate_id=<?= $row['cate_id'] ?>&cate_name=<?= $row['cate_name']; ?>">
                                    <?= $row['cate_name']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                        <span id="items">
                            <div class="row">
                                <?php  while ($row = mysqli_fetch_array($query)) {  ?>
                                <div class="col-md-3">
                                    <figure class="card card-product">
                                        <span class="badge-new">จำนวน : <?php  echo $row['product_quantity'];?></span>
                                        <div class="img-wrap">
                                            <img src="..\product\image\<?= $row['product_img']; ?>">
                                         
                                        </div>
                                        <figcaption class="info-wrap">
                                            <a href="#" class="title"><?= $row['product_name']; ?></a>
                                            <div class="action-wrap">
                                                <a href="session.php?product_id=<?php echo $row["product_id"];?>"
                                                    class="btn btn-primary btn-sm float-right"> <i
                                                        class="fa fa-cart-plus"></i>
                                                    เพิ่ม
                                                </a>
                                                <div class="price-wrap h5">
                                                    <span
                                                        class="price-new"><?php echo $row['product_price_sell'];?></span>
                                                </div> <!-- price-wrap.// -->
                                            </div> <!-- action-wrap -->
                                        </figcaption>
                                    </figure> <!-- card // -->
                                </div> <!-- col // -->
                                <?php } ?>

                            </div> <!-- row.// -->
                        </span>
                    </div>

                    <?php
			if(!isset($_SESSION["intLine1"]))
			{
				echo "ไม่มีรายการ กรุณาเพิ่มรายการ";
				exit();
			}
			?>



                    <div class="col-md-5">
                        <div class="card">
                            <span id="cart">
                                <input type="text" id="show" name="sales_get"
                                    class="mt-2 form-control text-right text-red" style="font-size:20px;">
                                <table class="table table-hover shopping-cart-wrap">
                                    <thead class="text-muted">

                                        <tr>
                                            <th scope="col">Item</th>
                                            <th scope="col" width="120">Qty</th>
                                            <th scope="col" width="120">Price</th>
                                            <th scope="col" width="120">Note</th>
                               
                                            <th scope="col" class="text-right" width="200">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
									$Total = 0;
									$SumTotal = 0;
									$Vat = 0.07;
                                    $VatTotal = 0 ;

									for($i=0;$i<=(int)$_SESSION["intLine1"];$i++)
									{
										if($_SESSION["strProductID1"][$i] != "")
										{
											$strSQL = "SELECT * , a.product_id , b.product_price_id , b.product_price_cost as product_price_cost  
											FROM product AS a 
                                            inner join product_price AS b ON a.product_id = b.product_id 
                                            -- inner JOIN product_quantity AS c ON a.product_id = c.product_id 
                                             WHERE a.product_id = '".$_SESSION["strProductID1"][$i]."' ";
											$objQuery = mysqli_query($con , $strSQL);
											$objResult = mysqli_fetch_array($objQuery);
											$Total = $_SESSION["strQty1"][$i] * $objResult["product_price_sell"];
											$VatTotal =  (($Total * $Vat)  + $Total) ;  
											$SumTotal = $SumTotal + $Total;
											
                                            
										?>

                               

                                    <tr>
                                            <td>
                                                <figure class="media">
                                                    <div class="img-wrap"><img src="..\product\image\<?= $objResult['product_img']; ?>"
                                                            class="img-thumbnail img-xs"></div>
                                                    <figcaption class="media-body">
                                                        <h6 class="title text-truncate">
                                                            <?php echo $objResult["product_name"];?></h6>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td class="text-center">
                                                <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group"
                                                    aria-label="...">

                                                    <input name="txtint" type="text" id="txtint"
                                                        value=<?php echo $_SESSION["strQty1"][$i]; ?>
                                                        style="width:40px;border-white">

                                                </div>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <var class="price"> <?php echo number_format($Total,2) ?> </var>
                                                </div> <!-- price-wrap .// -->
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                <?php if( $_SESSION["strQty1"][$i] >  $objResult['product_quantity'] ){ ?>
                                                    <var class="price text-danger"> ไม่พอ</var>
                                                <?php }else{  ?>
                                                    <var class="price">เพียงพอ</var>
                                                <?php } ?>
                                                </div> <!-- price-wrap .// -->
                                            </td>
                                            <td class="text-right">
                                                <a href="delete.php?Line=<?php echo $i;?>"
                                                    class="btn btn-outline-danger"> <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                     
                                        <?php
									}
								}
								?>
                                    </tbody>
                                </table>
                                <div class="box">
                                    <dl class="dlist-align">
                                        <dt>ภาษี: </dt>
                                        <dd class="text-right">7%</dd>
                                    </dl>
                                    <dl class="dlist-align">
                                        <dt>ราคา:</dt>
                                        <dd class="text-right"><?php echo number_format($Total,2) ?></dd>
                                    </dl>
                                    <dl class="dlist-align">
                                        <dt>ราคาทั้งหมด: </dt>
                                        <dd class="text-right h4 b" name="VatTotal"> <?php echo number_format($VatTotal,2) ; ?> </dd>
                                    </dl>
                                    <br>


                                </div> <!-- box.// -->
                                <center>
                                    <div class="row ">
                                        <div class="col-md-4">
                                            ลูกค้า :
                                        </div>
                                        <div class="col-md-4">
                                            <select type="text" class="form-control" name="customer_id">
                                                <?php
                                                    $sqlcustomer = "SELECT * FROM customer";
                                                    $querycustomer = mysqli_query($con, $sqlcustomer);
                                                    foreach ($querycustomer as $datacustomer) : ?>
                                                <option value="<?= $datacustomer['customer_id'] ?>">
                                                    <?= $datacustomer['customer_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>


                                    </div>
                                </center>
                            </span>

                        </div> <!-- card.// -->

                        <style>
                        .btncolor {
                            background: purple;
                            border: solid 0px;
                            ;
                            font-weight: bold;
                        }
                        .modal
                        {
                        position: fixed;
                        top: 50%; 
                        left: 0%;
                        }
                        </style>


                   
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-lg">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            </div>
                            </div>
                            
                        </div>
                        </div>

                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <center>
                                        <div class="col-md-12">
                                            <input class="btn btn-secondary mt-2 "
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="7" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="8" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="9" onclick="inputnum(this.value)">                       
                                            <button class="btn mt-2 btn-danger" style="width:20%;height:20%;font-size:20px;"
                                                type="reset"><img src="../images/cleaning.png"
                                                    style="width:50%;height:50%;"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="4" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="5" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="6" onclick="inputnum(this.value)">
                                            <a class="btn mt-2 btn-success" style="width:20%;height:20%;font-size:20px;"
                                                type="button"><img src="../images/budget.png"
                                                    style="width:50%;height:50%;"></a>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="1" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="2" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="3" onclick="inputnum(this.value)">
                                            <button disabled type="button" class="btn mt-2 btn-primary" style="width:20%;height:20%;font-size:20px;" data-toggle="modal" data-target="#myModal"
                                                type="button"><img src="../images/customer.png"
                                                    style="width:50%;height:50%;"></button>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="0" onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="." onclick="inputnum(this.value)">
                                            <input class="btn btn-secondary mt-2"
                                                style="width:20%;height:20%;font-size:20px;" type="button" id="txt"
                                                value="00" onclick="inputnum(this.value)">
                                            <button type="submit" class="btn mt-2 btncolor" name="submit" value="submit"
                                                style="width:20%;height:20%;font-size:20px;">
                                                <img src="../images/money.png" style="width:50%;height:50%;"></button>
                                            <!-- <a class="btn mt-2 btncolor" style="width:20%;height:20%;font-size:40px;"
                                        type="button"><img src="../images/money.png" style="width:50%;height:50%;"></a> -->
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </nav>

                    </div>
                </div>
            </div><!-- container //  -->
        </section>
    </form>
    <!-- ========================= SECTION CONTENT END// ========================= -->
    <script src="assets/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/OverlayScrollbars.js" type="text/javascript"></script>
    <script>
    $(function() {
        //The passed argument has to be at least a empty object or a object with your desired options
        //$("body").overlayScrollbars({ });
        $("#items").height(552);
        $("#items").overlayScrollbars({
            overflowBehavior: {
                x: "hidden",
                y: "scroll"
            }
        });
        $("#cart").height(445);
        $("#cart").overlayScrollbars({});
    });
    </script>

    <script type="text/javascript">
    function inputnum(a) {
        document.getElementById("show").value += a;
    }
    </script>


</body>

</html>