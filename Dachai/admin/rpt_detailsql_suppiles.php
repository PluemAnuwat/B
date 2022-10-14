<?php
$sql = "SELECT * FROM partner a left join partner_detail b ON  a.partner_id = b.partner1_id ";
$query = mysqli_query($con, $sql);
?>  