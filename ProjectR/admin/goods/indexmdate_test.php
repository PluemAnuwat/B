<?php $connect = mysqli_connect("localhost", "root", "akom2006", "project"); ?>
<style>
    .dateInput{
        display: inline-block;
    }
</style>
<?php
if (isset($_GET['good_RefNo']) && !empty($_GET['good_RefNo'])) {
  $good_RefNo = $_GET['good_RefNo'];
  $sql = "SELECT *  
  , sum(c.product_price_cost * a.product_quantity ) as qty ,
  sum(c.product_price_cost )  as sum ,
  sum(c.product_price_cost * a.product_quantity ) * 0.07 + sum(c.product_price_cost * a.product_quantity ) as vat ,
  sum(c.product_price_cost * a.product_quantity ) * 0.07 as vatt
   ,(c.product_price_cost * a.product_quantity) as plusel 
FROM  goods_detailproduct a INNER JOIN product_price c ON a.product_id = c.product_id
INNER JOIN goods aaa ON a.good_id = aaa.good_id
 WHERE aaa.good_RefNo = '$good_RefNo' ";
  $query = mysqli_query($connect, $sql);
  $result1 = mysqli_fetch_array($query);
}
date_default_timezone_set('Asia/Bangkok');

?>

<form class="forms-sample" enctype="multipart/form-data" method="POST" action="?page=manager_goods_test&function=insert">
<a href=javascript:history.back(1)><img src="../images/back1.png" width="60px"></a>
    <button style="border:none;" class="mr-2"><img src="../images/yes.png" width="60px;"></button>
    <a class="text-danger ">ถ้าไม่ใส่วันเดือนปีที่ผลิต กับ วันที่หมดอายุ ระบบจะทำการกำหนดเอาวันที่ปัจจุันเป็นวันที่ผลิต กับ นับอีก 3 ปี จากวันปัจจุบันเป็นวันหมดอายุ</a>
    <table class="table table-hover table-bordered " id="">
        <tr>
            <td colspan="7">
                <strong>รายการสินค้า</strong>
            </td>
        </tr>
        <tr>
            <td>ลำดับ</td>
            <td>รหัสสินค้า</td>
            <td>ชื่อสินค้า</td>
            <td>วันที่ผลิต</td>
            <td>วันหมดอายุ</td>
            <td>จำนวน</td>
            <td>จำนวน</td>
            <td>ราคา</td>
        </tr>
        <tbody>

            <?php
                        $i=1;
                       $sql = "SELECT * 
                       ,(d.product_price_cost * a.product_quantity) as plusel ,
                       a.product_quantity AS product_quantity
                        FROM   goods_detailproduct a join goods aaa ON a.good_id = aaa.good_id    
                        JOIN product b ON a.product_id = b.product_id 
                        JOIN product_price d ON a.product_id = d.product_id 
                        WHERE aaa.good_RefNo = '$good_RefNo'";
                   
                   
                //    $sql = "SELECT  a.* 
                //     --  , (d.product_price_cost * a.product_quantity) as plusel , a.product_quantity AS product_qty 
                //     FROM   goods_detailproduct a 
                //     JOIN goods aaa ON a.goods_detailproid = aaa.good_id
                //     JOIN product b ON a.product_id = b.product_id
                //     JOIN product_price d ON a.product_id = d.product_id
                //     JOIN product_quantity c ON a.product_id = c.product_id
                //     WHERE aaa.good_RefNo = '$good_RefNo'
                //     ";
                    // echo '<pre>'.print_r($sql, 1).'</pre>';
                    $query = mysqli_query($connect, $sql);
                    while ($rowp = mysqli_fetch_assoc($query)) {
                    ?>
            <tr>
                <input type="hidden" name="good_RefNo[]" value="<?= $rowp['good_RefNo']?>">
                <input type="hidden" name="po_RefNo[]" value="<?= $rowp['po_RefNo']?>">
                <td class="col"><?php echo  $i++ ; ?></td>
                <td class="col"> <input type="hidden" name="product_id[]"
                        value="<?= $rowp['product_id'] ?>"><?php echo $rowp['product_id'] ?></td>
                <td class="col-5"><a name="product_name[$product_id]"><?= $rowp['product_name'] ?></a></td>
                <td class="col-2 text-end" ><input type='text' class="dateInput  form-control "  name="product_start_date[]" autocomplete="off" /></td>
                <td class="col-2 text-end"><input type='text'  class="dateInput form-control" name="product_end_date[]" autocomplete="off" /></td>
                <!-- <td class="col-2 text-end" ><input type='date' class="  form-control "  name="product_start_date[]" autocomplete="off" /></td> -->
                <!-- <td class="col-2 text-end"><input type='date'  class=" form-control" name="product_end_date[]" autocomplete="off" /></td> -->
                <td class="col-1 text-end"><input type="hidden" name="product_quantity[]" 
                        value="<?= $rowp['product_quantity'] ?>"><?php echo  $rowp['product_quantity'] ?></td>
                <td class="col-1 text-end"><input type="hidden" name="product_price_cost[]"
                        value="<?= $rowp['product_price_cost'] ?>"><?php echo  number_format($rowp['product_price_cost'],2) ?></td>
                </td>
                <td class="col-1 text-end"><?php echo  number_format($rowp['plusel'],2) ?></td>
            </tr>
            <?php } ?>

        </tbody>
        <tr>
            <td colspan="6"></td>
            <td>ราคารวม</td>
            <td class="text-end"><?php echo number_format($result1['qty'], 2) ?> บาท</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td>ภาษี(7%)</td>
            <td class="text-end"><?php echo number_format($result1['vatt'], 2) ?> บาท</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td>ราคารวมภาษี</td>
            <td class="text-end"><?php echo number_format($result1['vat'], 2) ?> บาท</td>
        </tr>
    </table>
