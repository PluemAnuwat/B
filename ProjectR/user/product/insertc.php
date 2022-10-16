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
           INSERT DATA TYPE PRODUCT
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>
<br>
    <div class="mb-3">
        <div class="col-md-4">
        <label  class="form-label">ชื่อหมวดหมู่สินค้า</label>
        <input type="text" id="category_name" class="form-control">
        </div>
      
    </div>
 
<center>
    <button type="submit" class="btn btn-primary" id="button">บันทึกข้อมูล</button>
</center>
<script>
$(document).ready(function() {

    $("#button").click(function() {
        var category_name = $("#category_name").val();
      
        $.ajax({
            url: 'insertsqlc.php',
            method: 'POST',
            data: {
                category_name: category_name },
            success: function(data) {
                console.log(data);
                Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'บันทึกข้อมูลเรียบร้อย',
                        timer: 1000,
                    }),
                    location.href = "index.php?page=cate";
            }
        });
    });
});
</script>