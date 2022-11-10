<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "akom2006", "project");
$columns = array('cate_name');

$query = "SELECT * FROM category ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE cate_name LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY cate_id DESC ';
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
 $sub_array[] = '<div contenteditable class="update" data-cate_id="'.$row["cate_id"].'" data-column="cate_name">' . $row["cate_name"] . '</div>';
 $sub_array[] = '<button type="button"  name="delete" class="delete btn btn-danger" style="border:none;" cate_id="'.$row["cate_id"].'">ลบ</button>';
 $data[] = $sub_array; 
}

function get_all_data($connect)
{
 $query = "SELECT * FROM category";
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