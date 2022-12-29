// JavaScript Document

$(document).ready(function () {


    $("#confirm").click(function () {
        
        var show_po_id = $("#show_po_id").html();

        console.log(show_po_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#B59DFA',
            cancelButtonColor: '#E6E6FA',
            confirmButtonText: 'CONFIRM!',
            cancelButtonText: 'CANCEL!',
        }).then((result) => {
           if (result.isConfirmed) {

            





            Swal.fire(
                'CONFIRMED!',
                'Your payment has been confirmed.',
                'success'
              )
            
                var show_po_id = $("#show_po_id").html();

                console.log(show_po_id);
              
                $.ajax({
                    url: "update.php",
                    type: "post",
                    data: { show_po_id: show_po_id },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $.each(data, function (key, vi) {
                            if (vi['in'] == 'YES') {

                                 
                        
                            }

                           
                            
                        })
                          
                    } 
                    
                })



            }window.location.href="index.php"; 
        })

    })

});


    
