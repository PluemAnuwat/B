    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">สินค้า</h1>
                        <a href="?page=product_insert" class="d-none d-sm-inline-block btn  btn-primary shadow-sm"><i
                        style="width:100%;"    class="fas fa-download fa-sm text-white-100"></i> เพิ่มข้อมูลสินค้า</a>

                    </div>

                         <!-- DataTales Example -->
                         <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>

                            <?php $sql ="SELECT * FROM product a JOIN unit b ON a.product_unit = b.unit_id 
                            JOIN type_product c ON a.product_type = c.type_id
                            JOIN product_price d ON a.product_id = d.product_id
                            ";
                                $result = mysqli_query($connect , $sql);
                            ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>หน่วยนับสินค้า</th>
                                        <th>ประเภทสินค้า</th>
                                        <th>ราคาทุน</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>หน่วยนับสินค้า</th>
                                        <th>ประเภทสินค้า</th>
                                        <th>ราคาทุน</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                    $i = 1 ;
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td scope="row"><img src=".\image\<?= $row['product_img']; ?>" width="100" height="100"></td>
                                            <td><?php echo  $row['product_name'] ?></td>
                                            <td><?php echo  $row['unit_name'] ?></td>
                                            <td><?php echo  $row['type_name'] ?></td>
                                            <td scope="row"><?php echo  number_format($row['product_price_cost'],2) ?></td>
                                            <td scope="row"><a href="?page=<?= $_GET['page'] ?>&function=update&product_id=<?= $row['product_id'] ?>" class="btn  btn-secondary text-white">แก้ไขข้อมูล</a></td>
                                            <!-- <td scope="row"><img src="../images/delete.png" width="20px"></td> -->
                                            <td>  <a href="?page=<?= $_GET['page'] ?>&function=delete&product_id=<?= $row['product_id'] ?>" class="btn  btn-danger  text-white" onclick="return confirm('ยืนยันการลบข้อมูล')"><i class="fa-solid fa-rectangle-xmark "></i>ลบข้อมูล</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
