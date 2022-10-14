<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายงานแบบกราฟ โดย boychawin.com</title>
</head>

<body>

  <?php
  //โค้ดเชื่อมต่อฐานข้อมูล
  define('NAME', 'irms');
  define("USER", "root");
  define("PASS", "");
  define("HOST", "localhost");
  $con = mysqli_connect("localhost", "root", "", "dachai");

  //ถ้าต้องการให้แสดงกราฟแท่ง แบบ รายวัน ,รายเดือนหรือรายปี ให้เปลี่ยนตรง DATE_FORMAT(booking_start_date, 'เปลี่ยนตรงนี้')
  //เดียวจะแปะโค้ดไว้ให้

  $query = "
SELECT COUNT(*) AS totol, DATE_FORMAT(po_Create, '%y% ') AS booking_start_date
FROM view_po_show 
GROUP BY DATE_FORMAT(po_Create, '%M%' )
";
// DATE_FORMAT(po_Create, '%M %d %Y%')

  $result = mysqli_query($con, $query);
  $resultchart = mysqli_query($con, $query);
  // chart
  $datesave = [];
  $totol = [];

  while ($rs = mysqli_fetch_array($resultchart)) {
    $datesave[] = "\"" . $rs['booking_start_date'] . "\"";
    $totol[] = "\"" . $rs['totol'] . "\"";
  }
  $datesave = implode(',', $datesave);
  $totol = implode(',', $totol);
  ?>
  <h3 align="center">รายงานการจองในแบบกราฟแท่ง</h3>
  <table class="table table-bordered table-responsive-sm w-50" width="200" border="1" cellpadding="0" cellspacing="0" align="center">
    <thead>
      <tr>
        <th width="30%">เดือน</th>
        <th width="10%">ยอดจอง</th>
      </tr>
    </thead>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
      <tr>
        <td align="center"><?php echo $row['booking_start_date']; ?></td>
        <td align="right"><?php echo number_format(
                            $row['totol']
                          ); ?></td>
      </tr>
    <?php } ?>
  </table>
  <?php mysqli_close($con); ?>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
  <hr>
  <p align="center">

    <canvas id="myChart" width="800px" height="300px"></canvas>
    <script>
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php echo $datesave; ?>

          ],
          datasets: [{
            label: 'รายงานภาพรวม แยกตามวันเดือนปี (คน)',
            data: [<?php echo $totol; ?>],
            backgroundColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(75, 192, 192, 1)'
            ],
            borderColor: [
              //ตรงนี้สามารถใส่ขอบสีได้เลย
            ],
            borderWidth: 2
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>
  </p>
  <!-- ขอบคุณข้อมูลจาก devbanban.com-->
</body>

</html>

