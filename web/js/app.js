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
		$("#login-div").addClass('hidden');
		$("#registration-div").removeClass('hidden');
		$("#")
	});
	
	$("#login-registration-modal").on('hidden.bs.modal', function(){
		$("#registration-div").addClass('hidden');
		$("#login-div").removeClass('hidden');
	});
});