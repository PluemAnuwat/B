<?php @session_start() ; ?>

<?php require 'includedb/condb.php';  ?>

<?php require 'include/head.php' ?>

<body>


    <?php require 'include/loader.php' ?>

    <?php require 'include/navigation.php' ?>

    <style>
    .image-upload>input {
        display: none;
    }

    .borderbg {
        border-style: solid;
        border-color: #754FF1;
        border-width: 15px;
    }
    </style>

    <?php 
            $sql =  "SELECT * FROM akksofttech_purchase_order WHERE po_id = '".$_GET['po_id']."'";
            $que = mysqli_query($conn , $sql ) ; 
            $res = mysqli_fetch_array($que) ; 
            ?>



    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Checkout</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    input[type="date"] {
        background-color: #0080ff;
        padding: 15px;
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        font-family: "Roboto Mono", monospace;
        color: #ffffff;
        font-size: 18px;
        border: none;
        outline: none;
        border-radius: 5px;
    }

    ::-webkit-calendar-picker-indicator {
        background-color: #ffffff;
        padding: 5px;
        cursor: pointer;
        border-radius: 3px;
    }
    </style>


    <form method='post' id="emp-savebank" action="#">
        <section class="checkout-wrapper mb-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="checkout-steps-form-style-1 mt-50">
                            <ul id="checkout-steps">
                                <li data-vjstepno="1">
                                    <h4 class="title"> Payment Method </h4>
                                    <section class="checkout-steps-form-content">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <input id="show_po_id" name="po_id" id="po_id" style="display:none;"
                                                    value='<?php echo $_GET['po_id'] ; ?>'>



                                                <div class="single-form form-default">
                                                    <div class="row">
                                                        <label>Transfer amount</label>
                                                        <div class="col-md-12 form-input form">
                                                            <input type="text" autocomplete="off" required name="amount"
                                                                oninvalid="this.setCustomValidity('Please Transfer amount')"
                                                                oninput="this.setCustomValidity('')"
                                                                id="amount"></input>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <label>Transfer Date</label>
                                                        <div class="col-md-12 form-input form">
                                                            <input type="datetime-local"
                                                                oninvalid="this.setCustomValidity('Please Transfer Date')"
                                                                name="tranfer_date" oninput="this.setCustomValidity('')"
                                                                id="tranfer_date"></input>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <label>Bank of origin</label>

                                                        <div class="col-md-12 form-input form">
                                                            <?php   $sqlbank = "SELECT * FROM akksofttech_bank" ;
                                                            $querybank = mysqli_query($conn , $sqlbank);
                                                            $rowbank = mysqli_fetch_array($querybank);
                                                            ?>


                                                            <select name="bak_id" id="bak_id" class='form-control'
                                                                required>
                                                                <option value="<?php echo $rowbank['bak_id']?>">Choss
                                                                </option>
                                                                <?php      
                                                                $query3 = "SELECT bak_id, bak_name FROM akksofttech_bank ";
                                                                $result3 = mysqli_query($conn,$query3) or die ("error ".mysqli_error($conn));
                                                                while ($row3 = mysqli_fetch_array($result3)) {
                                                                echo '<option value="'.$row3['bak_id'].'">'.$row3['bak_name'].'</option>'; 
                                                                }
                                                
                                                            ?>


                                                            </select>
                                                        </div>




                                                        <!-- <div class="col-md-6 form-input form">
                                                            <input type="text" autocomplete="off" required
                                                                name="bac_number"
                                                                oninvalid="this.setCustomValidity('Please Transfer Bank Number')"
                                                                oninput="this.setCustomValidity('')"
                                                                id="bac_number"></input>
                                                        </div> -->

                                                    </div>

                                                    <br>

                                                    <div class="row">
                                                      
                                                        <div class="col-md-6 form-input form">
                                                        <label>Bank Name Account </label>
                                                            <input type="text" autocomplete="off" required
                                                                name="bac_account"
                                                                oninvalid="this.setCustomValidity('Please Transfer Bank Name Account')"
                                                                oninput="this.setCustomValidity('')"
                                                                id="bac_account"></input>
                                                        </div>
                                                      
                                                        <div class="col-md-6 form-input form">
                                                        <label>Bank Number Account </label>
                                                            <input type="text" autocomplete="off" required
                                                                name="bac_number"
                                                                oninvalid="this.setCustomValidity('Please Transfer Bank Number')"
                                                                oninput="this.setCustomValidity('')"
                                                                id="bac_number"></input>
                                                        </div>
                                                    </div>









                                                    <br>

                                                    <label>Transfer Bank</label>
                                                    <br>
                                                    <?php $sql = "SELECT * FROM akksofttech_bank_account INNER JOIN akksofttech_bank ON akksofttech_bank.bak_id = akksofttech_bank_account.bak_id
                                                        WHERE akksofttech_bank_account.sto_id = '".$res['sto_id']."' " ;
                                                    $query = mysqli_query($conn , $sql) ; 
                                                    while($result = mysqli_fetch_array($query)){ ?>


                                                    <input type="checkbox" class="btn-check"
                                                        id="btn-check<?php echo $result['bac_id'] ;?>" checked
                                                        autocomplete="off">
                                                    <label class="btn" for="btn-check<?php echo $result['bac_id'] ;?>">
                                                        <img src="..\backend\getimg\logobank\<?php echo $result['bak_image'] ; ?>"
                                                            class="mt-1" width="150px;">
                                                        <br>
                                                        <?php echo $result['bac_name'] ; ?>
                                                        <br>
                                                        <?php echo $result['bac_mem_name'] ; ?>
                                                        <br>
                                                        <?php echo $result['bac_number_mem'] ; ?>
                                                    </label>

                                                    <?php  } ;   ?>

                                                </div>
                                            </div>
                                        </div>
                                    
                                    </section>
                                </li>
                            </ul>
                        </div>
                    </div>









                    <div class="col-lg-6">
                        <div class="checkout-sidebar pt-20">
                            <div class="checkout-sidebar-coupon mt-30 text-center">
                                <h4 class="title">Attach proof of money transfer!</h4>
                            </div>
                            <div class="checkout-sidebar-price-table mt-30 text-center">
                                <div class="card borderbg">

                                    <div class="show_view_img"></div>

                                    <input type="file" name="filesto_picture" id="imagebroswer"
                                        class='form-control  btn-upload' autocomplete="off" required
                                        oninvalid="this.setCustomValidity('Please fill in')"
                                        oninput="this.setCustomValidity('')" />

                                    <textarea name="logo_img64" id="logo_img64" class="form-control"
                                        style="display:none;"></textarea>


                                </div>



                            </div>

                        </div>
                    </div>
                </div>

                <br>
                <button class="main-btn primary-btn " type="submit"
                                            style="width:100%;height:40px;font-size:20px;" name="ok_bank"
                                            id="ok_bank">Agree</button>


            </div>
            </div>
        </section>
    </form>


    <?php require 'include/script.php' ?>

    <script type="text/javascript">
    $("#amount").on("keypress", function(e) {

        var code = e.keyCode ? e.keyCode : e.which;

        if (code > 57) {
            return false;

        } else if (code < 48 && code != 8) {

            return false;

        }

    })

    $(document).ready(function() {






    });
    </script>

    <script>
    $(document).ready(function() {

    });
    </script>

    <?php require_once 'funcimage.php' ; ?>


    <script type="text/javascript" src="serve/js_serve/webapp.serve.bankaccount.js"></script>


</body>

</html>