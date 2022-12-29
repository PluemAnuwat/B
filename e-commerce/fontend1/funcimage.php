<script type="text/javascript">
    $(document).ready(function() {

    });
    // เมื่อคลิกที่ปุ่มเลือกไฟล์
    $(".btn-upload").on("click", function() {
        //ให้ input file เกิด event click
        $(this).prev("input:file").trigger("click");
        console.log('input:file');
    });


    // ถ้ามีการเปลี่ยนไฟล์ที่อัพโหลด
    $(".file-up").on("change", function() {
        var fileLength = $(this)[0].files.length; // เลือกไฟล์หรือไม่
        if (fileLength != 0) { // ถ้าเลือกไฟล์




        } else { // ถ้าไม่ได้เลือกไฟล์
            // $(this).next(".btn-upload").html("<img class='d-block mx-auto mb-1' src='img/imgcamera.svg' alt='' width='50' height='50'>");
            // $(this).nextAll(".btn-remove-file").hide();

        }
    });








    $('#imagebroswer').on('change', function() {
        resizeImages(this.files[0], function(dataUrl) {


            // console.log(dataUrl);


            $("#logo_img64").val(dataUrl);
            //   inset_img(dataUrl);


            //   var this_length= $("#logo_img64").val().length; // หาจำนวนตัวอักษรที่เหลือ
            //   $("#now_length").html(this_length+" ตัวอักษร"); 

            $(".show_view_img").html('<img   class=" "   src="' + dataUrl +
                '"  style="height: 100%;"   >');



        });
    });

    function resizeImages(file, complete) {
        // read file as dataUrl
        ////////  2. Read the file as a data Url
        var reader = new FileReader();
        // file read
        reader.onload = function(e) {
            // create img to store data url
            ////// 3 - 1 Create image object for canvas to use
            var img = new Image();
            img.onload = function() {
                /////////// 3-2 send image object to function for manipulation
                complete(resizeInCanvas(img));


                // console.log(complete(resizeInCanvas(img)));
            };
            img.src = e.target.result;
        }
        // read file
        reader.readAsDataURL(file);

    }


    function resizeInCanvas(img) {
        /////////  3-3 manipulate image
        var perferedWidth = 450;
        var ratio = perferedWidth / img.width;
        var canvas = $("<canvas>")[0];
        canvas.width = img.width * ratio;
        canvas.height = img.height * ratio;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        //////////4. export as dataUrl
        return canvas.toDataURL();
    }
    </script>
  