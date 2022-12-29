   <!--====== Navbar Style 7 Part Start ======-->
   <div class="navigation">
       <header class="navbar-style-7 position-relative">
           <div class="container">
               <!-- navbar mobile Start -->
               <div class="navbar-mobile d-lg-none">
                   <div class="row align-items-center">
                       <div class="col-3">
                           <!-- navbar cart start -->
                           <div class="navbar-toggle icon-text-btn">
                               <a class="icon-btn primary-icon-text mobile-menu-open-7" href="javascript:void(0)">
                                   <i class="mdi mdi-menu"></i>
                               </a>
                           </div>
                           <!-- navbar cart Ends -->
                       </div>
                       <div class="col-6">
                           <!-- desktop logo Start -->
                           <div class="mobile-logo text-center">
                               <a href="index.php"><img src="assets/images/logo.svg" alt="Logo"></a>
                           </div>
                           <!-- desktop logo Ends -->
                       </div>
                       <div class="col-3">
                           <!-- navbar cart start -->
                           <div class="navbar-cart">
                               <a class="icon-btn primary-icon-text icon-text-btn" href="cart.php">
                                   <img src="assets/images/menu-icons/cart.png" alt="Icon">
                                   <!-- <span class="icon-text text-style-1">88</span> -->
                               </a>
