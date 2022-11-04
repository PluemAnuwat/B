<html>
<head>
<meta charset="UTF-8">


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--  เรียกใช้ Font Awesome-->
<script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

<script src="http://fordev22.com/picker_date_thai.js"></script>
<!------ Include the above in your HEAD tag ---------->





<title>fordev22</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


	<br>
	<br>
	<br>
	<br>
	<br>

	<center><h2>fordev22 (Date Picker พ.ศ.)</h2></center>




	<br>
	
	<br>
	<br>



	<form action="date_ok.php" method="POST" accept-charset="utf-8">

          <div class="container">
            <div class="row">

            	<div class="col-md-3">
              </div>

              

              <div class="col-md-6">
                
                <input id="my_date" name="billpayment_date2"   class="form-control"  />
                <br>
                <button type="submit" class="btn btn-info btn-block">ทดสอบ</button>
              </div>

              <div class="col-md-3">
              </div>

            </div>
          </div>
          
        </form>




</body>

<script>

picker_date(document.getElementById("my_date"),{year_range:"-45:+10"});
picker_date(document.getElementById("my_date2"),{year_range:"-45:+10"});

</script>
</html>