
<?php
	
	@session_start();
	

	
	if(empty($_SESSION['akksofttechsess_memid'])  || empty($_SESSION['akksofttechsess_username'])  || empty($_SESSION['akksofttechsess_name'])     ) {
		// echo "ไม่อนุญาติให้เข้าสู่ระบบ";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=login.php'>";
		exit;	
	}
	
?>

