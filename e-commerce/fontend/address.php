<?php
    @session_start();

    require 'includedb/condb.php'; 

    $sql = "SELECT * FROM akksofttech_customer WHERE  cus_id = '".$_SESSION['akksofttechsess_cusid']."'  ";

    $query = mysqli_query($conn , $sql);

    $result = mysqli_fetch_array($query); 

?>

<?php require 'include/head.php' ?>



<div class="contact-style-1 mt-50">
    <div class="row">
        <div class="col-md-6">
            <h4>Address</h4>
        </div>
        <div class="col-md-6">
            <a class="main-btn primary-btn" id="clickmodaladdress">+ ADDRESS</a>
        </div>
    </div>

    <div class="contact-form">
        <form method='post' id='emp-SaveForm' action="#">


            <?php 

                                                $sql = "SELECT * FROM akksofttech_customer_address WHERE cus_id  = '".$_SESSION['akksofttechsess_cusid']."'" ;

                                                $que  = mysqli_query($conn  , $sql ) ;

                                                while($res = mysqli_fetch_array($que)){ ; 

                                                ?>

            <div class="row">
                <div class="col-md-12">

                    <div class="single-form form-default">

                        <div class="card">

                            <div class="card-body">

                                <div class="row">


                                    <div class="col-md-8">
                                        <p><?php echo $res['cusa_name'] ; echo "         "  ; echo $res['cusa_surname'] ;  ?>
                                            | <?php echo $res['cusa_phone'] ; ?> </p>
                                        <p class="m-2"><?php echo $res['cusa_address']  ; ?></p>
                                        <p class="m-2"><?php echo $res['cusa_province']  ; ?> ,
                                            <?php echo $res['cusa_zipcode']  ; ?></p>

                                    </div>


                                    <div class="col-md-4">
                                        <a class="main-btn primary-btn" id="clickedit_address"
                                            data-id="<?php echo $res['cusa_id'] ; ?>">EDIT</a>
                                        <button class="main-btn text-danger">Delete</button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <?php } ?>
        </form>
    </div>
</div>



</section>



<!-- Modal -->
<div class="modal mt-5 fade clickmodaladdress" id="modal_address" aria-hidden="true" style="width:100%;">
    <div class="modal-dialog" style="width:95%;">
        <div class="modal-content" style="width:95%;">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> NEW ADDRESS </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="insert_address">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Full Name" name="cusa_name" id="cusa_name">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Sur Name" name="cusa_surname" id="cusa_surname">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Address" name="cusa_address"
                                        id="cusa_address"></input>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Phone" name="cusa_phone" id="cusa_phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Province" name="cusa_province" id="cusa_province">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Zip code" name="cusa_zipcode" id="cusa_zipcode">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <textarea type="text" placeholder="์Note" name="cusa_note"
                                        id="cusa_note"></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="width:100%;height:60px;font-size:30px;">EXIT</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary" style="width:100%;height:60px;font-size:30px;"
                                name="insert" id="insert" value="Insert">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal mt-5 fade clickedit_address" id="edit_address" aria-hidden="true" style="width:100%;">
    <div class="modal-dialog" style="width:95%;">
        <div class="modal-content" style="width:95%;">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"> EDIT ADDRESS </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="insert_address">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" class="update_cusa_name" name="cusa_name" id="cusa_name">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Sur Name" class="update_cusa_surname"
                                        name="cusa_surname" id="cusa_surname">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Address" class="update_cusa_address"
                                        name="cusa_address" id="cusa_address"></input>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Phone" class="update_cusa_phone" name="cusa_phone"
                                        id="cusa_phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Province" class="update_cusa_province"
                                        name="cusa_province" id="cusa_province">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <input type="text" placeholder="Zip code" class="update_cusa_zipcode"
                                        name="cusa_zipcode" id="cusa_zipcode">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-form form-default">
                                <div class="form-input">
                                    <textarea type="text" placeholder="์Note" class="update_cusa_note" name="cusa_note"
                                        id="cusa_note"></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="width:100%;height:60px;font-size:30px;">EXIT</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary" style="width:100%;height:60px;font-size:30px;"
                                name="submit_edit_address" id="submit_edit_address"
                                value="submit_edit_address">EDIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require 'include/script.php' ?>