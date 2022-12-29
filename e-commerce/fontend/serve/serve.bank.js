$(document).ready(function () {

    console.log("เริ่มการทำงาน");
  
    $(document).bind("contextmenu", function (e) {
      e.preventDefault();
    });
  
    $(document).bind("selectstart", function (e) {
      e.preventDefault();
    });
  
    $("#emp-savebank").on("submit", function (e) {
      e.preventDefault();
  
    
    var formData = new FormData($(this)[0]);

    console.log(formData);

    $.ajax({

        url: "serve/bacnkaccountsql.php",

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

       
            }else{

              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Your Not work has been saved!',
                showConfirmButton: false,
                timer: 1500
              })

            }

            window.location.href='myaccount.php?page=myorder' ; 


          })

        }

    })


});

});
  
  