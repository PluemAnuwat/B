<?php require 'include/head.php' ?>

<body>
  

<?php require 'include/load.php' ?>

<?php require 'include/nav.php' ?>

    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sign up</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Sign up</h5>
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
                    <div class="login-registration-style-1 registration text-center mt-50">
                        <h1 class="heading-4 font-weight-500 title">Create an Account with</h1>
                        <div class="login-registration-form pt-10">
                            <form method='post' id='emp-SaveRegister' action="#">
                                <div class="single-form form-default form-border text-left">
                                    <label>Full Name</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-input">
                                                <input type="text" placeholder="First Name" name="cus_name"
                                                    autocomplete="off" required
                                                    oninvalid="this.setCustomValidity('Please Name')"
                                                    oninput="this.setCustomValidity('')" id="cus_name">
                                                <i class="mdi mdi-account"></i>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-input form">
                                                <input type="text" placeholder="Last Name" name="cus_surname"
                                                    autocomplete="off" required
                                                    oninvalid="this.setCustomValidity('Please Surname')"
                                                    oninput="this.setCustomValidity('')" id="cus_surname">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-form form-default form-border text-left">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Email Address</label>
                                            <div class="form-input">
                                                <input type="email" placeholder="user@email.com" name="cus_email"
                                                    autocomplete="off" required
                                                    oninvalid="this.setCustomValidity('Please Email')"
                                                    oninput="this.setCustomValidity('')" id="cus_email">
                                                <i class="mdi mdi-email"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Phone</label>
                                            <div class="form-input">
                                                <input type="number" placeholder="phone" name="cus_phone" id="cus_phone"
                                                    autocomplete="off" required
                                                    oninvalid="this.setCustomValidity('Please Phone')"
                                                    oninput="this.setCustomValidity('')" id="cus_phone">
                                                <i class="mdi mdi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-form form-default form-border text-left">
                                    <label>Username</label>
                                    <div class="form-input">
                                        <input  type="text" placeholder="username" name="cus_username"
                                            autocomplete="off" required
                                            oninvalid="this.setCustomValidity('Please Username')"
                                            oninput="this.setCustomValidity('')" id="cus_username">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                </div>
                                <div class="single-form form-default form-border text-left">
                                    <label>Choose Password</label>
                                    <div class="form-input">
                                        <input id="password-3" type="password" placeholder="Password"
                                            name="cus_password" id="cus_password" autocomplete="off" required
                                            oninvalid="this.setCustomValidity('Please Password')"
                                            oninput="this.setCustomValidity('')" name="cus_password" id="cus_password">
                                        <i class="mdi mdi-lock"></i>
                                        <span toggle="#password-3" class="mdi mdi-eye-outline toggle-password"></span>
                                    </div>
                                </div>
                                <div class="single-form">
                                    <button class="main-btn primary-btn" type="submit" name="ok_register" id="ok_register">Sign up</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <p class="login">Have an account? <a href="login.php">Log in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="clients-logo-section pt-70 pb-70">

        <div class="container">

        </div>
        
    </section>



    <?php require 'include/script.php' ?>

    <script type="text/javascript">

    $(document).ready(function() {

    });

    </script>

    <script type="text/javascript" src="customer/registerjs.js"></script>



</body>

</html>