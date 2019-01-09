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
	
	var typingTimer;
	var doneTypingInterval = 300;
	$("#locationCity").on('keyup', function(){
		clearTimeout(typingTimer);
  		typingTimer = setTimeout(getCitySuggestion, doneTypingInterval);
	});
	
	$("#locationCity").on('keydown', function () {
		clearTimeout(typingTimer);
	});
});

function getCitySuggestion()
{
	var searchText = $("#locationCity").val();
	if(searchText == '')
	{
		$("#locationCitySuggestion > ul").html('');
		$("#locationCitySuggestion").addClass('hidden');
		return false;
	}
	
	$.ajax({
		type:"GET",
		url:$("#locationCity").attr('data-url'),
		dataType: "json",
		data:{searchText:searchText},
		beforeSuccess: function(){
			
		},
		success: function(response) {
			var items = [];
			if(Object.keys(response).length > 0)
			{
				$.each( response, function( key, data ) {
					items.push( "<li value='" + key + "'><a href='#'>" + data + "</a></li>" );
				});
			}
			else
			{
				items.push( "<li><h6>No Results</h6><p>Your search returned no results</p></li>" );
			}
			 
			$("#locationCitySuggestion > ul").html(items.join(""));
			$("#locationCitySuggestion").removeClass('hidden');
		}
	});
}