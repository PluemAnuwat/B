<?php 

@session_start();
require_once '../include/condb.php';

 
 
if( $_GET['id'] != 0){

    $sql2 ="SELECT * FROM akksofttech_bank_account WHERE bac_id = '".$_GET['id']."'" ;
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
<div class="col-lg-4 col-md-6">

    <div class="mt-3">


        <!-- Modal -->
        <div class="modal fade clickmodaladdress" id="showmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">BANK ACCOUNT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form method='post' id='emp-SaveForm1'>

                            <div class="row">
                                <div class="col mb-3" style="display:none;">
                                    <label for="nameWithTitle" class="form-label">BANK ID</label>
                                    <input type="text" id="bac_id" name="bac_id" class="form-control"
                                        readonly="readonly" value='<?php echo $row['bac_id'];?>' />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3" style="display:none;">
                                    <label for="nameWithTitle" class="form-label">MEMBER ID</label>
                                    <input type="text" id="mem_id" name="mem_id" class="form-control"
                                        readonly="readonly" value='<?php echo $_SESSION['akksofttechsess_memid'];?>' />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3" style="display:none;">
                                    <label for="nameWithTitle" class="form-label">MEMBER NAME</label>
                                    <input type="text" id="mem_name" name="mem_name" class="form-control"
                                        readonly="readonly" value='<?php echo $_SESSION['akksofttechsess_name'];?>' />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3" style="display:none;">
                                    <label for="nameWithTitle" class="form-label">STORE ID</label>
                                    <input type="text" readonly="readonly" id="sto_id" name="sto_id"
                                        class="form-control"
                                        value='<?php echo $_SESSION['akksofttechsess_stoid']; ?>' />

                                </div>
                            </div>

                            <div class="row g-2">

                                <div class="col mb-0">
                                    <label class="form-label">ACCOUNT NAME</label>
                                    <input type="text" id="bac_mem_name" name="bac_mem_name" class="form-control"
                                        value="<?php echo $row['bac_mem_name']?>" autocomplete="off" required="asdasdas"
                                        required oninvalid="this.setCustomValidity('please fill in')"
                                        oninput="this.setCustomValidity('')" />

                                </div>

                                <div class="col mb-0">
                                    <label class="form-label">ACCOUNT NUMBER</label>
                                    <input type="text" id="bac_number_mem" name="bac_number_mem" class="form-control"
                                        value="<?php echo $row['bac_number_mem']?>" autocomplete="off"
                                        required="asdasdas" required
                                        oninvalid="this.setCustomValidity('please fill in')"
                                        oninput="this.setCustomValidity('')" />
                                </div>
                            </div><br>

                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label class="form-label">BANK NAME</label>
                                    <input type="text" id="bac_name" name="bac_name" class="form-control"
                                        value="<?php echo $row['bac_name']?>" autocomplete="off" required="asdasdas"
                                        required oninvalid="this.setCustomValidity('please fill in')"
                                        oninput="this.setCustomValidity('')" />
                                </div>

                                <div class="col mb-0">
                                    <label for="nameWithTitle" class="form-label">BANK</label>

                                    <select name="bak_group" id="bak_id" class='form-control' required>
                                        <option value="<?php echo $row['bak_id']?>">Choss</option>
                                        <?php
                                            
                                            $query3 = "SELECT bak_id, bak_name FROM akksofttech_bank  
                                            WHERE bak_id ";
                                            $result3 = mysqli_query($connect,$query3) or die ("error ".mysqli_error($connect));
                                            while ($row3 = mysqli_fetch_array($result3)) {

                                               echo '<option value="'.$row3['bak_id'].'">'.$row3['bak_name'].'</option>'; 
                                                }
                                               
                                                ?>
                                    </select>
                                </div>
                            </div><br>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    CLOSE
                                </button>
                                <button type="submit" class="btn btn-primary" name="btn-save"
                                    id="btn-save">SAVE</button>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="crud.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>