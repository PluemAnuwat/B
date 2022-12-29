$(document).ready(function () {
    console.log("เริ่มการทำงาน");
  
    $(document).bind("contextmenu", function (e) {
      e.preventDefault();
    });
  
    $(document).bind("selectstart", function (e) {
      e.preventDefault();
    });
  
    $("#emp-SaveForm1").on("submit", function (e) {
        
      console.log("สมัครสมาชิก");

      e.preventDefault();
  
      var formData = new FormData($(this)[0]);
  
      console.log(formData);
  
      $.ajax({
        url: "insertregis.php",
        type: "post",
        data: formData,
        processData: false,
        contentType: false, 
        success: function (data) {
          console.log(data);
          let persontt = $.parseJSON(data);
          $.each(persontt, function (key, val) {
          
            if (val["status"] == "YES") {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "save data successfully",
                showConfirmButton: false,
                timer: 2000,
              });
              window.location.href="login.php";
            } else if (val["status"] == "NOS") {
              Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "this username or email has already been registered.",
                showConfirmButton: false,
                timer: 2000,
                
              });
              
            }
          });
        },
      });
    });
  

  });
  