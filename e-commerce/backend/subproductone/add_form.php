<?php require '../include_backend/head.php' ;

@session_start();
require_once '../include/condb.php';

 
 
if( $_GET['id'] != 0){

    $sql2 ="SELECT * FROM akksofttech_subproduct_one WHERE sprodone_id = '".$_GET['id']."'" ;
    $result2 = mysqli_query($connect,$sql2) or die ("error ".mysqli_error($connect));
    $row = mysqli_fetch_array($result2);

}


 


?>
<style>
::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 0px;
}
</style>

<body>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->


                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SUB PRODUCT ONE</span></h4>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a type=" button" class="nav-link active" id="btn-view" href="index.php"><i
                                            class="bx bx-show-alt"></i> VIEW SUB PRODUCT ONE</a>
                                </li>
                            </ul>
                            <!-- Basic Layout -->
                            <div class="row">
                                <div class="box-1">

                                    <div class="col-xl">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div id="dis">
                                                    <!-- here message will be displayed -->
                                                </div>
                                                <form method='post' id='emp-SaveForm1'>

                                                  


                                                    
                                                


                                                    <div class="mb-3" style="display:none;">
                                                        <label class="form-label"
                                                            for="basic-default-fullname" >ID</label>
                                                        <input type="text" readonly="readonly" class="form-control"
                                                            name="sprodone_id" id="sprodone_id"
                                                            value='<?php echo $row['sprodone_id'];?>' />
                                                    </div>
                                                    <div class="mb-3" style="display:none;">
                                                        <label class="form-label" for="basic-default-fullname">ID
                                                            Member</label>
                                                        <input type="text" class="form-control" name="mem_id"
                                                            id="mem_id" placeholder=""
                                                            value='<?php echo $_SESSION['akksofttechsess_memid'];?>' />
                                                    </div>

                                                    <div class="mb-3" style="display:none;">
                                                        <label class="form-label" for="basic-default-fullname">Name
                                                            Member</label>
                                                        <input type="text" class="form-control" name="mem_name"
                                                            id="mem_name"
                                                            value='<?php echo $_SESSION['akksofttechsess_name'];?>' />
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Name Sub Product One</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="sprodone_name"
                                                                id="sprodone_name"
                                                                value='<?php echo $row['sprodone_name'];?>'
                                                                autocomplete="off" required="asdasdas" required
                                                                oninvalid="this.setCustomValidity('please fill in')"
                                                                oninput="this.setCustomValidity('')" />

                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Product</label>
                                                        <div class="col-sm-5">
                                                            <input type='text' name='saveprod_name' id='saveprod_name'
                                                                class='form-control'
                                                                placeholder='Product Search... ' />
                                                        </div>
                                                        <div class="col-sm-5">


                                                            <select name="prod_id" id="prod_id" class='form-control'required>
                                                                <option value="<?php echo $row['prod_id']?>">Choss
                                                                </option>
                                                                <?php
                                                
                                                $query3 = "SELECT prod_id, prod_name FROM akksofttech_product 
                                                WHERE sto_id = '".$_SESSION['akksofttechsess_stoid']."'";
                                                $result3 = mysqli_query($connect,$query3) or die ("error ".mysqli_error($connect));
                                                while ($row3 = mysqli_fetch_array($result3)) {

                                               echo '<option value="'.$row3['prod_id'].'">'.$row3['prod_name'].'</option>'; 
                                                
                                                }
                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Sub Product</label>


                                                        <div class="col-sm-10">


                                                            <select name="sprod_id" id="sprod_id" class='form-control' required>
                                                            <option value="<?php echo $row['sprod_id']?>">Choss</option>
                                                            </select>

                                                        </div>

                                                    </div>


                                                    <div class="row mb-3" id="showandhidesku"> 
                                                    <label class="col-sm-2 col-form-label"  for="basic-default-name">SKU Sub Product</label>


                                                    <div class="col-sm-10">


                                                    <input type="text" readonly="readonly" class="form-control"
                                                    name="showinput_sku" id="showinput_sku"
                                                    value="<?php echo $row['sprod_sku']?>" />

                                                  

                                                    </div>


                                                        

                                                    </div>


                                                    <div class="row mb-3" id="showandhide"> 
                                                    <label class="col-sm-2 col-form-label"  for="basic-default-name">Price Sub Product</label>


                                                    <div class="col-sm-10">


                                                    

                                                    <input type="text" readonly="readonly" class="form-control"
                                                    name="showinput_price" id="showinput_price"
                                                    value="<?php echo $row['sprod_price']?>"  />

                                                  

                                                    </div>


                                                        

                                                    </div>


                                                   
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Price</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="sprodone_price"
                                                                value='<?php echo $row['sprodone_price'];?>'
                                                                autocomplete="off" required="asdasdas" required
                                                                oninvalid="this.setCustomValidity('please fill in')"
                                                                oninput="this.setCustomValidity('')" />

                                                        </div>

                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">SKU</label>

                                                        <div class="col-sm-10"> 
                                                            <input type="text" class="form-control" name="sprodone_sku"
                                                                id="sprodone_sku" 
                                                                value='<?php echo $row['sprodone_sku'];?>'
                                                                autocomplete="off" required="asdasdas" required
                                                                oninvalid="this.setCustomValidity('please fill in')"
                                                                oninput="this.setCustomValidity('')" />

                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Detail</label>

                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="sprodone_detail"
                                                                id="sprodone_detail"
                                                                value='<?php echo $row['sprodone_detail'];?>'
                                                                autocomplete="off" required="asdasdas" required
                                                                oninvalid="this.setCustomValidity('please fill in')"
                                                                oninput="this.setCustomValidity('')" />

                                                        </div>

                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Quantity</label>
                                                            
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control"
                                                                name="sprodone_quantity" id="sprodone_quantity"
                                                                value='<?php echo $row['sprodone_quantity'];?>'
                                                                autocomplete="off" required="asdasdas" required
                                                                oninvalid="this.setCustomValidity('please fill in')"
                                                                oninput="this.setCustomValidity('')" />

                                                        </div>

                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">Image</label>
                                                            
                                                        <div class="col-sm-10">
                                                            <div class="show_view_img"><img
                                                                    src="../getimg/sprodone/<?php echo $row['sprodone_image']; ?>">
                                                            </div>
                                                            <input type="file" name="fileprod_picture" id="imagebroswer"
                                                                class='form-control  btn-upload' />

                                                            <textarea name="logo_img64" id="logo_img64"
                                                                class="form-control"
                                                                style="display:none;"><?php echo $row['sprodone_image']; ?></textarea>

                                                        </div>

                                                    </div>

                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-10">
                                                            <button type="submit" class="btn btn-primary"
                                                                name="btn-save" id="btn-save">SAVE</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <?php require '../include_backend/script.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="crud.js"></script>
    <script>
    $(document).ready(function() {
        $("#prod_id").change(function() { //
            console.log($('#prod_id').val());
            $.ajax({
                url: "view_sub_prod.php",
                data: "prod_id=" + $("#prod_id").val(),
                type: "POST",
                async: false,
                success: function(data, status) {

                    $("#sprod_id").html(data);


                },

                error: function(xhr, status, exception) {
                    alert(status);
                }

            });

        });


        

        $('#sprod_id').on('change', function() {

  

            console.log($('#sprod_id').val());
            $.ajax({
                url: 'view_show_subproduct_price.php',
                type: 'post',
                data: {
                    sprod_id: $('#sprod_id').val()
                },
                dataType: 'json',
                success: function(data) {
                    $htmls = "";
                    console.log(data);

                    $.each(data, function(key, val) {
                        var sprod_price = val["sprod_price"];
                        console.log(val['sprod_price']);
                        $('#showinput_price').val(sprod_price);
                        $htmls += ' ' + sprod_price + ' ';


                    });
                    $('#show_price').html($htmls);

                    

                },

            })

        });

     

        $('#sprod_id').on('change', function() {

          

            console.log($('#sprod_id').val());
            $.ajax({
                url: 'view_show_subproduct_price.php',
                type: 'post',
                data: {
                    sprod_id: $('#sprod_id').val()
                },
                dataType: 'json',
                success: function(data) {
                    $htmls = "";
                    console.log(data);

                    $.each(data, function(key, val) {
                        var sprod_sku = val["sprod_sku"];
                        $('#showinput_sku').val(sprod_sku);
                        console.log(val['sprod_sku']);

                        $htmls += ' ' + sprod_sku + ' ';


                    });
                    $('#show_sku').html($htmls);

                    

                },

            })

        });

      




        $("#saveprod_name").keyup(function() {

            var value = $(this).val().toLowerCase();
            $("#prod_id option").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });

        });


    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

    });
    // ???????????????????????????????????????????????????????????????????????????
    $(".btn-upload").on("click", function() {
        //????????? input file ???????????? event click
        $(this).prev("input:file").trigger("click");
        console.log('input:file');
    });


    // ???????????????????????????????????????????????????????????????????????????????????????
    $(".file-up").on("change", function() {
        var fileLength = $(this)[0].files.length; // ????????????????????????????????????????????????
        if (fileLength != 0) { // ????????????????????????????????????




        } else { // ??????????????????????????????????????????????????????
            // $(this).next(".btn-upload").html("<img class='d-block mx-auto mb-1' src='img/imgcamera.svg' alt='' width='50' height='50'>");
            // $(this).nextAll(".btn-remove-file").hide();

        }
    });








    $('#imagebroswer').on('change', function() {
        resizeImages(this.files[0], function(dataUrl) {


            // console.log(dataUrl);


            $("#logo_img64").val(dataUrl);
            //   inset_img(dataUrl);


            //   var this_length= $("#logo_img64").val().length; // ?????????????????????????????????????????????????????????????????????
            //   $("#now_length").html(this_length+" ????????????????????????"); 

            $(".show_view_img").html('<img   class=" "   src="' + dataUrl +
                '"  style="height: 100%;"   >');



        });
    });

    function resizeImages(file, complete) {
        // read file as dataUrl
        ////////  2. Read the file as a data Url
        var reader = new FileReader();
        // file read
        reader.onload = function(e) {
            // create img to store data url
            ////// 3 - 1 Create image object for canvas to use
            var img = new Image();
            img.onload = function() {
                /////////// 3-2 send image object to function for manipulation
                complete(resizeInCanvas(img));


                // console.log(complete(resizeInCanvas(img)));
            };
            img.src = e.target.result;
        }
        // read file
        reader.readAsDataURL(file);

    }


    function resizeInCanvas(img) {
        /////////  3-3 manipulate image
        var perferedWidth = 500;
        var ratio = perferedWidth / img.width;
        var canvas = $("<canvas>")[0];
        canvas.width = img.width * ratio;
        canvas.height = img.height * ratio;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        //////////4. export as dataUrl
        return canvas.toDataURL();
    }
    </script>
  


</body>

</html>