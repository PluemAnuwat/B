
$(document).ready(function() {

    function addCommas(nStr)
{
    nStr += '';

    x = nStr.split('.');

    x1 = x[0];

    x2 = x.length > 1 ? '.' + x[1] : '';

    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1)) {

        x1 = x1.replace(rgx, '$1' + ',' + '$2');

    }

    return x1 + x2;
}


   var show_cart_id = $("#show_cart_id").html();

   if(show_cart_id == 0){

    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Hi You Not Have Product in cart Pls. Select Product With cart ! ',
        showConfirmButton: false,
        timer: 2000
      })
      window.location.href='index.php' ; 
   }

   

    $("#container").on("click"  ,   "#show_molo_plus1"   , function(){

    console.log("----------------- เพิ่มจำนวน ---------------------");

   var cart_id  = $(this).attr('data-id') ; 

    var quantity = $("#show_quantity1"+cart_id).html();

    var price = $("#show_price1").html();

    $("#show_quantity1"+cart_id).html(quantity * 1 + 1);

    $("#show_price1").html(price);

   $("#show_price_qty"+cart_id).html((addCommas((quantity * 1 + 1) * price), 2, ',', ' ') ) ; 
 

    SetUpdatePriceQuantityPricePlusel(cart_id , quantity);


});




$("#container").on("click"  ,   "#show_molo_minus1"   , function(){

    console.log("----------------- ลดจำนวน ---------------------");

    var cart_id  = $(this).attr('data-id') ; 

    var quantity = $("#show_quantity1"+cart_id).html();

    var price = $("#show_price1").html();

    if (quantity > 1) {

        $("#show_quantity1"+cart_id).html(quantity * 1 - 1);

        $("#show_price1").html(price);

        $("#show_price_qty"+cart_id).html((addCommas((quantity * 1 + 1) * price), 2, ',', ' ') ) ; 

    SetUpdatePriceQuantityPriceMinus(cart_id , quantity);


    }else{

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

                    url: "serve/delete_list_cart.php",
    
                    type: "post",	
    
                    data: { 
    
                            cart_id  : cart_id
    
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

    }



});



function SetUpdatePriceQuantityPricePlusel(cart_id  , quantity ){

    console.log("ทำการเพิ่มจำนวน") ;

    console.log(quantity) ; 

    $.ajax({

        url: "serve/update_show_molo_plus1.php",

        type: "post",	

        data: { 

                cart_id  : cart_id , quantity : quantity

                },

        dataType: "json",    

        success: function(data){

        console.log(data);
        
            $.each(data, function(key, val) {


                $("#show_price_qty"+cart_id).html(addCommas(val['priceqty']), 2, ',', ' ');

                // location.reload();
            
            })

        }

    })



}




function SetUpdatePriceQuantityPriceMinus(cart_id  , quantity ){

    console.log("ทำการลดจำนวน") ;

    console.log(quantity) ; 

    $.ajax({

        url: "serve/update_show_molo_minus1.php",

        type: "post",	

        data: { 

                cart_id  : cart_id , quantity : quantity

                },

        dataType: "json",    

        success: function(data){

        console.log(data);
        
            $.each(data, function(key, val) {


                $("#show_price_qty"+cart_id).html(addCommas(val['priceqty']), 2, ',', ' ');
             

            })

        }

    })



}






    $("#clickshowselectmodaladdress").click(function(){

        $('#select_modal_address').modal('toggle');

    });

    $('input[type=radio][name=radio_address]').change(function(){

        var cusa_id = $(this).attr('id');

        $("#show_address_id").html(cusa_id);

        console.log(cusa_id);

    })

    
    $("#select_address_submit").click(function(){
        
        $('#show_address_select').empty();

        var show_address_id = $("#show_address_id").html() ;

        $.ajax({
        
            type: "POST",

            url: "serve/set_select_address_checkout.php", 

            data: {  show_address_id: show_address_id },

           dataType:'json',

            success: function (data) {

                var htmls = '';

                  console.log(data);

                $.each(data, function (key, val) {
        
                         htmls += '<p class="m-2"><strong>' + val['cusa_name']  + '           '  + val['cusa_surname']  +  '</strong>'   +  '           '       +  '  |  ' + val['cusa_phone'] +
                         '<p class="m-2">' + val['cusa_address']  +  '    ,    ' + val['cusa_province']  + '  , '  + val['cusa_zipcode'] + '</p>' ;

                });

                $('#show_address_select').append(htmls);  

            }

        })

        });


        // ลบสินค้านี้ออกจากตะกร้า


        $("#container").on("click"  ,   ".delete_cart"   , function(){

            var cart_id  = $(this).attr('data-id')

            console.log(cart_id) ; 

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

                        url: "serve/delete_list_cart.php",
        
                        type: "post",	
        
                        data: { 
        
                                cart_id  : cart_id
        
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



        // ตรวจสอบว่าตะกร้ามีค่าไหม
        $("#checkout").click(function(){

            var  cartnumber =  $('#cartnumber').html();

            console.log(cartnumber) ; 

            if(!cartnumber){

                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'error',
                    showConfirmButton: false,
                    timer: 1500
                })

            }else{

                window.location.href='checkout.php' ; 

            }

        });




        $("#insert_to_purchase").click(function(){

            var show_address_id = $("#show_address_id").html() ;

            var show_sto_id = $("#show_sto_id").html() ;

            if(show_address_id == 0 ){

                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Please Select Address !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

            }else{

            $.ajax({

                        url: "serve/insert_to_purchase.php",
                
                        type: "post",	

                        data : {

                            show_address_id : show_address_id  , show_sto_id : show_sto_id

                        } , 
                
                        dataType: "json",    
                
                        success: function(data){
                
                        console.log(data);
                        
                            $.each(data, function(key, val) {

                                var po_id = val['po_id'] ;
                                
                                console.log(po_id) ; 

                                // หลังจากกดสั่งซื้อแล้ว ให้ทำการรีมูฟออก 

                                if(val['status'] == "YES"){

                                    deletecart() ; 
                
                                    Swal.fire({
                                      position: 'center',
                                      icon: 'success',
                                      title: 'Your work has been saved',
                                      showConfirmButton: false,
                                      timer: 1500
                                    })  

                                    window.location.href = ('bank_account.php?po_id=' + po_id);
                                    
                                }

                                   
                             
                
                            })
                
                        }
                
                    })

                }
            

        }) ; 


        function deletecart(){

            console.log("Remove cart") ; 

            $.ajax({

                url: "serve/delete_to_cart.php",
        
                type: "post",	

                data : {   } , 
        
                dataType: "json",    
        
                success: function(data){
        
                console.log(data);
                
                    $.each(data, function(key, val) {


                        if(val['status'] == "YES"){


                            Swal.fire({
                                position: 'center',
                                icon: 'question',
                                title: 'changing information please please wait',
                                showConfirmButton: false,
                                timer: 1500
                              })   


                        }else{

                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'ERRORS!!!',
                                showConfirmButton: false,
                                timer: 1500
                              })  

                        }


                    })

                }

            })

        }



});



