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
				beforeSend: function () {
					$("#register-btn").attr('disabled', 'disabled').val('Please wait...');
				},
				success: function (data) {
					$("#register-btn").removeAttr('disabled').val('Register');
					if(data.result == 'error')
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
		var btnHtml = $(obj).html();
		var menuItemID = $(this).attr('data-value');
		var quantity = $("#quantity_"+menuItemID).val();
		var restaurantID = $("#restaurantID").val();
		$.ajax({
			type: "POST",
			dataType: "json",
			url: $(this).attr('data-action'),
			data: {menuItemID:menuItemID, qty:quantity, restaurantID:restaurantID, showCartInMobile:0},
			beforeSend: function(){
				$(obj).attr('disabled', 'disabled');
				$(obj).html('<span class="fa fa-circle-o-notch fa-spin"></span>');
			},
			success: function (data) {
				if(data.result == 'success')
				{
					$("#cartDiv").html(data.renderDataDiv);
					$(obj).addClass('hidden');
					$(obj).removeAttr('disabled');
					$(obj).html(btnHtml);
					$(obj).next().removeClass('hidden');
				}
				else
				{
					$(obj).removeAttr('disabled');
					$(obj).html(btnHtml);
				}
			}
		});
	});
	
	$("area[rel^='prettyPhoto']").prettyPhoto();
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
	$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
	
	$("#menu-type").change(function(){
		$('html, body').animate({
			scrollTop: $('#menu-container-'+$(this).val()).offset().top - 20
		}, 'slow');
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

function updateCartQty(obj, targetUrl, restaurantID, menuItemID, type, showCartInMobile)
{
	var quantity = $("#quantity_"+menuItemID).val();
	var btnHtml = $(obj).html();
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
		data: {menuItemID:menuItemID, qty:quantity, restaurantID:restaurantID, showCartInMobile:showCartInMobile},
		beforeSend: function(){
			$(obj).attr('disabled', 'disabled');
			$(obj).html('<span class="fa fa-circle-o-notch fa-spin"></span>');
		},
		success: function (data) {
			if(data.result == 'success')
			{
				$("#cartDiv").html(data.renderDataDiv);
				$(obj).removeAttr('disabled');
				$(obj).html(btnHtml);
				if(type == 'decrease' && quantity == 0)
				{
					$("#qty-add-"+menuItemID).removeClass('hidden');
					$("#qty-update-"+menuItemID).addClass('hidden');
					$("#quantity_"+menuItemID).val(1);
				}
			}
			else
			{
				$(obj).removeAttr('disabled');
				$(obj).html(btnHtml);
			}
		}
	});
}

function getModalData(url, modalButtonObject)
{
	var btnHtml = $(modalButtonObject).html();
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function(){
			$(modalButtonObject).html('<span class="fa fa-circle-o-notch fa-spin"></span>');
		},
		success: function(data){
			$('#commonModal').html(data);
			$('#commonModal').modal('show');
			$('#commonModal').on('shown.bs.modal', function (e) {
				$(modalButtonObject).html(btnHtml);
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
			$("#otp-verifyotp").focus();
		}
	});
}

function addOrUpdateAddress(targetUrl, buttonObject)
{
	var formObject = $(buttonObject).parent().parent().find("form")[0];
	var formData = new FormData(formObject);
	
	$.ajax({
		type: "POST",
		url: targetUrl,
		data: formData,
		dataType: "json",
		enctype: "multipart/form-data",
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)
		{
			$(buttonObject).removeClass('disabled');
			$(buttonObject).removeAttr('disabled');
			if(data.result=='success')
			{
				$("#order-deliveryaddressid").val(data.customerAddressID);
				$("#customer-default-address").html(data.address);
				$('#commonModal').modal('hide');
			}
			else
			{
			   $("#msg").html('<div class="error-summary">'+data.msg+'</div>');
			}
		},
		beforeSend:function()
		{
			$("#msg").html('<div class="alert alert-warning">Please wait...</div>');
			$(buttonObject).addClass('disabled');
			$(buttonObject).attr('disabled', 'disabled');
		},
	});	
}