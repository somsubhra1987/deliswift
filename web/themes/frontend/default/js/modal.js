function getModalData(url, modalButtonObject)
{
	 $.ajax({
			type: "GET",
			url: url,
			beforeSend: function(){
				if(modalButtonObject != '')
				{
					$(modalButtonObject).append('<div class="fa fa-fw fa-spinner fa-spin modal_loader"></div>');
				}
			},
			success: function(data){
				$('#commonModal').html(data);
				$('#commonModal').modal('show');
				$('#commonModal').on('shown.bs.modal', function (e) {
					$('.modal_loader').remove();
					if($(this).find('[autofocus]').hasClass('select-auto-open'))
					{
						$(".select-auto-open").select2("open");
					}
					else
					{
						$(this).find('[autofocus]').focus();
					}
				});
			}
	  });
}
		
function recordCreateOrUpdate(url, buttonObject, statusFlag)
{
	var formObject = $(buttonObject).parent().parent().find("form")[0];
	var formData = new FormData(formObject);
	
	$.ajax({
		type: "POST",
		url: url,
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
				if(data.divAppend)
				{
					if(data.renderDataDiv != '')
					{
						$('#renderDataDiv'+data.divAppend).html(data.renderDataDiv);
					}
					$('#message'+data.divAppend).html('<div class="alert alert-success">'+data.msg+'</div>');
				}else {
					window.location.reload();
				}
				$('#commonModal').modal('hide');
				fadeOutMessage('message'+data.divAppend, 5000);
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