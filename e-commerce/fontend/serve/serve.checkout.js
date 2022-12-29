
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




   

    $("#container").on("click"  ,   "#show_molo_plus1"   , function(){

    console.log("----------------- เพิ่มจำนวน ---------------------");

   var cart_id  = $(this).attr('data-id') ; 

    var quantity = $("#show_quantity1"+cart_id).html();

    console.log(quantity)  ;

    var price = $("#show_price1").html();

    $("#show_quantity1"+cart_id).html(quantity * 1 + 1);

    $("#show_price1").html(price);

   $("#show_price_qty"+cart_id).html((addCommas((quantity * 1 + 1) * price), 2, ',', ' ') ) ; 
 
   
//    console.log(quantity) ; 

    SetUpdatePriceQuantityPricePlusel(cart_id , quantity);


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




                 

                })

            }

        })



}



$("tbody").on("click"  ,   "#show_molo_minus1"   , function(){

    console.log("----------------- ลดจำนวน ---------------------");

    var cart_id  = $(this).attr('data-id') ; 

    var quantity = $("#show_quantity1"+cart_id).html();

    var price = $("#show_price1").html();

    if (quantity > 1) {

        $("#show_quantity1"+cart_id).html(quantity * 1 - 1);

    }else{

        quantity.val(0) ; 

    }


    $("#show_price1").html(price);

    $("#show_price_qty"+cart_id).html(quantity * price ) ; 



   
    // console.log(quantity) ; 
 
    SetUpdatePriceQuantityPriceMinus(cart_id , quantity);

});






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

            url: "serve/SetSelectaddress.php", 

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

            console.log(show_address_id) ; 

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

                url: "serve/deletecart.php",
        
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

// $("#container").on("click"  ,   "#checkout"   , function(){

//     var  cartnumber =  $('#cartnumber').html();

//     console.log(cartnumber) ; 

//     if(displayRad() == "Y"){

//         displayRadioValue();

//     }else{

//         Swal.fire({
//         position: 'center',
//         icon: 'question',
//         title: 'Your work has been saved',
//         showConfirmButton: false,
//         timer: 1500
//         })

//     }


// });



// function displayRadioValue() { 

//     var inputElements = document.getElementsByClassName('showcheckboxmenu');

//     for(var i=0; inputElements[i]; ++i){
        
//         var cart_select_id_value  = (inputElements[i]);

//         if(cart_select_id_value.checked){

//            var cart_select_id = (inputElements[i].value * 1 );

//         //    inset_to_po(cart_select_id) ; 

//             checkout(cart_select_id) ; 

//         }
//     }

// }


// กรณีอยาก insert ไปเลย

// function checkout(cart_select_id){

//     console.log(cart_select_id) ; 

//     // เช็คว่ามีสินค้าในตะกร้าไหม

//     $.ajax({

//         url: "serve/check_product_checkout.php",

//         type: "post",	

//         data: { 

//             cart_select_id : cart_select_id

//                 },

//         dataType: "json",    

//         success: function(data){

//         console.log(data);
        
//             $.each(data, function(key, val) {

//                var  cart_id = val['cart_id'] ; 

//                     window.location.href='checkout.php'  ; 
 
             

//             })

//         }

//     })

// }



// กรณีอยาก รnsert ไปเลย ก่อนเลือกที่อยู่


// function inset_to_po(cart_select_id){
        
//     $.ajax({

//         url: "serve/insert_to_po.php",

//         type: "post",	

//         data: { 

//             cart_select_id : cart_select_id

//                 },

//         dataType: "json",    

//         success: function(data){

//         console.log(data);
        
//             $.each(data, function(key, val) {


//                 window.location.href='checkout.php' ; 

//             })

//         }

//     })

// }


// function displayRad() { 

//     var inputElements = document.getElementsByClassName('showcheckboxmenu');

//     for(var i=0; inputElements[i]; ++i){

//         if(inputElements[i].checked){

//             return 'Y';

//         }else{

//             return 'N';

//         }

//     }
    
// }




