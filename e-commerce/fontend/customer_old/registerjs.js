$(document).ready(function () {
    console.log("เริ่มการทำงาน");
  
    $(document).bind("contextmenu", function (e) {
      e.preventDefault();
    });
  
    $(document).bind("selectstart", function (e) {
      e.preventDefault();
    });
  
    $("#emp-SaveRegister").on("submit", function (e) {
      e.preventDefault();
  
      var formData = new FormData($(this)[0]);
  
      console.log(formData);
  
      $.ajax({
        url: "customer/registersql.php",
        type: "post",
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
                title: "Thank you Save Success",
                showConfirmButton: false,
                timer: 2000,
              });
              window.location.href = "./login.php";
            } else if (val["status"] == "NOS") {
              Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "This email has already been registered, please login.",
                showConfirmButton: false,
                timer: 2000,
              });
            }
          });
        },
      });
    });
  
    // $('#btnsave').on('click', function() {
    //     var mem_name = $('#mem_name').val();
    //     var mem_surname = $('#mem_surname').val();
    //     var mem_email = $('#mem_email').val();
    //     var mem_phone = $('#mem_phone').val();
    //     var mem_username = $('#mem_username').val();
    //     var mem_password = $('#mem_password').val();
    //     $.ajax({
    //         url: "serve/registersql.php",
    //         type: "post",
    //         data: {
    //             mem_name: mem_name,
    //             mem_surname: mem_surname,
    //             mem_phone: mem_phone,
    //             mem_username: mem_username,
    //             mem_email: mem_email,
    //             mem_password: mem_password
    //         },
    //         dataType: "json",
    //         success: function(data) {
    //             console.log(data);
    //             // var data = JSON.parse(data);
    //             if (data.msg == "YES") {
    //                 Swal.fire({
    //                     position: 'top-end',
    //                     icon: 'success',
    //                     title: 'Your work has been saved',
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 })
    //             } else if (data.msg == "NO") {
    //                 Swal.fire({
    //                     position: 'top-end',
    //                     icon: 'error',
    //                     title: 'Your work has been saved',
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 })
    //             }
    //         }
    //     })
    // })
  });
  