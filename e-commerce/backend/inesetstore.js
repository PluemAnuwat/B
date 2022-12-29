// JavaScript Document

$(document).ready(function(){

	$(document).on('submit', '#emp-SaveForm1', function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "insertstore.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			processData:false,
			success: function(data){
				$("#dis").fadeOut();
				$("#dis").fadeIn('slow', function(){
					$("#dis").html('<div class="alert alert-info">Successfully Saved</div>');
					$("#emp-SaveForm1")[0].reset(); 
					window.location.href="index.php";
					
				});
		    },
		  	error: function(){
	    	} 	        
	   });
	});

	
	
	

	
});
