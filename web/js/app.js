$(document).ready(function(e){
	$(".loader-div").addClass('hidden');
	
	$('#type-box').click(function() {
    	$('.Restaurants-src-menu').slideDown();
	});
	
	$('body').click(function(e){
		var targetID = e.target.getAttribute('id');
		if(targetID != 'type-box' && targetID != 'restaurants-src-menu')
		{
			$('.Restaurants-src-menu').hide();
		}
	});
	
	$("#sign-up-btn").click(function(){
		$("#login-register-div").addClass('hidden');
		$("#login-div").addClass('hidden');
		$("#registration-div").removeClass('hidden');
		$("#registrationFullName").focus();
	});
	
	$("#login-btn").click(function(){
		$("#login-register-div").addClass('hidden');
		$("#registration-div").addClass('hidden');
		$("#login-div").removeClass('hidden');
		$("#loginFullName").focus();
	});
	
	$("#login-registration-modal").on('hidden.bs.modal', function(){
		$("#registration-div").addClass('hidden');
		$("#login-div").addClass('hidden');
		$("#login-register-div").removeClass('hidden');
	});
	
	$("#registerForm").validate({
		rules: {
			registrationPassword: "required",
			registrationConfirmPassword: {
				equalTo: "#registrationPassword"
			}
		},
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: $(form).attr('action'),
				data: $(form).serialize(),
				success: function (data) {
					if(data.result == 'success')
					{
						
					}
					else
					{
						$("#registrationResponse").html('<div class="error-summary">'+data.msg+'</div>');
					}
				}
			});
			return false;
         }
	});
	
	$("#loginForm").validate({
		submitHandler: function (form) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: $(form).attr('action'),
				data: $(form).serialize(),
				success: function (data) {
					if(data.result == 'success')
					{
						
					}
					else
					{
						$("#loginResponse").html('<div class="error-summary">'+data.msg+'</div>');
					}
				}
			});
			return false;
         }
	});
});