</form>




<?php  
$jquery_ui_v="1.8.5";  
$theme=array(  
    "0"=>"base",  
    "1"=>"black-tie",  
    "2"=>"blitzer",  
    "3"=>"cupertino",  
    "4"=>"dark-hive",  
    "5"=>"dot-luv",  
    "6"=>"eggplant",  
    "7"=>"excite-bike",  
    "8"=>"flick",  
    "9"=>"hot-sneaks",  
    "10"=>"humanity",  
    "11"=>"le-frog",  
    "12"=>"mint-choc",  
    "13"=>"overcast",  
    "14"=>"pepper-grinder",  
    "15"=>"redmond",  
    "16"=>"smoothness",  
    "17"=>"south-street",  
    "18"=>"start",  
    "19"=>"sunny",  
    "20"=>"swanky-purse",  
    "21"=>"trontastic",  
    "22"=>"ui-darkness",  
    "23"=>"ui-lightness",  
    "24"=>"vader" 
);  
$jquery_ui_theme=$theme[22];  
?>  
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/<?=$jquery_ui_v?>/themes/<?=$jquery_ui_theme?>/jquery-ui.css" />  
<style type="text/css">  
/* ปรับขนาดตัวอักษรของข้อความใน tabs  
สามารถปรับเปลี่ยน รายละเอียดอื่นๆ เพิ่มเติมเกี่ยวกับ tabs 
*/ 
.ui-tabs{  
    font-family:tahoma;  
    font-size:11px;  
}  
</style>  
<style type="text/css">
/* Overide css code กำหนดความกว้างของปฏิทินและอื่นๆ */
.ui-datepicker{
    width:220px;
    font-family:tahoma;
    font-size:11px;
    text-align:center;
}
</style>
</head>
 
<body>
 
<!--  
<div style="margin:auto;width:95%;">
 
<input name="dateInput" type="text" id="dateInput" value="" />
 
</div>
  -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
    var dateBefore=null;
    $(".dateInput").datepicker({
        dateFormat: 'dd-mm-yy',
        buttonText: "เลือก",
        showOn: 'button',
//      buttonImage: 'http://jqueryui.com/demos/datepicker/images/calendar.gif',
        buttonImageOnly: false,
        dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'], 
        monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
        changeMonth: true,
        changeYear: true,
        beforeShow:function(){  
            if($(this).val()!=""){
                var arrayDate=$(this).val().split("-");     
                arrayDate[2]=parseInt(arrayDate[2])-543;
                $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
            }
            setTimeout(function(){
                $.each($(".ui-datepicker-year option"),function(j,k){
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
                    $(".ui-datepicker-year option").eq(j).text(textYear);
                });             
            },50);
        },
        onChangeMonthYear: function(){
            setTimeout(function(){
                $.each($(".ui-datepicker-year option"),function(j,k){
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;
                    $(".ui-datepicker-year option").eq(j).text(textYear);
                });             
            },50);      
        },
        onClose:function(){
            if($(this).val()!="" && $(this).val()==dateBefore){         
                var arrayDate=dateBefore.split("-");
                arrayDate[2]=parseInt(arrayDate[2])+543;
                $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);    
            }       
        },
        onSelect: function(dateText, inst){ 
            dateBefore=$(this).val();
            var arrayDate=dateText.split("-");
            arrayDate[2]=parseInt(arrayDate[2])+543;
            $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);
        }   
 
    });
     
 
     
     
     
});
</script>