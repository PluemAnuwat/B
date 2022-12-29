
    <?php

@session_start();

?>

<?php require 'include/head.php' ?>

<body>

<?php require 'include/load.php' ?>

<?php require 'include/nav.php' ?>


<body>

<section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div
                    class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                    <div class="breadcrumb-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign in</li>
                        </ol>
                    </div>
                    <div class="breadcrumb-right">
                        <h5 class="heading-5 font-weight-500">Sign in</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="login-registration-wrapper pt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="login-registration-style-2 mt-50">
                    <h1 class="heading-4 font-weight-500 title">Login</h1>
                    <div class="login-registration-form pt-10">
                        <form action="#">
                            <div class="single-form form-default form-border">
                                <label>Username</label>
                                <div class="form-input">
                                    <input type="text" placeholder="username" id="cus_username" required autocomplete="off">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                            <div class="single-form form-default form-border">
                                    <label>Your Password</label>
                                    <div class="form-input">
                                    <input id="password-7" class="cus_password" type="password" placeholder="Password">
                                    <i class="mdi mdi-lock"></i>
                                    <span toggle="#password-7" class="mdi mdi-eye-outline toggle-password"></span>
                                    </div>
                                    </div>
                            <div class="single-form">
                                <button class="main-btn primary-btn" type="submit" id="ok_login">Sign in</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p class="login">Don’t have an account? <a href="register.php">Sign up</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require 'include/script.php' ?>

<script type="text/javascript">

$(document).ready(function() {

console.log('เริ่มการทำงาน');


$(document).bind("contextmenu", function (e) {
    e.preventDefault();
});

$(document).bind("selectstart", function (e) {
    e.preventDefault();
});


$("#ok_login").click(function(e) {
    e.preventDefault();
    // ไปหาอ่านใน google มาแล้วมาตอบ
    var urls = 'index.php';

    logins(urls);

});

function logins(urls) {

    console.log('ล๊อกอิน');

    var cus_username = $("#cus_username").val();

    var cus_password = $(".cus_password").val();
    
    // console.log(cus_username + ' ' + cus_password);

    if (cus_username != "" && cus_password != "") {

        $.post("logincheck.php" , { cus_username : cus_username , cus_password : cus_password } , function(response) {
           
            let present = $.parseJSON(response);

            $.each(present, function(key, val) {

                console.log(val['status']);

                if (val['status'] == 'YES') {

                    // console.log(present);

                    // console.log(urls);

                    location = urls;

                } else if (val['status'] == 'NO') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Username Or Password Faild!!',
                        text: '',
                    })

                }
            });

        })

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Please enter all information!!',
            text: '',
        })
    }

}

});

</script>

</body>

</html>