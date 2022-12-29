<?php
    @session_start();

    require 'includedb/condb.php'; 

    $sql = "SELECT * FROM akksofttech_customer WHERE  cus_id = '".$_SESSION['akksofttechsess_cusid']."'  ";

    $query = mysqli_query($conn , $sql);

    $result = mysqli_fetch_array($query); 

?>

<?php require 'include/head.php' ?>


<div class="contact-style-1 mt-50">
    <h4 class="heading-4 font-weight-500 title">My Profile</h4>
    <div class="contact-form">
        <form method='post' id='emp-UpdateForm' action="#">
            <div class="row">
                <div class="col-md-6">
                    <div class="single-form form-default">

                        <label>Full Name</label>
                        <div class="form-input">
                            <input type="text" placeholder="Full Name" name="cus_name" id="cus_name"
                                value='<?php echo $result['cus_name'];?>'>
                            <i class="mdi mdi-account"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Last Name</label>
                        <div class="form-input">
                            <input type="text" placeholder="Sur Name" name="cus_surname" id="cus_surname"
                                value='<?echo $result[' cus_surname'];?>'>
                            <i class="mdi mdi-account"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Email</label>
                        <div class="form-input">
                            <input type="text" placeholder="Email" name="cus_email" id="cus_email"
                                value='<?echo $result[' cus_email'];?>'>
                            <i class="mdi mdi-email"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-form form-default">
                        <label>Phone</label>
                        <div class="form-input">
                            <input type="text" placeholder="Phone" name="cus_phone" id="cus_phone"
                                value='<?echo $result[' cus_phone'];?>'>
                            <i class="mdi mdi-phone"></i>
                        </div>
                    </div>
                </div>

                <div class="single-form">
                    <button class="main-btn primary-btn" type="submit" name="btn-update" id="btn-update">SUBMIT</button>
                </div>
        </form>
    </div>
</div>