	$(document).ready(function(){
		$('#name').alphanum({
		allowLatin: true, allowUpper: false, allowNueric: true,
		});
	});



	$(document).ready(function(){
	$('#name1').alphanum({
		allow: '@_',allowUpper: true,
		});
	});


		$(document).ready(function(){
	$("#registration_form").validate({
		rules: {
			
			name1: {
				required: true,
				minlength: 2
			}
		},
		messages: {
			name1: {
				required: "Please enter Username.",
				minlength: "Your username must consist of at least 2 characters."
			}
			}
	});
	});