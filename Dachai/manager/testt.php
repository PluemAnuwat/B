<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//connect to database
$connection = mysqli_connect("localhost", "root", "", "dachai");

//run the store proc
$result = mysqli_query($connection, "CALL getEmployee('เภสัชกร')");


//loop the result set
while ($row = mysqli_fetch_array($result)){      ?>
  <p><?php echo $row['employee_name'] ; ?></p>
<?php
//   print_r($row);
// exit;
}
?>
</body>
</html>