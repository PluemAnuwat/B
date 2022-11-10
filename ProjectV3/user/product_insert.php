<?php
include 'product_insert_sql.php' ;
$con = mysqli_connect("localhost", "root", "akom2006", "project");
?>
<div class="card shadow mb-4">
    <form class="user" method="POST" enctype="multipart/form-data">
        <br>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <img id="preview" width="250" height="250">
                <hr>
                <input type="file" class="form-control form-control-user" id="product_img" name="product_img" required />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="ชื่อสินค้า" name="product_name" required>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" placeholder="กำหนดราคาต้นทุน" name="product_price_cost" required>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-user" placeholder="กำหนดจุดสั่งซื้อ" name="point" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <p>หน่วยนับ</p>
            <select type="text" class="form-control" name="product_unit">
                    <?php
                $sqlunit = "SELECT * FROM unit";
                $queryunit = mysqli_query($con, $sqlunit);
                 foreach ($queryunit as $dataunit) : ?>
                    <option  value="<?= $dataunit['unit_id'] ?>"><?= $dataunit['unit_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-6">
            <p>หมวดหมู่ของสินค้า</p>
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
          
        <div class="form-group row">
            <div class="col-sm-6">
            <p>หมวดหมู่แยกตามอาการ</p>
            <select type="text" class="form-control" name="product_symp">
                    <?php
                $ssymp = "SELECT * FROM symptons";
                $qsymp = mysqli_query($con, $ssymp);
                foreach ($qsymp as $rows) : ?>
                    <option value="<?= $rows['symp_id'] ?>"><?= $rows['symp_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-6">
            <p>ประเภทสินค้า</p>
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
        <!-- <a type="submit"  class="btn btn-primary btn-user btn-block"> -->
        <button type="submit" style="width:100%;" class="btn btn-primary btn-user " id="button">บันทึกข้อมูล</button>
        <!-- </a> -->
    </form>
</div>
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