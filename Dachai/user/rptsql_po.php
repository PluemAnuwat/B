
<?php
// echo '<pre>'.print_r($_REQUEST, 1).'</pre>';
// exit;
include "function_paginate.php";
// @$ds = $_GET["datest"];
// @$de = $_GET["dateed"];
// @$report = $_GET["price_op"];

@$ds = $_POST["datest"];
@$de = $_POST["dateed"];
@$report = $_POST["price_op"];
$sql = "";
if ($report == "") {
	if ($ds == "" && $de == "") {
		// $sql = "SELECT *,DATE_FORMAT(orders.order_date, '%d-%m-%Y') AS order_date ,
		// DATE_FORMAT(customers.cust_date, '%d-%m-%Y') AS x FROM orders inner join customers 
		// on orders.cust_id = customers.cust_id inner join orders_details 
		// on orders.order_id = orders_details.order_id inner join products 
		// on products.pro_id = orders_details.pro_id order by order_date ASC";
		$sql = "SELECT   * , count(a.po_RefNo) as count ,
        SUM(c.product_price_cost *  a.product_quantity) * 0.07 + sum(c.product_price_cost * a.product_quantity) as sum
         from view_po_show a left join partner b ON a.po_saler = b.partner_id LEFT JOIN product_price c
        ON a.product_id = c.product_id group by a.po_RefNo";
	} else if ($ds != "" && $de != "") {
		// $sql = "SELECT *,DATE_FORMAT(orders.order_date, '%d-%m-%Y') AS order_date FROM orders 
		// inner join customers on orders.cust_id = customers.cust_id
		// inner join orders_details on orders.order_id = orders_details.order_id inner join products on products.pro_id = orders_details.pro_id
		// where order_date BETWEEN '$ds' AND '$de' ";
		$sql = "SELECT   *, count(a.po_RefNo) as count ,
        SUM(c.product_price_cost *  a.product_quantity) * 0.07 + sum(c.product_price_cost * a.product_quantity) as sum
         from view_po_show a left join partner b ON a.po_saler = b.partner_id LEFT JOIN product_price c
        ON a.product_id = c.product_id WHERE a.po_Create BETWEEN '$ds' AND '$de'";
	}
} else if ($report == 1) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT   * , count(a.po_RefNo) as count ,
        SUM(c.product_price_cost *  a.product_quantity) * 0.07 + sum(c.product_price_cost * a.product_quantity) as sum
         from view_po_show a left join partner b ON a.po_saler = b.partner_id LEFT JOIN product_price c
        ON a.product_id = c.product_id order by a.po_RefNo ASC";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT   * , count(a.po_RefNo) as count ,
        SUM(c.product_price_cost *  a.product_quantity) * 0.07 + sum(c.product_price_cost * a.product_quantity) as sum
         from view_po_show a left join partner b ON a.po_saler = b.partner_id LEFT JOIN product_price c
        ON a.product_id = c.product_id WHERE a.po_Create BETWEEN '$ds' AND '$de' ";
	}
} else if ($report == 2) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT *  FROM view_sales_detail LEFT JOIN product_price ON view_sales_detail.product_id =  product_price.product_id ";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *   FROM view_sales_detail LEFT JOIN product_price ON view_sales_detail.product_id =  product_price.product_id WHERE sales_create BETWEEN '$ds' AND '$de' ";
	}
} else if ($report == 3) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT * FROM employee ";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *  FROM employee  ";
	}
} else if ($report == 4) {
	if ($ds == "" && $de == "") {
		$sql = "SELECT * FROM partner a left join partner_detail b ON  a.partner_id = b.partner1_id  ";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *  FROM partner a left join partner_detail b ON  a.partner_id = b.partner1_id   ";
	}
} else if ($report == 5) {
		if ($ds == "" && $de == "") {
		$sql = "SELECT * FROM view_product_stockv3 ";
	} else if ($ds != "" && $de != "") {
		$sql = "SELECT *  FROM view_product_stockv3  WHERE product_start_date BETWEEN '$ds' AND '$de'  ";
	}
} else if ($report == 6) {
	if ($ds == "" && $de == "") {
		$date = date("Y/m/d");
		$sql = "SELECT * , DATEDIFF(product_end_date ,  now() ) AS datediff  , (product_quantity * product_price_sell ) AS qtysell  FROM view_product_stockv3  ";
		
} else if ($ds != "" && $de != "") {
	$sql = "SELECT * , DATEDIFF( product_end_date , now() ) AS datediff , (product_quantity * product_price_sell ) AS qtysell  FROM view_product_stockv3   WHERE sales_create  BETWEEN '$ds' AND '$de'  ";
}
}
$re = mysqli_query($con, $sql);
?>