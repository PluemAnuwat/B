<?php require '../include_backend/head.php' ;

@session_start();
require_once '../include/condb.php';

 


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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">MY STORE</span></h4>

                   
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Basic Layout -->
                            <div class="row">
                                <div class="col-xl">
                                    <div class="card mb-4">

                                        <div class="card-body">
                                        <div id="dis">
                                         <!-- here message will be displayed -->
	                                      </div>
                                          <?php 
							                       

                                                    $sql = "SELECT * FROM akksofttech_member_store 
                                                    WHERE mem_id = '".$_SESSION['akksofttechsess_memid']."'";
                                                    $query = mysqli_query($connect,$sql);
                                                    $row = mysqli_fetch_assoc($query);
                                                    $_SESSION['akksofttechsess_stoid'] = $row['sto_id'];
                                                    $_SESSION['akksofttechsess_stoname'] = $row['sto_name'];
                                                    
                                                   
                                                    
                                        ?>   
                                                  
                                            <form method='post' id='emp-SaveForm1'>

                                            
                                            <div class="mb-3"  style="display:none;">
                                                    <label class="form-label" for="basic-default-fullname">Store ID</label>
                                                    <input type="text" class="form-control" name="sto_id"
                                                        id="sto_id" readonly="readonly" value='<?php echo $_SESSION['akksofttechsess_stoid']; ?>'
                                            />
                                            </div>
                                            <div class="mb-3"  style="display:none;">
                                                    <label class="form-label" for="basic-default-fullname">Name</label>
                                                    <input type="text" class="form-control" name="mem_name"
                                                        id="mem_name" placeholder=""
                                                    value='<?php echo $_SESSION['akksofttechsess_memname'];?>' />
                                            </div>

                                            <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label">Store
                                                        name</label>
                                                <div class="col-sm-10">
                                                    
                                                    <div class="input-group input-group-merge">
                                                        
                                                        <span id="basic-icon-default-fullname2"
                                                        class="input-group-text"><i class='bx bx-home-heart'></i></span>
                                                    
                                                    <input type="text" class="form-control" name="sto_name"
                                                    id="sto_name" value='<?php echo $_SESSION['akksofttechsess_stoname'];?>' />
                                                    
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label">LOGO</label>
                                                    
                                                <div class="col-sm-10">

                                                    <div class="show_view_img"><img src="../getimg/logo/<?php echo $row['sto_logo']; ?>"></div>
                                                   
                                                    <input type="file" name="filelogo_picture" id="imagebroswer"
                                                        class='form-control  btn-upload'/>

                                                    <textarea  name="logo_img64" id="logo_img64" class="form-control"
                                                    style="display:none;" ><?php echo $row['sto_logo'];?></textarea>
                                            
                                            </div>
                                            </div>

                                            <div class="row mb-3">

                                                    <label class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                        
                                                        <span id="basic-icon-default-fullname2"
                                                        class="input-group-text"><i class='bx bx-map' ></i></span>
                                                    
                                                    <input type="text" class="form-control" name="sto_address"
                                                    id="basic-default-company" value='<?echo $row['sto_address'];?>'/>
                                            
                                                </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Province</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" class="form-control" name="sto_province"
                                                    id="basic-default-company" value='<?echo $row['sto_province'];?>' />
                                            
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label"
                                                        >Zipcode</label>
                                                
                                                <div class="col-sm-10">         
                                                    <input type="text" class="form-control" name="sto_zipcode"
                                                        id="basic-default-company" value='<?echo $row['sto_zipcode'];?>' />
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary" name="btn-save"
                                                     id="btn-save">SAVE</button>
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


<script type="text/javascript">
    $(document).ready(function() {

    });
    // เมื่อคลิกที่ปุ่มเลือกไฟล์
    $(".btn-upload").on("click", function() {
        //ให้ input file เกิด event click
        $(this).prev("input:file").trigger("click");
        console.log('input:file');
    });


    // ถ้ามีการเปลี่ยนไฟล์ที่อัพโหลด
    $(".file-up").on("change", function() {
        var fileLength = $(this)[0].files.length; // เลือกไฟล์หรือไม่
        if (fileLength != 0) { // ถ้าเลือกไฟล์




        } else { // ถ้าไม่ได้เลือกไฟล์
            // $(this).next(".btn-upload").html("<img class='d-block mx-auto mb-1' src='img/imgcamera.svg' alt='' width='50' height='50'>");
            // $(this).nextAll(".btn-remove-file").hide();

        }
    });








    $('#imagebroswer').on('change', function() {
        resizeImages(this.files[0], function(dataUrl) {


            // console.log(dataUrl);


            $("#logo_img64").val(dataUrl);
            //   inset_img(dataUrl);


            //   var this_length= $("#logo_img64").val().length; // หาจำนวนตัวอักษรที่เหลือ
            //   $("#now_length").html(this_length+" ตัวอักษร"); 

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
        var perferedWidth = 200;
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

    <script type="text/javascript" src="ineset.js"></script>

</body>

</html>