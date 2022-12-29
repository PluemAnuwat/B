$(document).ready(function () {
  $("#show_molo_plus").click(function () {
    console.log("----------------- เพิ่มจำนวน ---------------------");

    var quantity = $("#show_quantity").html();

    $("#show_quantity").html(quantity * 1 + 1);
  });

  $("#show_molo_minus").click(function () {
    console.log("----------------- ลดจำนวน ---------------------");

    var quantity = $("#show_quantity").html();

    if (quantity > 1) {
      $("#show_quantity").html(quantity * 1 - 1);
    }
  });

  //   เช็คเงื่อนไขว่า ถ้ารับค่ามี สินค้านี้ไม่มีย่อยให้โชว์ บางส่วน

  var show_prod_id = $("#show_prod_id").html(); //รหัสสินค้าย่อย

  var show_sub_prodone_id = $("#show_sub_prodone_id").html(); //รหัสสินค้าย่อย

  $("#boxshowsubproductionselectone").hide();

  $("#boxshowquantity").hide();

  $("#boxshowsubproductionprice").hide();

  $.ajax({
    url: "serve/check_sub_product_have.php",

    type: "POST",

    data: {
      show_prod_id: show_prod_id,
    },

    dataType: "json",

    success: function (data) {
      $.each(data, function (key, val) {
        $htmls = "";

        $htmlss = "";

        //   console.log(data);

        if (val["status"] == "NO") {
          var prod_price = val["price"];

          var prod_quantity = val["qty"];

          $htmls += "  <p> Have product : " + prod_quantity + "</p>";

          $htmlss += '  <p class="h1">' + prod_price + "</p>";

          $("#showsubproductionselectquantity").html($htmls);

          $("#showsubproductionselectprice").html($htmlss);

          ViewshowproductNo();
        } else if (val["status"] == "YES") {
          // ถ้ามีสินค้าย่อยแล้ว ทำการเช็คว่ามีสินค้าย่อย 1 อีกไหม

          var sprod_id = val["sprod_id"];

          $.ajax({
            url: "serve/check_sub_product_have_one.php",

            type: "POST",

            data: {
              sprod_id: sprod_id,
            },

            dataType: "json",

            success: function (data) {
              $.each(data, function (key, val) {
                // ไม่มีสินค้าย่อย 1

                if (val["status"] == "NO1") {
                  ViewshowproductNo1();

                  //มีสินค้าย่อย 1
                } else {
                  ViewshowproductYes();
                }
              });
            },
          });
        }
      });
    },

    error: function () {
      alert("เกิดข้อผิดพลาด");
    },
  });

  function ViewshowproductNo() {

    $("#boxshowsubproductionselect").hide();

    $("#boxshowsubproductionselectone").hide();

    $("#boxshowsubproductionprice").show();

    $("#boxshowquantity").show();
  }

  function ViewshowproductNo1() {

    $("#boxshowsubproductionselect").show();

    $("#boxshowsubproductionselectone").show();

    $("#boxshowquantity").show();
  }

  function ViewshowproductYes() {
    console.log(
      "-------------------------ไม่ซ่อนสินค้าย่อยเนื่องจากมีสินค้าย่อย 1 "
    );

    $("#boxshowsubproductionselect").show();

    $("#boxshowsubproductionselectone").show();

    $("#boxshowquantity").show();

  }

  //   เช็คเงื่อนไขว่า ถ้ารับค่ามี สินค้านี้ไม่มีย่อยให้โชว์ บางส่วน

  var show_sprodone_id = $("#show_sprodone_id").html(); //รหัสสินค้าย่อย

  // ทำการรับค่าที่เลือกของสินค้าย่อยมาโชว์

  $("#boxshowsubproductionid").on("click", "#show_sprod_id", function () {
    console.log("----------------- สินค้าย่อย  ---------------------");

    var sprod_id = $(this).attr("sprod_id");

    $("#show_sub_prod_id").html(sprod_id);

    // ทำการดึงข้อมูลตามที่เลือกออกมา คือ ราคา จำนวน ไอดี

    $.ajax({
      url: "serve/show_detail_sub_product.php",

      type: "POST",

      data: {
        sprod_id: sprod_id,
      },

      dataType: "json",

      success: function (data) {
        $htmls = ""; //สำหรับแสดงจำนวนสินค้า

        $htmlss = ""; //สำหรับแสดงราคาสินค้า

        $htmlsss = ""; //สำหรับแสดงของหมวดหมู่สินค้าย่อย 1

        $.each(data, function (key, val) {
          //   console.log(data);

          // เช็คเงื่อนไข ถ้าสินค้าย่อยนี้ไม่มีสินค้าย่อย 1

          if (val["status"] == "NO 1") {
            var sprod_price = val["sprod_price"];

            var sprod_quantity = val["sprod_quantity"];

            $("#show_price_simple").html(sprod_price);

            $htmls += "  <p> Have product : " + sprod_quantity + "</p>";

            $htmlss += '   <p class="h1">' + sprod_price + "</p>";

            $("#showsubproductionselectquantity").html($htmls);

            $("#showsubproductionselectprice").html($htmlss);

            $("#boxshowsubproductionselectone").hide();

            $("#boxshowquantity").show();

            $("#boxshowsubproductionprice").show();

            // เช็คเงื่อนไข ถ้าสินค้าย่อยนี้มีสินค้าย่อย 1
          } else if (val["status"] == "YES 1") {
            var sprodone_name = val["sprodone_name"];

            var sprodone_id = val["sprodone_id"];

            $htmlsss +=
              '  <li><div id="show_sprodone_id" sprodone_id="' +
              sprodone_id +
              '">' +
              sprodone_name +
              "</div></li>";

            $("#showsubproductionselectquantity").html($htmls);

            $("#showsubproductionselectprice").html($htmlss);

            $("#showsubproductionselectone").html($htmlsss);

            $("#boxshowsubproductionselectone").show();

            $("#boxshowquantity").hide();

            $("#boxshowsubproductionprice").hide();
          }
        });
      },
    });
  });

  // ทำการรับค่าที่เลือกของสินค้าย่อย 1 มาโชว์

  $("#boxshowsubproductionselectone").on(
    "click",
    "#show_sprodone_id",
    function () {
      console.log("----------------- สินค้าย่อย 1 ---------------------");

      var sprodone_id = $(this).attr("sprodone_id");

      $("#show_sub_prodone_id").html(sprodone_id);

      $.ajax({
        url: "serve/show_detail_sub_product_one.php",

        type: "POST",

        data: {
          sprodone_id: sprodone_id,
        },

        dataType: "json",

        success: function (data) {
          $htmls = ""; //สำหรับแสดงจำนวนสินค้า

          $htmlss = ""; //สำหรับแสดงราคาสินค้า

          $htmlsss = ""; //สำหรับแสดงของหมวดหมู่สินค้าย่อย 1

          $.each(data, function (key, val) {
            //   console.log(data);

            var sprodone_price = val["sprodone_price"];

            var sprodone_quantity = val["sprodone_quantity"];

            $("#show_price_simple").html(sprodone_price);

            $htmls += "  <p> Have product : " + sprodone_quantity + "</p>";

            $htmlss += '  <p class="h1">' + sprodone_price + "</p>";

            $("#showsubproductionselectquantity").html($htmls);

            $("#showsubproductionselectprice").html($htmlss);

            $("#boxshowquantity").show();

            $("#boxshowsubproductionprice").show();
          });
        },
      });
    }
  );

  // ทำการรับค่าที่เลือกของสินค้าย่อย 1 มาโชว์

  // กดจะกร้า

  $("#ok_inset_cart").click(function () {
    var prod_id = $("#show_prod_id").html(); //รหัสสินค้า

    var show_sub_prod_id = $("#show_sub_prod_id").html(); //รหัสสินค้าย่อย

    var show_sub_prodone_id = $("#show_sub_prodone_id").html(); //รหัสสินค้าย่อย 1

    var show_quantity = $("#show_quantity").html(); //จำนวนที่รับ

    var show_sto_id = $("#show_sto_id").html(); //รหัสร้านค้า

    $.ajax({

      url: "serve/insert_to_cart.php",

      type: "post",

      data: {
        prod_id: prod_id,
        show_sub_prod_id: show_sub_prod_id,
        show_sub_prodone_id: show_sub_prodone_id,
        show_quantity: show_quantity,
        show_sto_id: show_sto_id,
      },

      dataType: "json",

      success: function (data) {

        console.log(data);

        $.each(data, function (key, val) {
          
          if(val['status'] == "NOLOGIN") {
            
            window.location.href='login.php';

          }else if(val['status'] == "NOS") {

            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Please Select SubProduct',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "NOS1") {

            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Please Select SubProduct1',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "YESUP") {

            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'INSERT TO CART (NOT SUBPRODUCT)',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "NOUP") {

            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'INSERT TO CART ERROR (NOT SUBPRODUCT)',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "YESIN") {

            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'INSERT TO CART (NOT SUBPRODUCT)',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "NOIN") {

            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'INSERT TO CART ERROR (NOT SUBPRODUCT)',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "YESIN1") {

            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'INSERT TO CART (NOT SUBPRODUCT1)',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "NOIN1") {

            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'INSERT TO CART ERROR (NOT SUBPRODUCT1)',
              showConfirmButton: false,
              timer: 1500
            })

          }else if(val['status'] == "YESUP1") {

              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'INSERT TO CART (NOT SUBPRODUCT)',
                showConfirmButton: false,
                timer: 1500
              })
  
            }else if(val['status'] == "NOUP1") {
  
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'INSERT TO CART ERROR (NOT SUBPRODUCT)',
                showConfirmButton: false,
                timer: 1500
              })
  
            }else if(val['status'] == "YESIN2") {

              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'INSERT TO CART (NOT SUBPRODUCT1)',
                showConfirmButton: false,
                timer: 1500
              })
  
            }else if(val['status'] == "NOIN2") {
  
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'INSERT TO CART ERROR (NOT SUBPRODUCT1)',
                showConfirmButton: false,
                timer: 1500
              })
  
            }else if(val['status'] == "YESUP2") {
  
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'INSERT TO CART (NOT SUBPRODUCT1)',
                  showConfirmButton: false,
                  timer: 1500
                })
    
              }else if(val['status'] == "NOUP2") {
    
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'INSERT TO CART ERROR (NOT SUBPRODUCT1)',
                  showConfirmButton: false,
                  timer: 1500
                })
          
              }else if(val['status'] == "NSTO"){

                Swal.fire({
                  title: 'Are you sure?',
                  text: "Your basket contains another store.",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Change it!'
                }).then((result) => {
                  if (result.isConfirmed) {

                    changecart()


                    // Swal.fire(
                    //   'Change!',
                    //   'Your file has been Change.',
                    //   'success'
                    // )


                  }

                })
                
                
              
               

              }

        });

      },

    });

  });



  function changecart(){

    console.log("change") ; 

    var prod_id = $("#show_prod_id").html(); //รหัสสินค้า

    var show_sub_prod_id = $("#show_sub_prod_id").html(); //รหัสสินค้าย่อย

    var show_sub_prodone_id = $("#show_sub_prodone_id").html(); //รหัสสินค้าย่อย 1

    var show_quantity = $("#show_quantity").html(); //จำนวนที่รับ

    var show_sto_id = $("#show_sto_id").html(); //รหัสร้านค้า

    $.ajax({

      url: "serve/changecart.php",

      type: "post",

      data: {
        prod_id: prod_id,
        show_sub_prod_id: show_sub_prod_id,
        show_sub_prodone_id: show_sub_prodone_id,
        show_quantity: show_quantity,
        show_sto_id: show_sto_id,
       } , 
      
      // dataType: "json",

      success: function (data) {

        console.log(data);

        $.each(data, function (key, val) {

          

        })

      }

    })


  }

});
