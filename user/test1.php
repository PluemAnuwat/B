<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>Basic PHP PDO SQL SUM by month : devbanban.com 2021</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12"> <br>
                    <?php
                            //เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล
                            require_once 'connect.php';
                            //คิวรี่ข้อมูลมาแสดงในตาราง
                            $sql = ("SELECT DATE_FORMAT(sales_create, '%Y') AS sales_create, #เปลี่ยนฟอแมตวันที่จาก ป-ด-ว ให้เป็น ด-ป
                                SUM(product_total) as product_total #หาผลรวมของราคาขาย
                                FROM view_sales_detail 
                                GROUP BY DATE_FORMAT(sales_create, '%M-%Y') #จัดกลุ่มข้อมูลจาก ด-ป
                                ORDER BY DATE_FORMAT(sales_create, '%m-%Y') DESC #เรียงลำดับข้อมูลจากมากไปน้อย
                                ");
                              
                            $result = mysqli_query($con , $sql);
                        //  $result = mysqli_fetch_assoc($query);
                      ?>
                      <br>
                    <h3> PHP PDO SQL SUM : รายงานยอดขาย แยกเป็นรายปี</h3>

                    <table class="table table-striped  table-hover table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th width="30%">เดือน</th>
                                <th width="70%" class="text-center">ยอดขาย</th>
                            </tr>
                        </thead>
                        <tbody>

                           <?php
                           //ประกาศตัวแปรผลรวม
                           $total =0;
                           foreach($result as $row)  {
                            //หาผลรวมยอดขายใน loop โดยใข้ +=
                            $total += $row['product_total'];
                            ?>
                            <tr>
                                <td><?= $row['sales_create'];?></td>
                                <td align="right"><?= number_format($row['product_total'],2);?></td>
                            </tr>
                            <?php } ?>
                            <tr class="table-danger">
                                <td  class="text-center">Total</td>
                                <td align="right"><?= number_format($total,2);?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                  
                </div>
            </div>
        </div>
    </body>
</html>