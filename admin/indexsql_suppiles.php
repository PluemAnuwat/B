<?php
$sql = "SELECT * FROM partner LEFT JOIN partner_detail ON partner.partner_id = partner_detail.partner1_id ";
$result = mysqli_query($con, $sql);
?>  