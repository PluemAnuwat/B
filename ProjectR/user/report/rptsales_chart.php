<center>
    <h3>รายงานสรุปยอดขายแบบแผนภูมิแท่ง</h3>
</center>

                <br>
                <br>
                <br>
                <div class="col-md-12 col-sm-6 col-xs-6">
    <div class="panel panel-back noti-box">
        <div class="text-box">
            <p class="main-text">ยอดขายสินค้าแต่ละเดือน</p>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
    $connect = mysqli_connect("localhost","root","akom2006","project");
    $sql22 = "SELECT * , MONTHNAME(a.sales_date) as monthname , SUM(product_total) as amount FROM sales a GROUP BY monthname";
    $query22 = mysqli_query($connect , $sql22);
    while ($data = mysqli_fetch_assoc($query22)) {
        $month[] =  ($data['monthname']);
        $amount[] = $data['amount'];
    }

    ?>


    <div style="width: 100%;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // === include 'setup' then 'config' above ===
        const labels = <?php echo json_encode($month) ?>;
        const data = {
            labels: labels,
            datasets: [{
                label: "รายได้รวม"  ,
                data: <?php echo json_encode($amount) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
            }]
        };

        

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
        </div>
    </div>
</div>