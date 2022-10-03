<?php include 'insertsql_product.php' ?>
        <div class="row">
            <div class="col-md-12">
                <h2>หน้าเพิ่มข้อมูลของสินค้า</h2>
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
                                            <img id="preview" width="200" height="200">
                                            <hr>
                                            <input type="file" class="form-control " id="product_img" name="product_img" required />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="product_name" id="inputSuccess">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">Barcode</label>
                                            <input type="text" class="form-control" name="product_barcode" value="<?php echo random_char(10) ?>" id="inputSuccess">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">กำหนดจุดสั่งซื้อ</label>
                                            <input type="text" class="form-control" name="point"  id="inputSuccess">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">หน่วยนับของสินค้า</label>
                                            <select type="text" class="form-control" id="exampleInputUsername1" name="product_unit">
                                                <?php
                                                foreach ($queryunit as $dataunit) : ?>
                                                    <option value="<?= $dataunit['unit_id'] ?>"><?= $dataunit['unit_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">กำหนดราคาทุน</label>
                                            <input type="text" class="form-control" name="product_price_cost"  id="inputSuccess">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">หมวดหมู่สินค้า</label>
                                            <select type="text" class="form-control" id="exampleInputUsername1" name="product_category">
                                                <?php
                                                foreach ($qcat as $dacat) : ?>
                                                    <option value="<?= $dacat['category_id'] ?>"><?= $dacat['category_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">หมวดหมู่แยกตามอาการ</label>
                                            <select type="text" class="form-control" id="exampleInputUsername1" name="product_symp">
                                                <?php
                                                foreach ($qsymp as $rows) : ?>
                                                    <option value="<?= $rows['symp_id'] ?>"><?= $rows['symp_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" for="inputSuccess">ประเภทสินค้า</label>
                                            <select type="text" class="form-control" id="exampleInputUsername1" name="product_type">
                                                <?php
                                                foreach ($querytype as $datatype) : ?>
                                                    <option value="<?= $datatype['type_id'] ?>"><?= $datatype['type_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                                        <a class="btn btn-danger rounded-pill" href=javascript:history.back(1)>ย้อนกลับ</a>
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