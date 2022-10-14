<style>
.bgc {
    background-color: purple;
}

.borderstyle {
    border-style: solid;
    border-width: 5px;
    border-color: purple;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="sweet/dist/sweetalert2.all.min.js"></script>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            CUSTOMER
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
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="customer_name">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="customer_last">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control" id="customer_phone">
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">การแพ้ยา</label>
            <input type="text" class="form-control" id="customer_drug">
        </div>
    </div>

</div>

<center>
    <button type="submit" class="btn btn-primary" id="button">บันทึกข้อมูล</button>
</center>


<script>
$(document).ready(function() {
    $("#button").click(function() {
        var customer_name = $("#customer_name").val();
        var customer_last = $("#customer_last").val();
        var customer_drug = $("#customer_drug").val();
        var customer_phone = $("#customer_phone").val();
        $.ajax({
            url: 'insertsql.php',
            method: 'POST',
            data: {
                customer_name: customer_name,
                customer_last: customer_last,
                customer_drug: customer_drug,
                customer_phone: customer_phone
            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลเรียบร้อย',
                    timer: 1000,
                }),
                location.href = "index.php?page=customer";
            }
        });
    });
});
</script>