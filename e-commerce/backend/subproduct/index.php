<?php require '../include_backend/head.php' ;


@session_start();
require_once '../include/condb.php';



?>
<style>
::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 0px;
}
</style>
<body>


<style>
</style>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
     
            <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SUB PRODUCT</span></h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a type=" button" class="nav-link active" id="btn-add" href="add_form.php"><i class="bx bx-plus"></i> ADD SUB PRODUCT</a>                                                                    
                  
                    </li>

                    <li class="nav-item">
                      <a type=" button" class="nav-link active" id="btn-view" href="#"><i class="bx bx-show-alt"></i> VIEW SUB PRODUCT</a>                                                                   
                  
                    </li>
                   
                  </ul>
                <!-- ตาราง -->
                <div class="card mb-4">
                        <h5 class="card-header">SUB PRODUCT LIST</h5>
                        <hr class="my-0" /><br>
                        <!-- Table -->
                        <div class="table-responsive text-nowrap">
                        <div class="content-loader">

                  <table class="table table-hover" id="myTable">
                  <thead>
                      <tr> 
                      
                        <th style="text-align:center;">ID</th>
                        <th style="text-align:center;">Name</th>
                        <th style="text-align:center;">SKU</th>
                        <th style="text-align:center;">PICTURE</th>
                        <th style="text-align:center;">Product</th>
                        <th style="text-align:center;">PRICE</th>
                        <th style="text-align:center;">DETAIL</th>
                        <th style="text-align:center;">QUANTITY</th>
                        <th style="text-align:center;">ACTIONS</th>
                        
                        
                      </tr>
                  </thead>
                  <tbody class="table-border-bottom-0" id="mysfutton">
                  <?php
                                       
                     
                                                  
                                       $sql ="SELECT sp.sprod_id, sp.sprod_name, sp.sprod_sku, 
                                       sp.sprod_image, sp.sprod_price, sp.sprod_detail,
                                       sp.prod_id, p.prod_name, sp.sprod_quantity
                                       FROM  akksofttech_subproduct AS sp
                                       INNER JOIN  akksofttech_product AS p ON sp.prod_id = p.prod_id
                                       WHERE sp.mem_id = '".$_SESSION['akksofttechsess_memid']."'" ;
                                       $result = mysqli_query($connect,$sql) or die ("error ".mysqli_error($connect));
                                       while ($row = mysqli_fetch_array($result)) {
                                                    
                                                   
                      ?>
                                   <tr>
                                                
                                   <td style="text-align:center;"><?php echo $row['sprod_id']; ?></td>
                                   <td style="text-align:center;"><?php echo $row['sprod_name']; ?></td>
                                   <td style="text-align:center;"><?php echo $row['sprod_sku']; ?></td>
                                   <td style="text-align:center;"><img src="../getimg/sprod/<?php echo $row['sprod_image']; ?>" height="180px;" width="150px;"></td>
                                   <td style="text-align:center;"><?php echo $row['prod_name']; ?></td>
                                   <td style="text-align:center;"><?php echo $row['sprod_price']; ?></td>
                                   
                                   <td style="text-align:center;"><?php echo $row['sprod_detail']; ?></td>
                                   <td style="text-align:center;"><?php echo $row['sprod_quantity']; ?></td>
                                  
                                   <td style="text-align:center;">
                                   <div class="dropdown">
                                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                         <i class="bx bx-dots-vertical-rounded"></i>
                                     </button>
                                   <div class="dropdown-menu">
                                         <a href="add_form.php?id=<?php echo $row['sprod_id']; ?>"  class="dropdown-item" href="#" title="Edit"
                                         ><i class="bx bx-edit-alt me-1"></i> EDIT</a
                                         >
                                         <a class="delete dropdown-item"  id="<?php echo $row['sprod_id']; ?>" href="#"
                                         ><i class="bx bx-trash me-1" ></i> DELETE</a
                                         >
                                   </div>
                                   </div>
                                   </td>
                                   </tr>
                                   <?php } ?>
                  </tbody>
              </div>
            <div> 
            <div> 

            <!-- End ตาราง -->
                  
                 
                  
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
          

        </div>
    </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <?php require '../include_backend/script.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="crud.js"></script>
    <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
   <script type="text/javascript">
      $(document).ready(function(){
      	$("#btn-view").hide();
      	$("#btn-add").click(function(){
      		$(".content-loader").fadeOut('slow', function(){
      			$(".content-loader").fadeIn('slow');
      			$(".content-loader").load('add_form.php');
      			$("#btn-add").hide();
      			$("#btn-view").show();
      		});
      	});
      
      	$("#btn-view").click(function(){
      		$("body").fadeOut('slow', function(){
      			$("body").load('index.php');
      			$("body").fadeIn('slow');
      			window.location.href="index.php";
      		});
      	});
      
      
      
      
      	
      	var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
    alert(table.row( this ).data()[0]);

} );
      
      });
      
   </script>


</body>

</html>