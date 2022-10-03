<?php
	@$product_id = $_GET['product_id'];
	@$functionn = $_GET['functionn'];

	// echo '<pre>'.print_r($_SESSION, 1).'</pre>';
	if ($functionn == 'update' ) {
		$amount_array = $_POST['amount'];
		foreach ($amount_array as $product_id => $amount) {
			$_SESSION['storeing'][$product_id] = $amount;
		}
	}
	
	if ($functionn == 'addd' && !empty($product_id)) {
		if (isset($_SESSION['storeing'][$product_id])) {
			$_SESSION['storeing'][$product_id]++;
		} else {
			$_SESSION['storeing'][$product_id] = 1;
		}
	}
	// echo '<pre>'.print_r($_SESSION, 1).'</pre>';

	if ($functionn == 'remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['storeing'][$product_id]);
	}

	?>