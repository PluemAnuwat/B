// JavaScript Document

$(document).ready(function(){


    $("#emp-SaveForm1").on("submit", function (event) {
        event.preventDefault(); //prevent default submitting
        var formData = new FormData($(this)[0]);          
        // console.log(formData);              
        $.ajax({
            url: "create.php",
            type: "post",
            data: formData,
            processData: false, //Not to process data
            contentType: false, //Not to set contentType
            success: function (data) {
                console.log(data);
                    let persontt = $.parseJSON(data);
    
                       
                    $.each(persontt, function(key,vi){
                        console.log(data);
                        if( vi['status'] == 'YES' ){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Successfully Saved',
                                showConfirmButton: false,
                                timer: 1500
                              })      
                          
                            
                        }
                        window.location.href="index.php"; 
                    });
            }
        });
    
    
    });
      
    
    
    
            
    
    });
    