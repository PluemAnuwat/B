<?php include 'updatesql_type.php' ?>
<div class="row">
    <div class="col-md-12">
        <h2>แก้ไขข้อมูล</h2>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                แบบฟอร์มข้อมูล
            </div>
            <div class="panel-body">
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSuccess">ชื่อข้อมูล</label>
                                    <?php if(@$result['category_id'] )  { ?>
                                    <input class="form-control" name="category_name" value="<?= $result['category_name'] ?>" type="text" id="html5-text-input" />
                                    <?php }elseif(@$result['type_id']  ) { ?>
                                        <input class="form-control" name="type_name" value="<?= $result['type_name'] ?>" type="text" id="html5-text-input" />
                                        <?php }elseif(@$result['symp_name'] ) { ?>
                                            <input class="form-control" name="symp_name" value="<?= $result['symp_name'] ?>" type="text" id="html5-text-input" />
                                            <?php }elseif(@$result['unit_name'] ) { ?>
                                            <input class="form-control" name="unit_name" value="<?= $result['unit_name'] ?>" type="text" id="html5-text-input" />
                                            <?php } ?>
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
