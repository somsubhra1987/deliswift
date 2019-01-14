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
		
		if(targetID != 'locationCity' && targetID != 'locationCitySuggestion')
		{
			$('#locationCitySuggestion').addClass('hidden');
		}
		
		if(targetID != 'deliveryLocation' && targetID != 'deliveryLocationSuggestion')
		{
			$('#deliveryLocationSuggestion').addClass('hidden');
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
	
	$("#locationCity").on('click', function(){
		getCitySuggestion();
	});
	
	$("#deliveryLocation").on('keyup', function(){
		clearTimeout(typingTimer);
  		typingTimer = setTimeout(getDeliveryLocationSuggestion, doneTypingInterval);
	});
	
	$("#deliveryLocation").on('keydown', function () {
		clearTimeout(typingTimer);
	});
	
	$("#deliveryLocation").on('click', function(){
		if($("#deliveryLocationSuggestion > ul > li").length() > 0)
		{
			$("#deliveryLocationSuggestion").removeClass('hidden');
		}
	});
	
	$("#orderFoodOnlineBtn").click(function(){
		if($("#deliveryLocationID").val() == 0) {
			$("#deliveryLocation").focus();
			return false;
		}
		else {
			window.location.href = $(this).attr('data-url')+'?deliveryLocation='+$("#deliveryLocationID").val();
		}
	});
	
	$(".order-qty-add").click(function(){
		var obj = $(this);
		var menuItemID = $(this).attr('data-value');
		var quantity = $("#quantity_"+menuItemID).val();
		var restaurantID = $("#restaurantID").val();
		$.ajax({
			type: "POST",
			dataType: "json",
			url: $(this).attr('data-action'),
			data: {menuItemID:menuItemID, qty:quantity, restaurantID:restaurantID},
			success: function (data) {
				if(data.result == 'success')
				{
					$("#cartDiv").html(data.renderDataDiv);
					$(obj).addClass('hidden');
					$(obj).next().removeClass('hidden');
				}
				else
				{
					
				}
			}
		});
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
		beforeSend: function(){
			$("#search-banner-btn").attr('disabled', 'disabled').addClass('disabled').html('<span class="fa fa-refresh fa-spin"></span>');
		},
		success: function(response) {
			var items = [];
			if(Object.keys(response).length > 0)
			{
				$.each( response, function( key, data ) {
					items.push( "<li value='" + data.cityID + "' onclick='setLastSelectedCityID(this);'><a href='javascript:void(0);'>" + data.cityName + "</a></li>" );
				});
			}
			else
			{
				items.push( "<li><h6>No Results</h6><p>Your search returned no results</p></li>" );
			}
			$("#search-banner-btn").html('Search').removeAttr('disabled').removeClass('disabled');
			$("#locationCitySuggestion > ul").html(items.join(""));
			$("#locationCitySuggestion").removeClass('hidden');
		}
	});
}

function setLastSelectedCityID(obj)
{
	var cityID = $(obj).val();
	$.ajax({
		type:"GET",
		url:'site/setlastselectedcity',
		dataType: "json",
		data:{cityID:cityID},
		beforeSend: function(){
			
		},
		success: function(response) {
			
		}
	});
}

function getDeliveryLocationSuggestion()
{
	var searchText = $("#deliveryLocation").val();
	var cityID = $("#deliveryLocation").attr('data-selected-city');
	if(searchText == '')
	{
		$("#deliveryLocationID").val(0);
		$("#deliveryLocationSuggestion > ul").html('');
		$("#deliveryLocationSuggestion").addClass('hidden');
		return false;
	}
	
	$.ajax({
		type:"GET",
		url:$("#deliveryLocation").attr('data-url'),
		dataType: "json",
		data:{searchText:searchText, cityID:cityID},
		beforeSend: function(){
			$("#search-delivery-location-btn").attr('disabled', 'disabled').addClass('disabled').html('<span class="fa fa-refresh fa-spin"></span>');
		},
		success: function(response) {
			var items = [];
			if(Object.keys(response).length > 0)
			{
				$.each( response, function( key, data ) {
					items.push( "<li value='" + data.deliveryLocationID + "'><a href='javascript:void(0);' onclick='setSelectedDeliveryLocationID(this, "+data.deliveryLocationID+");'>" + data.deliveryLocationName + "</a></li>" );
				});
			}
			else
			{
				items.push( "<li><h6>No Results</h6><p>Your search returned no results</p></li>" );
			}
			$("#search-delivery-location-btn").html('Search').removeAttr('disabled').removeClass('disabled');
			$("#deliveryLocationSuggestion > ul").html(items.join(""));
			$("#deliveryLocationSuggestion").removeClass('hidden');
		}
	});
}

function setSelectedDeliveryLocationID(obj, deliveryLocationID)
{
	$("#deliveryLocationID").val(deliveryLocationID);
	$("#deliveryLocation").val($(obj).html());
	$("#deliveryLocationSuggestion").addClass('hidden');
}

function updateCartQty(targetUrl, restaurantID, menuItemID, type)
{
	var quantity = $("#quantity_"+menuItemID).val();
	if(type == 'increase')
	{
		quantity = parseInt(quantity) + 1;
	}
	else
	{
		quantity = parseInt(quantity) - 1;
	}
	$("#quantity_"+menuItemID).val(quantity);
	$.ajax({
		type: "POST",
		dataType: "json",
		url: targetUrl,
		data: {menuItemID:menuItemID, qty:quantity, restaurantID:restaurantID},
		success: function (data) {
			if(data.result == 'success')
			{
				$("#cartDiv").html(data.renderDataDiv);
				if(type == 'decrease' && quantity == 0)
				{
					$("#qty-add-"+menuItemID).removeClass('hidden');
					$("#qty-update-"+menuItemID).addClass('hidden');
					$("#quantity_"+menuItemID).val(1);
				}
			}
			else
			{
				
			}
		}
	});
}

function getModalData(url, modalButtonObject)
{
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function(){
			$(modalButtonObject).append('<div class="fa fa-fw fa-refresh fa-spin modal_loader"></div>');
		},
		success: function(data){
			$('#commonModal').html(data);
			$('#commonModal').modal('show');
			$('#commonModal').on('shown.bs.modal', function (e) {
				$('.modal_loader').remove();
				$(this).find('[autofocus]').focus();
			});
		}
	});
}

function refreshModalConent(url)
{
	$.ajax({
		type: "GET",
		url: url,
		success: function(data){
			$('#commonModal').html(data);
		}
	});
}