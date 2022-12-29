$(document).ready(function() {

    console.log("----------------- เริ่มต้นการทำงาน ---------------------");

    $(document).bind("contextmenu", function(e) {

        e.preventDefault();

    });

    $(document).bind("selectstart", function(e) {

        e.preventDefault();

    });


    function Viewproductwithsubcategoryall() {

        var showproductall = $("#showproductall").html();
    
        $.ajax({
    
            url: "serve/view_show_product_all.php",
    
            type: "POST",
    
            dataType: "json",
    
            data: {
                showproductall: showproductall
            },
    
            success: function(data) {
    
                console.log(data);
    
                $htmls = "";
    
                $.each(data, function(key, val) {
    
                    $htmls +=
    
                        
                    '<div class="product-image">'+
                    '<div class="product-active">'+
                    '<div class="product-item active showproduct" id="showproduct" data-id="' + val['prod_id'] + '">'+
                    '<img src="../backend/getimg/prod/' + val['prod_image'] + '"'+
                    '     alt="product"  width="250px;" height="400px;">'+
                    ' </div>'+
                    '</div>'+
                    '<a class="add-wishlist" href="javascript:void(0)">'+
                    '  <i class="mdi mdi-heart-outline"></i>'+
                    '</a>'+
                    ' </div>'+
                    ' <div class="product-content text-center">'+
                    '   <h4 class="title"><a href="product-details-page.html">' + val['prod_name'] + '</a></h4>'+
                    '  <p>' + val['prod_detail'] + '</p>'+
                    '  <a href="javascript:void(0)" class="main-btn secondary-1-btn">'+
                    '    <img src="assets/images/icon-svg/cart-7.svg" alt="">'+
                    '   ' + val['prod_price'] + ''+
                    '  </a>'+
                    ' </div>';

    
                })
    
                $(".productname1").html($htmls);
    
            },
    
            error: function() {
    
                alert("เกิดข้อผิดพลาด");
    
            },
    
        })
    
    }



    
    $("#container").on("click" , "#showproductall" , function(){

        var prod_id = $(this).attr("data-id");

        $("#show_price_simple").html(prod_id);

        $.ajax({

            url: "serve/view_show_detail_product.php",

            type: "POST",

            data: {

                prod_id: prod_id
            },

            dataType: "json",

            success: function(data) {

                $.each(data, function(key, val) {

                    console.log(prod_id)

                    window.location.href = ('product_show_detail.php?prod_id=' + prod_id);

                });

            }

        })

        
    })

 
    $("#boxcategory").on("click" , ".categoryid" , function(){

        var cat_id = $(this).attr("data-id");

        console.log("รับค่า           " + cat_id);

        $.ajax({

            url: "serve/view_show_sub_category.php",

            type: "POST",

            data: {
                cat_id: cat_id
            },

            dataType: "json",

            success: function(data) {

                console.log(cat_id)

                $.each(data, function(key, val) {
                    
                    if(!data){

                    window.location.href = ('category.php?cat_id=' + cat_id);

                    }else{

                    window.location.href = ('category.php?cat_id=' + cat_id);

                    }

                });

            }

        })

    }) ;

    $("#container , #container1").on("click" , "#productid" , function(){

        var prod_id = $(this).attr("data-id");

        console.log(prod_id);

        $.ajax({

            url: "serve/view_show_detail_product.php",

            type: "POST",

            data: {

                prod_id: prod_id
            },

            dataType: "json",

            success: function(data) {

                $.each(data, function(key, val) {

                    console.log(prod_id)

                    window.location.href = ('detail.php?prod_id=' + prod_id);

                });

            }

        });

    });

    $(".boxsubcategory").on("click", ".subcategory", function() {

        var scate_id = $(this).attr("data-id");

        Viewproductwithsubcategory(scate_id);

    });

    function Viewproductwithsubcategory(scate_id) {

        console.log("เริมฟังก์ชั่นแสดงสินค้า");

        $.ajax({

            url: "serve/view_show_product_in_cate.php",

            type: "POST",

            dataType: "json",

            data: {
                scate_id: scate_id
            },

            success: function(data) {

                $htmls = "";

                $htmlss = "" ; 

                console.log(data);

                $.each(data, function(key, val) {

                    $htmls +=

                    '<div class="product-image">'+
                    '<div class="product-active">'+
                    '<div class="product-item active showproduct" id="showproduct" data-id="' + val['prod_id'] + '">'+
                    '<img src="../backend/getimg/prod/' + val['prod_image'] + '"'+
                    'alt="product"  width="250px;" height="350px;">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="product-content">'+
                    ' <h4 class="title"><a href="product-details-page.html">' + val['prod_name'] + '</a></h4>'+
                    '  <p>' + val['prod_detail'] + '</p>'+
                    ' <span class="price">$ ' + val['prod_price'] + '</span>'+
                    '  <a href="javascript:void(0)" class="main-btn primary-btn">'+
                    '       <img src="assets/images/icon-svg/cart-4.svg" alt="">'+
                    '   Add to Cart'+
                    '  </a>'+
                    ' </div>';


                    $htmlss +=
                    '<div class="product-image">'+
                    '<div class="product-active">'+
                    '<div class="product-item active showproduct" id="showproduct" data-id="' + val['prod_id'] + '">'+
                    '<img src="../backend/getimg/prod/' + val['prod_image'] + '"'+
                    '     alt="product"  width="250px;" height="400px;">'+
                    ' </div>'+
                    '</div>'+
                    '<a class="add-wishlist" href="javascript:void(0)">'+
                    '  <i class="mdi mdi-heart-outline"></i>'+
                    '</a>'+
                    ' </div>'+
                    ' <div class="product-content text-center">'+
                    '   <h4 class="title"><a href="product-details-page.html">' + val['prod_name'] + '</a></h4>'+
                    '  <p>' + val['prod_detail'] + '</p>'+
                    '  <a href="javascript:void(0)" class="main-btn secondary-1-btn">'+
                    '    <img src="assets/images/icon-svg/cart-7.svg" alt="">'+
                    '   ' + val['prod_price'] + ''+
                    '  </a>'+
                    ' </div>';

                     

                })

                $(".productname").html($htmls);

                $(".productname1").html($htmlss);

            },

            error: function() {

                alert("เกิดข้อผิดพลาด");

            },

        })

    }


    $(".productname , .productname1").on("click", ".showproduct", function() {

        var prod_id = $(this).attr("data-id");

        console.log(prod_id) ; 

        $.ajax({

            url: "serve/view_show_detail_product.php",

            type: "POST",

            data: {
                prod_id: prod_id
            },

            dataType: "json",

            success: function(data) {

                $.each(data, function(key, val) {

                    var prod_id = val['prod_id'];

                    console.log("แสดงรายละเอียดของสินค้า " + val['prod_name']);

                    window.location.href = ('detail.php?prod_id=' + prod_id);

                });

            },

        });

    })

    


})