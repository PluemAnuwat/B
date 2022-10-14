<?php
if (isset($_GET['partner_id']) && !empty($_GET['partner_id'])) {
    $partner_id = $_GET['partner_id'];
    // $sql = "SELECT * , b.name_th as name_pro , c.name_th as name_amp , d.name_th as name_dis FROM view_partner a inner join provinces b on a.partnerd_pro = b.id  INNER JOIN amphures c on a.partnerd_amp = c.id INNER JOIN districts d ON a.partnerd_dis = d.id
    //   WHERE partner_id = '$partner_id'";
    $sql = "SELECT  * FROM view_partner  WHERE partner_id = '$partner_id'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query);
}
?>  