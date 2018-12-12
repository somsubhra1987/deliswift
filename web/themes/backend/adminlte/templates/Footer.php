	<footer class="main-footer">
		Copyright &copy; <strong><?php echo Yii::$app->name ?></strong> <?php echo date('Y') ?>. All rights reserved.
	</footer>

    </div><!-- ./wrapper -->
    
    <!-- Start: Modal -->
	<div id="commonModal" class="modal fade" tabindex="-1" role="dialog"></div>
	<!--End: Modal -->
	
	<script type="text/javascript">
		function getModalData(url, modalButtonObject){
			 $.ajax({
		            type: "GET",
		            url: url,
		            beforeSend: function(){
				        $(modalButtonObject).append('<div class="fa fa-fw fa-spinner fa-spin modal_loader"></div>');
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
						$('#commonModal').on('hidden.bs.modal', function (e) {
						  	
						});
		            }
		      });
		}
		
		function recordCreateOrUpdate(url, buttonObject, statusFlag){
			if(statusFlag == 1)
			{
	        	var formData = new FormData($('form')[0]);
	        }
	        else
	        {
	        	var formObject = $(buttonObject).parent().parent().find("form")[0];
	        	var formData = new FormData(formObject);
	        }
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
	    
	    function deleteAjax(obj, formMethod, message) {
		    var url = $(obj).attr('href');
		    var message = message || false;
		    if(message)
		    	var ans = confirm(message);
		    else
		    	var ans = confirm('Do you really want to delete ?');
		    var parentObj = $(obj).parent();
		    var parentHtml = '';
		    if(ans)
		    {
			    $.ajax({
		            type: formMethod,
		            url: url,
		            dataType: "json",
				  	success: function(data)
				  	{
					   	if(data.result=='success')
					   	{
						   	if(data.divAppend)
						   	{
						   		$('#renderDataDiv'+data.divAppend).html(data.renderDataDiv);
						   		$('#message'+data.divAppend).html('<div class="alert alert-success">'+data.msg+'</div>');

						   		fadeOutMessage('message'+data.divAppend, 5000);
					   		}
					   	}
					    else
					    {
						    $(parentObj).html(parentHtml);
					    	if(data.divAppend)
						   	{
							   	$('#message'+data.divAppend).html('<div class="alert alert-warning">'+data.msg+'</div>');
							   	fadeOutMessage('message'+data.divAppend, 5000);
						   	}
						   	else
						   	{
						    	$("#msg").html('<div class="error-summary">'+data.msg+'</div>');
					    	}
					    }
			        },
			        beforeSend:function()
					{
						parentHtml = $(parentObj).html();
					   	$(parentObj).html('<div class="ajax_loader"></div>');
					},
		        });
	        }
	    }
	</script>

<?php $this->endBody() ?>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/js/jquery-ui-1.11.4.min.js"></script>
<script>

$(".only_integer").keypress(function(event){
	if(event.keyCode != 9 && event.keyCode != 46 && event.which != 8 && (event.which < 48 || event.which > 57))
	{
		return false;
	}
});

$(document).on('click', '.pagination li',function(e){
	if(!$(this).hasClass('disabled'))
	{
		$(this).parent().append('<div class="fa fa-fw fa-spinner fa-spin modal_loader" style="margin-top:10px;"></div>');
	}
});

function fadeOutMessage(containerID, timeInterval)
{
	setTimeout(function(){
		$("#"+containerID+" .alert").fadeOut(300, function(){
			$("#"+containerID).html('&nbsp;');
		});
	}, timeInterval);
}

function roundNumber(number, digits)
{
	var multiple = Math.pow(10, digits);
	var rndedNum = Math.round(number * multiple) / multiple;
	rndedNum = rndedNum.toFixed(digits);
	return rndedNum;
}
</script>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/assets/bootstrap/js/jquery.bootstrap.wizard.js"></script>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/assets/dist/js/app.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>