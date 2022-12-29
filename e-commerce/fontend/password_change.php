
        <?php
    @session_start();

    require 'includedb/condb.php'; 

    $sql = "SELECT * FROM akksofttech_customer WHERE  cus_id = '".$_SESSION['akksofttechsess_cusid']."'  ";

    $query = mysqli_query($conn , $sql);

    $result = mysqli_fetch_array($query); 

?>

<?php require 'include/head.php' ?>

      

                    <!-- //// ไม่ควรใช้ _SESSION ในการแก้ไข  เพราะ   เวลาเราแก้ไขแล้ว   SESSION ยังเก็บค่าเดิม  ไม่มีที่ไหน ที่ต้องแก้ไขข้อมูลส่วนตัวแล้วไปล๊อกอินใหม่ ///// -->
                    <div class="contact-style-1 mt-50">
                        <h4 class="heading-4 font-weight-500 title">SYSTEM PASSWORD </h4>
                        <div class="contact-form">
                            <form method='post' id='emp-SaveFormPassword' action="change_passwordsql.php">

                            <input type="hidden" name="cus_username" value="<?php echo  $_SESSION['akksofttechsess_username'] ; ?>" ></input>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form form-default">

                                            <label>OLD PASSWORD</label>
                                            <div class="form-input">
                                                <input type="text" name="old_password">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>NEW PASSWORD</label>
                                            <div class="form-input">
                                                <input type="text"  name="new_password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>CONFIRM NEW PASSWORD</label>
                                            <div class="form-input">
                                                <input type="text" name="con_newpassword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-form">
                                <input type="hidden"  name="checkpassword">
                                    <button class="main-btn primary-btn" type="submit" name="change_password"
                                        id="change_password">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
      

                <div id="message"></div>
         