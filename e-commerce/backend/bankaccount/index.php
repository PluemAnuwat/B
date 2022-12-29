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
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">MY BANK ACCOUNT</span></h4>

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Basic Layout -->
                            <div class="row">
                                <div class="col-xl">
                                    <div class="card mb-4">
                                        

                                        <div class="card-body" id="mysfutton">
        
                                        <div class="mb-3" align="right">  
                                        <button type="button"  id="clickshowmodal" class="btn btn-primary">ADD ACCOUNT</button>  
                                        </div> 
                                            <div class="mb-3">
                                                <label class="form-heading">BANK ACCOUNT</label>
                                                <div class="mb-3">
                                                    <label class="form-subheading">Set up a bank account for selling
                                                        products.</label>
                                                </div>
                                            </div>
                                            <hr class="my-0" /><br>



                                            <?php
                                       

                                       
                                          $sql ="SELECT * FROM akksofttech_bank_account WHERE sto_id = '".$_SESSION['akksofttechsess_stoid']."'" ;
                                          $result = mysqli_query($connect,$sql) or die ("error ".mysqli_error($connect));
                                          while ($row = mysqli_fetch_array($result)) {
                                            
                                        ?>
                                        
                                       
                                            <div class="row-cols-sm-auto" align="right">
                                            
                                            <a   class="badge bg-label-primary" id="clickshowmodal1" data-id='<?php echo $row['bac_id']; ?>'><i class="bx bx-edit-alt me-1"></i> EDIT</a
                                            >

                                          

                                            <a class="delete badge bg-label-primary" id="<?php echo $row['bac_id']; ?>" href="#"
                                           
                                            ><i class="bx bx-trash me-1"></i> DELETE</a
                                            >
                                            
                                          </div>
                                        

                                            <div class="mb-3">
                                                <label class="form-subhead "><i
                                                        class="menu-icon tf-icons bx bxs-user"></i> ACCOUNT NAME
                                                    :</label>
                                                <label class="form-input offset-sm-1"><?php echo $row['bac_mem_name'];?></label>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-subhead "><i
                                                        class="menu-icon tf-icons bx bx-copy"></i> ACCOUNT NUMBER
                                                    :</label>
                                                <label class="form-input offset-sm-1"><?php echo $row['bac_number_mem'];?></label>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-subhead "><i
                                                        class="menu-icon tf-icons bx bxs-business"></i> BANK NAME
                                                    :</label>
                                                <label class="form-input offset-sm-1 "><?php echo $row['bak_name'];?></label>
                                            </div>


                                            

                                            <hr class="my-0" /><br>

                                            <?php } ?>









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
    <?php require 'add_form.php'; ?>
    <?php require '../include_backend/script.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

  

<script type="text/javascript" src="crud.js"></script>

    
</body>

</html>