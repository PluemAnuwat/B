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
        	url: "customer/profile_update.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
				 $("#dis").html('<div class="alert alert-info">'+data+'</div>');
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