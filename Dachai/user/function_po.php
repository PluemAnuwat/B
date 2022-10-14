<?php
	@$product_id = $_GET['product_id'];
	@$fuction = $_GET['fuction'];

	// echo '<pre>'.print_r($_SESSION, 1).'</pre>';
	if ($fuction == 'update' ) {
		$amount_array = $_POST['amount'];
		foreach ($amount_array as $product_id => $amount) {
			$_SESSION['carting'][$product_id] = $amount;
		}
	}
	if ($fuction == 'add' && !empty($product_id)) {
		if (isset($_SESSION['carting'][$product_id])) {
			$_SESSION['carting'][$product_id]++;
		} else {
			$_SESSION['carting'][$product_id] = 1;
		}
	}
	// echo '<pre>'.print_r($_SESSION, 1).'</pre>';

	if ($fuction == 'remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['carting'][$product_id]);
	}
