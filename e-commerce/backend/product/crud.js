// JavaScript Document

$(document).ready(function(){


$("#emp-SaveForm1").on("submit", function (event) {
	event.preventDefault(); //prevent default submitting
	var formData = new FormData($(this)[0]);          
	console.log(formData);              
	$.ajax({
		url: "create.php",
		type: "post",
        data: formData,
        processData: false,
        contentType: false, 
        success: function (data) {
          console.log(data);
          let persontt = $.parseJSON(data);

          $.each(persontt, function (key, val) {
					
					if (val["in"] == "YES") {
					  Swal.fire({
						position: "top-end",
						icon: "success",
						title: "Save Data Successfully",
						showConfirmButton: false,
						timer: 2000,
					  });
					  
					  window.location.href="index.php";

					} else if (val["in"] == "NOS") {
					  Swal.fire({
						position: "top-end",
						icon: "warning",
						title: "This Product Already Exists.!!",
						showConfirmButton: false,
						timer: 2000,
						
					  });
					
					}
				  });
				},
				
			  });
			  
			});


	$("#mysfutton").on("click",".delete",function(){

		
		var id = $(this).attr("id");
		var id = id;
		var parent = $(this).parent("td").parent("tr");

		console.log(id);

		Swal.fire({
			title: 'Are You Sure!!',
			text: "To delete ID no  "+ id,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#B59DFA',
            cancelButtonColor: '#E6E6FA',
			confirmButtonText: 'YES',
			cancelButtonText: 'CANCEL'
		  }).then((result) => {

			if (result.isConfirmed) {

			$.post('delete.php', {'id':id}, function(data){


			  Swal.fire(
				'DELETED!',
				'Your file has been deleted.',
				'success'
			  )

			})

			parent.fadeOut('slow');
			location.reload();
			return false;
			
			}

		  })


		
		
	});



		

});
