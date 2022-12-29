$(document).ready(function () {

  $(document).bind("contextmenu", function (e) {
    e.preventDefault();
  });

  $(document).bind("selectstart", function (e) {
    e.preventDefault();
  });

    $("#clickmodaladdress").on("click", function () {
    
        console.log("เริ่มต้นแสดงฟอร์มที่อยู่dsakhgsiyusagu");
    
        $("#modal_address").modal("toggle");
    
      });
    
      $("#insert_address").on("submit", function (event) {
    
        event.preventDefault();
    
        console.log("เริ่มต้นการเพิ่มที่อยู่dsakhgsiyusagu");
    
        var formData = new FormData($(this)[0]);
    
        $.ajax({
          url: "servecustomer/insert_address_customer.php",
    
          method: "POST",
    
          data: formData,
    
          processData: false,
    
          contentType: false,
    
          success: function (data) {

            let persontt = $.parseJSON(data);
    
            $.each(persontt, function (key, val) {
              
              console.log(data);
    
              if (val["status"] == "YES") {
               
                alert("Successfully");   

              } else {
                Swal.fire({
                  position: "top-end",
                  icon: "error",
                  title: "Your Not work has been saved",
                  showConfirmButton: false,
                  timer: 1500,
                });
              }

              $("#modal_address").modal("hide");

              location.reload();
              
            });
    
            // $('#insert_form')[0].reset();
    
          

            // $("#modal_address").modal("hide");

           
    
            // $('#employee_table').html(data);
          },
    
        });
    
      });
    
      $("#emp-SaveFormPassword").on("submit", function (event) {
    
        console.log("แก้ไขรหัสผ่าน");
    
      })





// รับค่าที่อยู่มาก่อน


        $(".clickedit_address").click(function(){

            var cusa_id = $(this).attr("data-id");

            console.log(cusa_id) ; 

            $.ajax({

                url: "servecustomer/check_address_customer.php",

                type: "post",		

                data: { cusa_id  : cusa_id },

                dataType: "json",

                success: function(data){

                    $.each(data, function(key, val) {

                        $(".update_cusa_id").val(val['cusa_id']);

                        $(".update_cusa_name").val(val['cusa_name']);

                        $(".update_cusa_surname").val(val['cusa_surname']);

                        $(".update_cusa_phone").val(val['cusa_phone']);

                        $(".update_cusa_id").val(val['cusa_id']);

                        $(".update_cusa_address").val(val['cusa_address']);

                        $(".update_cusa_province").val(val['cusa_province']);

                        $(".update_cusa_zipcode").val(val['cusa_zipcode']);

                        $(".update_cusa_note").val(val['cusa_note']);

                    })

                    $('#edit_address').modal('toggle');

                    set_update_address(cusa_id);

                    


                }

            })

        

        
        });

        function set_update_address(cusa_id) { 

          $("#submit_edit_address").click(function(){

            var a = $(".update_cusa_name_name").html($(".update_cusa_name").val()); 

            console.log(a) ; 

            $.ajax({

              type: "POST",

              url: "servecustomer/update_member_address.php",

              data: {  cusa_id: cusa_id   },

              dataType:'json',

              success: function (data) {

                  $.each(data, function (key, val) {



                  })

                }

              })


          });

        }


         $(".clickdelete_addressid").click(function(){

          var cusa_id =  $(".clickdelete_addressid").attr("data-id") ; 

            
            console.log(cusa_id);

            Swal.fire({

              title: 'Are you sure?',

              text: "You won't be able to revert this!",

              icon: 'warning',

              showCancelButton: true,

              confirmButtonColor: '#3085d6',

              cancelButtonColor: '#d33',

              confirmButtonText: 'Yes, delete it!'

            }).then((result) => {

              if (result.isConfirmed) {
                  
                  $.ajax({

                      url: "servecustomer/delete_address.php",
      
                      type: "post",	
      
                      data: { 
      
                        cusa_id  : cusa_id
      
                              },
      
                      dataType: "json",
      
                      success: function(data){
      
                      console.log(data);
                      
                          $.each(data, function(key, val) {
      
                              if(val['status'] == 'YES'){
      
      
                                  Swal.fire({
                                      position: 'center',
                                      icon: 'success',
                                      title: 'Success',
                                      showConfirmButton: false,
                                      timer: 1500
                                    })
      
                                    location.reload();
      
                              }else{
      
      
                                  Swal.fire({
                                      position: 'center',
                                      icon: 'error',
                                      title: 'error',
                                      showConfirmButton: false,
                                      timer: 1500
                                  })
      
                                  
                                  location.reload();
      
      
                              }
      
      
                          })
      
                      }
      
                  })
              }
            })


         });

         $("#emp-SaveFormPassword").on("submit", function (e) {

          e.preventDefault();
      
          var formData = new FormData($(this)[0]);
      
          console.log(formData);  


          $.ajax({
            url: "servecustomer/change_passwordsql.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false, 
            success: function (data) {

              console.log(data);
              
              let persontt = $.parseJSON(data);

              $.each(persontt, function (key, val) {

                if(val['status'] == "YES"){

                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else if(val['status'] == "NO"){

                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Password could not be updated',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else if(val['status'] == "NOM"){

                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Passwords do not match!',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else if(val['status'] == "NOPT"){

                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please type your current password accurately!',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else{

                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Incorrect username',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }

                $("#emp-SaveFormPassword").trigger('reset');


              })

            }

          })


         });











});