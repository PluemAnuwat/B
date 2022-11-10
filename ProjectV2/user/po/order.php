<?php
	session_start();
	
	$product_id = $_GET['product_id']; 
	$act = $_GET['act'];

	if($act=='add' && !empty($product_id))
	{
		if(isset($_SESSION['cart'][$product_id]))
		{
			$_SESSION['cart'][$product_id]++;
		}
		else
		{
			$_SESSION['cart'][$product_id]=1;
		}
	}

	if($act=='remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart'][$product_id]);
	}

	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $product_id=>$amount)
		{
			$_SESSION['cart'][$product_id]=$amount;
		}
	}
?>
