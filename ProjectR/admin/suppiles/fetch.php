<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
$columns = array('suppiles_name', 'suppiles_company','suppiles_phone','suppiles_email');

$query = "SELECT * FROM suppiles ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE suppiles_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR suppiles_company LIKE "%'.$_POST["search"]["value"].'%" 
 OR suppiles_phone LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY suppiles_id DESC ';
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
 $sub_array[] = '<div contenteditable class="update" data-suppiles_id="'.$row["suppiles_id"].'" data-column="suppiles_name">' . $row["suppiles_name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-suppiles_id="'.$row["suppiles_id"].'" data-column="suppiles_company">' . $row["suppiles_company"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-suppiles_id="'.$row["suppiles_id"].'" data-column="suppiles_phone">' . $row["suppiles_phone"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-suppiles_id="'.$row["suppiles_id"].'" data-column="suppiles_email">' . $row["suppiles_email"] . '</div>';
 $sub_array[] = '<button type="button"  name="delete" class="delete" style="border:none;" suppiles_id="'.$row["suppiles_id"].'"><img src="../images/delete.png" width="20px"></button>';
 $data[] = $sub_array; 
}

function get_all_data($connect)
{
 $query = "SELECT * FROM suppiles";
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