$(document).ready(function () {

  $(document).bind("contextmenu", function (e) {
    e.preventDefault();
  });

  $(document).bind("selectstart", function (e) {
    e.preventDefault();
  });

    $("#clickmodaladdress").on("click", function () {
    
        console.log("เริ่มต้นแสดงฟอร์มที่อยู่");
    
        $("#modal_address").modal("toggle");
    
      });
    
      $("#insert_address").on("submit", function (event) {
    
        event.preventDefault();
    
        console.log("เริ่มต้นการเพิ่มที่อยู่");
    
        var formData = new FormData($(this)[0]);
    
        $.ajax({
          url: "customer/insert_address_customer.php",
    
          method: "POST",
    
          data: formData,
    
          processData: false,
    
          contentType: false,
    
          success: function (data) {
    
            console.log(data);
    
            let persontt = $.parseJSON(data);
    
            $.each(persontt, function (key, val) {
              
              console.log(data);
    
              if (val["status"] == "YES") {
                Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Your work has been saved",
                  showConfirmButton: false,
                  timer: 1500,
                });
              } else {
                Swal.fire({
                  position: "top-end",
                  icon: "error",
                  title: "Your Not work has been saved",
                  showConfirmButton: false,
                  timer: 1500,
                });
              }
            });
    
            // $('#insert_form')[0].reset();
    
            $("#modal_address").modal("hide");
    
            // $('#employee_table').html(data);
          },
    
        });
    
      });
    
      $("#emp-SaveFormPassword").on("submit", function (event) {
    
        console.log("แก้ไขรหัสผ่าน");
    
      })





// รับค่าที่อยู่มาก่อน


        $("#clickedit_address").click(function(){

            var cusa_id    = $(this).attr("data-id");

            $.ajax({

                url: "customer/check_address_customer.php",

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

            alert(a) ; 

            $.ajax({

              type: "POST",

              url: "serve/update_member_dinningtable.php",

              data: {  cusa_id: cusa_id   },

              // dataType:'json',

              success: function (data) {

                  $.each(data, function (key, val) {



                  })

                }

              })


          });

        }


         

          


        //  cheange password

        var frm = $('#emp-SaveFormPassword');

        frm.submit(function(e){

          e.preventDefault();

          var formdata = frm.serialize();

          formdata += '&' + $('#change_password').attr('name') + '=' + $('#change_password').attr('value');

          $.ajax({

            type: frm.attr('method'),

            url: frm.attr('action'),

            data: formData,

            success: function(data){

                if(val['status'] == "Password Changed Successfully!"){

                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else if(val['status'] == "Password could not be updated"){

                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Password could not be updated',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else if(val['status'] == "Passwords do not match!"){

                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Passwords do not match!',
                    showConfirmButton: false,
                    timer: 1500
                  })

                }else if(val['status'] == "Please type your current password accurately!"){

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


            },

            error: function(jqXHR, textStatus, errorThrown) {

              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error!!',
                showConfirmButton: false,
                timer: 1500
              })


            }

        });


        });

     











});