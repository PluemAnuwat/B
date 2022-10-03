<?php include 'updatesql_product.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>แก้ไขข้อมูลสินค้า</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มข้อมูลสินค้า
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="preview" width="250" height="250" src="./image/<?= $result['product_img'] ?>">
                                    <hr>
                                    <input type="file" class="form-control" name="product_img" id="product_img">
                                    <input type="hidden" name="oldimage" value="<?= $result['product_img'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
                                    <input class="form-control" name="product_name" value="<?= $result['product_name'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">Barcode</label>
                                    <input class="form-control" name="product_barcode" value="<?= $result['product_barcode'] ?>" type="text" id="html5-text-input" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">หน่วยนับของสินค้า</label>
                                    <select type="text" class="form-control" id="exampleInputUsername1" name="product_unit">
                                        <?php while ($row = mysqli_fetch_assoc($queryunit)) { ?>
                                            <option value="<?= $row['unit_id'] ?>" <?= $result['product_unit'] == $row['unit_id'] ? 'selected' : '' ?>>
                                                <?= $row['unit_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
                                    <select type="text" class="form-control" id="exampleInputUsername1" name="product_type">
                                        <?php while ($row = mysqli_fetch_assoc($querytype)) { ?>
                                            <option value="<?= $row['type_id'] ?>" <?= $result['product_type'] == $row['type_id'] ? 'selected' : '' ?>>
                                                <?= $row['type_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">หมวดหมู่สินค้า</label>
                                    <select type="text" class="form-control" id="exampleInputUsername1" name="product_category">
                                        <?php while ($row = mysqli_fetch_assoc($qcat)) { ?>
                                            <option value="<?= $row['category_id'] ?>" <?= $result['product_category'] == $row['category_id'] ? 'selected' : '' ?>>
                                                <?= $row['category_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">หมวดหมู่แยกตามอาการ</label>
                                    <select type="text" class="form-control" id="exampleInputUsername1" name="product_symp">
                                        <?php while ($row = mysqli_fetch_assoc($qsymp)) { ?>
                                            <option value="<?= $row['symp_id'] ?>" <?= $result['product_symp'] == $row['symp_id'] ? 'selected' : '' ?>>
                                                <?= $row['symp_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mr-2">ยืนยันแก้ไข</button>
                                <button class="btn btn-success" type="reset" name="reset">ยกเลิก</button>
                                <a class="btn btn-danger" href=javascript:history.back(1)>ย้อนกลับ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- รูปภาพ -->
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