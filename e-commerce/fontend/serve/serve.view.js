$(document).ready(function() {

    console.log("----------------- เริ่มต้นการทำงาน ---------------------");

    // กำหนดห้ามคลิกขวา ห้ามกอปปี้

    $(document).bind("contextmenu", function(e) {

        e.preventDefault();

    });

    $(document).bind("selectstart", function(e) {

        e.preventDefault();

    });

    // กำหนดห้ามคลิกขวา ห้ามกอปปี้


    // คลิกสินค้าดูรายละเอียดของหน้าหลัก


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




    // คลิกเมนู แสดงผลอีกหน้า

    $(".boxcategoryname").on("click", ".categoryname", function() {

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

                $.each(data, function(key, val) {

                    console.log(cat_id)

                    window.location.href = ('product_show_sub_category.php?cat_id=' + cat_id);

                });

            }

        })

    });

    // คลิกเมนู แสดงผลอีกหน้า


    // คลิกหมวดหมู่ย่อย แสดงผลสินค้าออกมา


    $(".boxsubcategoryname").on("click", ".subcategoryname", function() {

        console.log("เริ่มต้นการแสดงสินค้าหลังเลือกหมวดหมู่สินค้าย่อย");

        var scate_id = $(this).attr("data-id");

        Viewproductwithsubcategory(scate_id);

    });

    function Viewproductwithsubcategory(scate_id) {

        console.log("เริมฟังก์ชั่นแสดงสินค้า");

        $.ajax({

            url: "serve/view_show_product.php",

            type: "POST",

            dataType: "json",

            data: {
                scate_id: scate_id
            },

            success: function(data) {

                $htmls = "";

                console.log(data);

                $.each(data, function(key, val) {

                    // ติดปัญหาเรื่อง if ถ้าไม่มี

                    $htmls +=

                        ' <div class="col-sm-4 mb-2">' +

                        '<div class="card">' +

                        '  <div class="card-body">' +

                        '<div id="showproduct" class="showproduct" data-id="' + val['prod_id'] + '">' +

                        '<img src="../backend/getimg/prod/' + val['prod_image'] + '">' +

                        '<h5 class="card-title" style="font-size:18px;">' + val['prod_name'] + '</h5>' +

                        ' <p class="card-text">' + val['prod_detail'] + '</p>' +

                        ' <p style="font-size:10px;" class="text-danger">' + val['prod_price'] + ' บาท</p>' +

                        '</div>' +

                        '</div>' +

                        '</div>' +

                        '</div>';

                })

                $(".productname").html($htmls);

            },

            error: function() {

                alert("เกิดข้อผิดพลาด");

            },

        })

    }

    // คลิกหมวดหมู่ย่อย แสดงผลสินค้าออกมา



    // คลิกสินค้าหลังคลิกหมวดหมู่ย่อย

    $(".productname").on("click", ".showproduct", function() {

        console.log("แสดงรายละเอียดสินค้า");

        var prod_id = $(this).attr("data-id");

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

                    window.location.href = ('product_show_detail.php?prod_id=' + prod_id);

                });

            },

        });

    })



});






// แสดงทั้งหมดก่อน 


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

                    
                    ' <div class="col-sm-4 mb-2">' +

                    '<div class="card">' +

                    '  <div class="card-body">' +

                    '<div id="showproduct" class="showproduct"  data-id="' + val['prod_id'] + '">' +

                    '<img src="../backend/getimg/prod/' + val['prod_image'] + '">' +

                    '<h5 class="card-title" style="font-size:18px;">' + val['prod_name'] + '</h5>' +

                    ' <p class="card-text">' + val['prod_detail'] + '</p>' +

                    ' <p style="font-size:10px;" class="text-danger">' + val['prod_price'] + ' บาท</p>' +

                    '</div>' +

                    '</div>' +

                    '</div>' +

                    '</div>';

            })

            $(".productname").html($htmls);

        },

        error: function() {

            alert("เกิดข้อผิดพลาด");

        },

    })

}

// คลิกสินค้าหลังคลิกหมวดหมู่ย่อย (ในส่วนของแสดงสิ้นค้าทั้งหมด)

$(".boxproductnameall").on("click", ".showproduct_scate_all", function() {

    console.log("-----------------------");

    var prod_id = $(this).attr("data-id");

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

                window.location.href = ('product_show_detail.php?prod_id=' + prod_id);

            });

        },

    });

})