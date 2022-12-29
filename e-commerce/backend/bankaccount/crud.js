// JavaScript Document

$(document).ready(function () {


    $("#clickshowmodal , #clickshowmodal1").click(function(){

       $("#showmodal").modal("toggle");
       
       var bac_id = $(this).attr("data-id");

       console.log(bac_id) ; 

       $.ajax({

        url: "showdata.php",

        type: "post",

        data: { bac_id : bac_id  },

        dataType : "json" ,

        success: function (data) {

             console.log(data);

            $.each(data, function (key, val) {
                var bac_id = val['bac_id']; 
                var bac_mem_name = val['bac_mem_name']; 
                var bac_number_mem = val['bac_number_mem'];
                var bac_name = val['bac_name'];
                var bak_id = val['bak_id'];
                var bak_name = val['bak_name'];
                console.log(bac_mem_name);
            $("#bac_id").val(bac_id);
            $("#bac_mem_name").val(bac_mem_name);
            $("#bac_number_mem").val(bac_number_mem);
            $("#bac_name").val(bac_name);
            $("#bak_id").val(bak_id);
            $("#bak_name").val(bak_name);
            })

        }

       })

    });


    $("#emp-SaveForm1").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "create.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                let persontt = $.parseJSON(data);


                $.each(persontt, function (key, vi) {
                    console.log(data);
                    if (vi['in'] == 'YES') {
                        
                        alert("Successfully Saved");
                        
                        window.location.href = "index.php";
                    }
                });
            }
        });


    });


    $("#mysfutton").on("click", ".delete", function () {

        if (confirm('Do you want to delete the data?!! ')) {
            var id = $(this).attr('id');
            var parent = $(this).parent("td").parent("tr");
            $.post("delete.php", { id: id }, function (responsett) {
                let persontt = $.parseJSON(responsett);
                console.log(persontt);

                $.each(persontt, function (key, vi) {

                    if (vi['com'] == 'YES') {
                        alert("Successfully Deleted");
                        parent.fadeOut('slow');
                        window.location.href = "index.php";

                    }

                });

            }
            );
        };

        
    });


        


        

       

     

       

    




});
