<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
$columns = array('customer_name', 'customer_last','customer_phone','customer_drug');

$query = "SELECT * FROM customer ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE customer_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR customer_last LIKE "%'.$_POST["search"]["value"].'%" 
 OR customer_phone LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY customer_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-customer_id="'.$row["customer_id"].'" data-column="customer_name">' . $row["customer_name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-customer_id="'.$row["customer_id"].'" data-column="customer_last">' . $row["customer_last"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-customer_id="'.$row["customer_id"].'" data-column="customer_phone">' . $row["customer_phone"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-customer_id="'.$row["customer_id"].'" data-column="customer_drug">' . $row["customer_drug"] . '</div>';
 $sub_array[] = '<button type="button"  name="delete" class="delete" style="border:none;" customer_id="'.$row["customer_id"].'"><img src="../images/delete.png" width="20px"></button>';
 $data[] = $sub_array; 
}

function get_all_data($connect)
{
 $query = "SELECT * FROM customer";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>