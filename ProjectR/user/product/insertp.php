<?php include 'insertsqlp.php' ?>
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
<?php 
$con = mysqli_connect("localhost", "root", "akom2006", "project");


function random_char($len)
{
     $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //ตัวอักษรที่สามารถสุ่มได้
     $ret_char = "";
     $num = strlen($chars);
     for ($i = 0; $i < $len; $i++) {
          $ret_char .= $chars[rand() % $num];
          $ret_char .= "";
     }
     return $ret_char;
}

?>


<nav class="navbar navbar-light bgc">
    <div class="container-fluid">
        <a href=javascript:history.back(1)><img src="../images/back1.png" width="80px"></a>
        <a class="navbar-brand text-white" href="#">
            INSERT PRODUCT
        </a>
        <a type="button" href="?page=<?= $_GET['page'] ?>&function=insert" class="btn rounded-pill"></a>
    </div>
</nav>

<br>

<?php
$conn = new mysqli('localhost', 'root', 'akom2006', 'dachai');
?>
<form role="form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <img id="preview" width="150" height="150">
                <hr>
                <input type="file" class="form-control " id="product_img" name="product_img" required  />
            </div>
        </div>

        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" name="product_name" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">Barcode</label>
                <input type="text" class="form-control" name="product_barcode" value="<?php echo random_char(10) ?>"
                    disabled>
            </div>
        </div>

        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">ราคาต้นทุน</label>
                <input type="text" class="form-control" name="product_price_cost">
            </div>
        </div>

        <hr class="borderstyle1">

        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">กำหนดจุดสั่งซื้อ</label>
                <input type="text" class="form-control" name="point">
            </div>
        </div>

        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">หน่วยนับของสินค้า</label>
                <select type="text" class="form-control" name="product_unit">
                    <?php
                $sqlunit = "SELECT * FROM unit";
                $queryunit = mysqli_query($con, $sqlunit);
                 foreach ($queryunit as $dataunit) : ?>
                    <option value="<?= $dataunit['unit_id'] ?>"><?= $dataunit['unit_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">หมวดหมู่สินค้า</label>
                <select type="text" class="form-control" name="product_category">
                    <?php
                $scat = "SELECT * FROM category";
                $qcat = mysqli_query($con, $scat);
                foreach ($qcat as $dacat) : ?>
                    <option value="<?= $dacat['cate_id'] ?>"><?= $dacat['cate_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">หมวดหมู่แยกตามอาการ</label>
                <select type="text" class="form-control" name="product_symp">
                    <?php
                $ssymp = "SELECT * FROM symptons";
                $qsymp = mysqli_query($con, $ssymp);
                foreach ($qsymp as $rows) : ?>
                    <option value="<?= $rows['symp_id'] ?>"><?= $rows['symp_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">ประเภทสินค้า</label>
                <select type="text" class="form-control" name="product_type">
                    <?php
                $sqltype = "SELECT * FROM type_product";
                $querytype = mysqli_query($con, $sqltype);
                 foreach ($querytype as $datatype) : ?>
                    <option value="<?= $datatype['type_id'] ?>"><?= $datatype['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <center>
        <button type="submit" class="btn btn-primary" id="button">บันทึกข้อมูล</button>
    </center>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function ReadURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#product_img").change(function() {
        ReadURL(this);
    });
</script>