$(document).ready(function(){

	$(document).bind("contextmenu", function (e) {

		e.preventDefault();

	  });
	
	  $(document).bind("selectstart", function (e) {

		e.preventDefault();

	  });

	$(document).on('submit', '#emp-UpdateForm', function(e) {

		e.preventDefault();

		console.log("แก้ไข");
		
		$.ajax({
        	url: "servecustomer/profile_update.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data , key, val){

							if(val['status'] == "YES"){

								Swal.fire({
									position: 'center',
									icon: 'Success',
									title: 'Your work has been saved',
									showConfirmButton: false,
									timer: 1500
									})
							

							}else{

									Swal.fire({
									position: 'center',
									icon: 'error',
									title: 'Your Not work has been saved',
									showConfirmButton: false,
									timer: 1500
									})

							}

							$("#emp-UpdateForm")[0].reset();
								$("body").fadeOut('slow', function()
								{
								$("body").fadeOut('slow');
								window.location.href="profile.php";
					
								});	

				
		    },
		  	error: function(){
	    	} 	        
	   });
	});


});