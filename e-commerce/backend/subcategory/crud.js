// JavaScript Document

$(document).ready(function(){



	$("#emp-SaveForm1").on("submit", function (event) {
		event.preventDefault(); //prevent default submitting
		var formData = new FormData($(this)[0]);                        
		$.ajax({
			url: "create.php",
			type: "post",
			data: formData,
			processData: false, //Not to process data
			contentType: false, //Not to set contentType
			success: function (data) {
					let persontt = $.parseJSON(data);
					 
					   
					$.each(persontt, function(key,vi){
						console.log(data);
						if( vi['in'] == 'YES' ){
							
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Successfully Saved',
								showConfirmButton: false,
								timer: 1500
							  })   
							window.location.href="index.php"; 
							
						}
					});
			}
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
