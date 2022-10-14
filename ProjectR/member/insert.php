<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}

.borderstyle1 {
  border: 1px solid white;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="sweet/dist/sweetalert2.all.min.js"></script>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            INSERT MEMBER
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>

<br>

<script type="text/javascript" src="insert.js"></script>
<?php
$conn = new mysqli('localhost', 'root', 'akom2006', 'dachai');
?>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <img id="preview" width="200" height="200">
            <hr>
            <input type="file" class="form-control " id="employee_img" required />
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">USERNAME</label>
            <input type="text" class="form-control" id="username">
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">PASSWORD</label>
            <input type="text" class="form-control" id="password">
        </div>
    </div>

    <hr class="borderstyle1" >

    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" id="employee_id">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" id="employee_name">
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="employee_phone">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" id="employee_email">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">ตำแหน่ง</label>
            <input type="text" class="form-control" id="employee_role">
        </div>
    </div>

</div>

<center>
    <button type="submit" class="btn btn-primary" id="button">บันทึกข้อมูล</button>
</center>


<script>
$(document).ready(function() {

    function ReadURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#employee_img").change(function() {
        ReadURL(this);
    });

    $("#button").click(function() {
        var employee_id = $("#employee_id").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var employee_name = $("#employee_name").val();
        var customer_last = $("#customer_last").val();
        var employee_email = $("#employee_email").val();
        var employee_phone = $("#employee_phone").val();
        var employee_role = $("#employee_role").val();
        var employee_img = $("#employee_img").val();
        $.ajax({
            url: 'insertsql.php',
            method: 'POST',
            data: {
                employee_id: employee_id,
                username: username,
                password: password,
                employee_name: employee_name,
                customer_last: customer_last,
                employee_email: employee_email,
                employee_phone: employee_phone,
                employee_role: employee_role,
                employee_img: employee_img
            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'บันทึกข้อมูลเรียบร้อย',
                        timer: 1000,
                    }),
                    location.href = "index.php?page=member";
            }
        });
    });
});
</script>

<!-- image -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>