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

      var sto_id = $("#sto_id").html();
  
      if(sto_id = ""){

        var formData = new FormData($(this)[0]);

        console.log(formData);
    
        $.ajax({
    
            url: "serve/bacnk_account_sql.php",
    
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
    
                window.location.href='myaccount.php' ; 
    
    
              })
    
            }
    
        })


      }else{


        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Not Pay Now Becasue Bank Account in Member Not have',
          showConfirmButton: false,
          timer: 1500
        })

          
      }
    
    


});













$("#emp-savebank1").on("submit", function (e) {
  e.preventDefault();


var formData = new FormData($(this)[0]);

console.log(formData);

$.ajax({

    url: "serve/bacnk_account_sql.php",

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

        location.reload();


      })

    }

})


});


});
  
  