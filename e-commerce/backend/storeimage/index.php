<?php 
   require '../include_backend/head.php' ;
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
   <!-- Layout wrapper -->
   <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
         <!-- Content wrapper -->
         <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
               <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">STORE IMAGE</span></h4>
               <div class="row">
                  <div class="col-md-12">
                     <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                           <a type=" button" class="nav-link active" id="btn-add" href="add_form.php"><i class="bx bx-plus"></i> ADD IMAGE</a>                                                                    
                        </li>
                        <li class="nav-item">
                           <a type=" button" class="nav-link active" id="btn-view" href="#"><i class="bx bx-show-alt"></i> VIEW IMAGE</a>                                                                    
                        </li>
                     </ul>
                     <div class="card mb-4">
                        <h5 class="card-header">IMAGE LIST</h5>
                        <hr class="my-0" /><br>
                        <!-- Table -->
                        <div class="table-responsive text-nowrap">
                           <div class="content-loader">
                              <table class="table table-borderless" id="myTable">
                                 <thead>
                                    <tr>
                                       <th style="text-align:center;">ID</th>
                                       
                                       <th style="text-align:center;">IMAGE</th>
                                       <th style="text-align:center;">NAME RECrod</th>
                                       <th style="text-align:center;">ACTIONS</th>
                                    </tr>
                                 </thead>
                                 <tbody id="mysfutton">
                                    <?php
                                       
                                       
                                       
                                          $sql ="SELECT * FROM akksofttech_member_store_image WHERE sto_id = '".$_SESSION['akksofttechsess_stoid']."'" ;
                                          $result = mysqli_query($connect,$sql) or die ("error ".mysqli_error($connect));
                                          while ($row = mysqli_fetch_array($result)) {
                                         
                                          
                                    ?>
                                    <tr>
                                    <!-- // `img_id``mem_id``sto_id``sto_name``img_name``mem_id_save``mem_name``img_ip``img_start_date` -->
                                       <td style="text-align:center;"><?php echo $row['img_id']; ?></td>
                                       <td style="text-align:center;"><img src="../getimg/store/<?php echo $row['img_name']; ?>"  height="180px;" width="150px;"></td>
                                       <td style="text-align:center;"><?php echo $row['mem_name']; ?></td>
                                       
                                       <td style="text-align:center;">
                                          <div class="dropdown">
                                             <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                             <i class="bx bx-dots-vertical-rounded"></i>
                                             </button>
                                             <div class="dropdown-menu">
                                                <a href="add_form.php?id=<?php echo $row['img_id']; ?>"  class="dropdown-item" title="Edit"
                                                   ><i class="bx bx-edit-alt me-1"></i> EDIT</a
                                                   >
                                                <a class="delete dropdown-item"  id="<?php echo $row['img_id']; ?>" 
                                                ><i class="bx bx-trash me-1" ></i> DELETE</a>
                                                

                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <!-- END Table -->           
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- / Content -->              
   <?php require '../include_backend/script.php' ?>
   <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  
<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

   <script type="text/javascript" src="crud.js"></script>
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
      
      
      
      
      	
      	
      
      });
   </script>
  
</body>
</html>