<!-- 
                               <div class="navbar-cart-dropdown container m-3">
                                   <div class="checkout-style-2 p-2">
                                       <div class="checkout-header d-flex justify-content-between">
                                           <h6 class="title">Shopping Cart</h6>
                                       </div>

                                       <div class="checkout-table table-responsive">

                                           <table class="table">

                                               <tbody>

                                                   <?php 

                                                    $sql = "SELECT * FROM akksofttech_cart WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ;

                                                    $result = mysqli_query($conn , $sql) ;

                                                    while($query = mysqli_fetch_array($result)){ ?>

                                                   <tr>


                                                       <td class="checkout-product">

                                                           <div class="product-cart d-flex">

                                                               <div class="product-thumb">

                                                                   <img src="assets/images/product-cart/product-1.png"
                                                                       alt="Product">

                                                               </div>

                                                               <div class="product-content media-body">

                                                                   <h5 class="title">

                                                                       <a
                                                                           href="product-details-page.html"><?php $query['prod_name'] ; ?></a>

                                                                   </h5>

                                                                   <ul>

                                                                       <li><span>Brown</span></li>

                                                                       <li><span>XL</span></li>

                                                                       <li>

                                                                           <a class="delete" href="javascript:void(0)">

                                                                               <i class="mdi mdi-delete"></i>

                                                                           </a>

                                                                       </li>

                                                                   </ul>

                                                               </div>

                                                           </div>

                                                       </td>



                                                       <td class="checkout-quantity">
                                                           <div class="product-quantity d-inline-flex">
                                                               <button type="button" id="sub" class="sub">
                                                                   <i class="mdi mdi-minus"></i>
                                                               </button>
                                                               <input type="text" value="1">
                                                               <button type="button" id="add" class="add">
                                                                   <i class="mdi mdi-plus"></i>
                                                               </button>
                                                           </div>
                                                       </td>
                                                       <td class="checkout-price">
                                                           <p class="price">$36.00</p>
                                                       </td>
                                                   </tr>

                                                   <?php } ?>

                                               </tbody>
                                           </table>
                                       </div>

                                       <div class="checkout-footer">
                                           <div class="checkout-sub-total d-flex justify-content-between">
                                               <p class="value">Subtotal Price:</p>
                                               <p class="price">$144</p>
                                           </div>
                                           <div class="checkout-btn">
                                               <a href="./cart.php" class="main-btn primary-btn-border">View
                                                   Cart</a>
                                               <a href="checkout-page.html" class="main-btn primary-btn">Checkout</a>
                                           </div>
                                       </div>
                                   </div>
                               </div> -->
                           </div>
                           <!-- navbar cart Ends -->
                       </div>
                   </div>
                   <!-- navbar search start -->
                   <div class="navbar-search mt-15 search-style-5">
                       <div class="search-input">
                           <input type="text" placeholder="Search">
                       </div>
                       <div class="search-btn">
                           <button><i class="lni lni-search-alt"></i></button>
                       </div>
                   </div>
                   <!-- navbar search Ends -->
               </div>
               <!-- navbar mobile Start -->
           </div>

           <div class="navbar-container navbar-sidebar-7">
               <!-- navbar close  Ends -->
               <div class="navbar-close d-lg-none">
                   <a class="close-mobile-menu-7" href="javascript:void(0)"><i class="mdi mdi-close"></i></a>
               </div>
               <!-- navbar close  Ends -->
               <!-- main navbar Start -->
               <div class="navbar-wrapper">
                   <div class="container-lg">
                       <nav class="main-navbar d-lg-flex justify-content-between align-items-center">
                           <!-- desktop logo Start -->
                           <div class="desktop-logo d-none d-lg-block">
                               <a href="index.php"><img src="assets/images/logo.svg" alt="Logo"></a>
                           </div>
                           <!-- desktop logo Ends -->
                           <!-- navbar menu Start -->
                           <div class="navbar-menu">
                               <ul class="main-menu">
                                   <?php if($_SESSION['akksofttechsess_username'] != ""){ ?>
                                   <li><a href="./myaccount.php">My
                                           Account</a></li>
                                   <li><a href="logout.php">LOGOUT</a></li>
                                   <?php }else{ ?>
                                   <li><a href="login.php">LOGIN</a></li>
                                   <li><a href="register.php">REGISTER</a></li>
                                   <?php } ?>
                               </ul>
                           </div>
                           <!-- navbar menu Ends -->
                           <div class="navbar-search-cart d-none d-lg-flex">
                               <!-- navbar search start -->
                               <div class="navbar-search search-style-5">
                                   <div class="search-input">
                                       <input type="text" placeholder="Search">
                                   </div>
                                   <div class="search-btn">
                                       <button><i class="lni lni-search-alt"></i></button>
                                   </div>
                               </div>
                               <!-- navbar search Ends -->
                               <!-- navbar cart start -->
                               <div class="navbar-cart">
                                   <a class="icon-btn primary-icon-text icon-text-btn" href="cart.php">
                                       <img src="assets/images/menu-icons/cart.png" alt="Icon">
                                       <!-- <span class="icon-text text-style-1">88</span> -->
                                   </a>

                                   <!-- <div class="navbar-cart-dropdown container m-2">
                                       <div class="checkout-style-2">
                                           <div class="checkout-header d-flex justify-content-between">
                                               <h6 class="title">Shopping Cart</h6>
                                           </div>

                                           <div class="checkout-table">
                                               <table class="table">
                                                   <tbody>

                                                       <?php 

                                                                $sql = "SELECT * FROM akksofttech_cart WHERE cus_id = '".$_SESSION['akksofttechsess_cusid']."'" ;

                                                                $result = mysqli_query($conn , $sql) ;

                                                                while($query = mysqli_fetch_array($result)){ ?>

                                                       <tr>
                                                           <td class="checkout-product">
                                                               <div class="product-cart d-flex">
                                                                   <div class="product-thumb">
                                                                       <img src="assets/images/product-cart/product-1.png"
                                                                           alt="Product">
                                                                   </div>
                                                                   <div class="product-content media-body">
                                                                       <h5 class="title">
                                                                           <a
                                                                               href="product-details-page.html"><?php echo $query['prod_name'] ; ?></a>
                                                                       </h5>
                                                                   </div>
                                                               </div>
                                                           </td>
                                                           <td class="checkout-quantity">
                                                               <div class="product-quantity d-inline-flex m-2 ">

                                                                   <button type="button" id="show_molo_minus2"
                                                                       data-id='<?php echo $query['cart_id'] ; ?>'
                                                                       class="show_molo_minus2"><i
                                                                           class="mdi mdi-minus"></i></button>

                                                                   <button
                                                                       id="show_quantity2<?php echo $query['cart_id'] ; ?>"
                                                                       data-id='<?php echo $query['cart_id'] ; ?>'><?php echo $query['quantity'] ; ?></button>

                                                                   <button type="button" id="show_molo_plus2"
                                                                       data-id='<?php echo $query['cart_id'] ; ?>'
                                                                       class="show_molo_plus2"><i
                                                                           class="mdi mdi-plus"></i></button>

                                                               </div>
                                                           </td>
                                                           <td class="checkout-price">
                                                           <div id="show_price_qty<?php echo $query['cart_id'] ; ?>"><?php echo  number_format($query['prod_price_simple'] * $query['quantity'],2,'.',',') ; ?></div>
                                                           </td>
                                                       </tr>

                                                       <?php }  ?>
                                                   </tbody>
                                               </table>
                                           </div>
                                           <div class="checkout-footer">
                                               <div class="checkout-sub-total d-flex justify-content-between">
                                                   <p class="value">Subtotal Price:</p>
                                                   <p class="price">$144</p>
                                               </div>       <br>
                                               <div class="checkout-btn">
                                                   <a href="cart.php" class="main-btn primary-btn-border">View
                                                       Cart</a>
                                                   <a href="checkout.php"
                                                       class="main-btn primary-btn">Checkout</a>
                                               </div>
                                           </div>
                                    
                                       </div>
                                   </div> -->



                               </div>
                               <!-- navbar cart Ends -->
                           </div>
                       </nav>
                   </div>
               </div>
               <!-- main navbar Ends -->
           </div>
           <div class="overlay-7"></div>
       </header>
   </div>
   <!--====== Navbar Style 7 Part Ends ======-->