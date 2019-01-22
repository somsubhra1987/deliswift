<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Phone Verification';

$fieldOptions1 = [
  'template' => "<div class=\"fullwd clear-fix\">{label}{input}</div>"
];
?>

<div class="modal-dialog modal-sm verify-phone-modal" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
			
		<div class="confirm-phone">
			<div class="theme-form">
				<div class="modal-body">
                	<div style="margin-bottom:10px;">
                    	We have sent a 4-digit verification code to <?php echo $model->phoneNumber; ?> via SMS. Please enter it below to place your order!
                    </div>
					<?php $form = ActiveForm::begin(['id' => 'verifyPhoneForm', 'options' => ['onSubmit'=> 'return false']]); ?>
                    
                    <?php echo $form->field($model, 'restaurantID', $fieldOptions1)->hiddenInput()->label(false) ?>
                    
                    <?php echo $form->field($model, 'verifyOtp', $fieldOptions1)->textInput(['maxlength' => true, 'class' => 'form-control locFd02 only_integer'])->label(false) ?>
                    
                    <?php ActiveForm::end(); ?>
                    
                    <div id="msg"></div>
                </div>
				
				<div class="modal-footer">
				    <?php echo Html::button('Confirm', ['class' => 'foodBtn', 'id' => 'verifyPhnBtn', 'onClick' => 'verifyPhone("'.$verifyPhoneUrl.'",this)']) ?>
				</div>
            </div>
        </div>
	</div>
</div>

<?php
$this->registerJs('
	$(".only_integer").keypress(function(event){
		if(event.keyCode != 9 && event.keyCode != 46 && event.which != 8 && (event.which < 48 || event.which > 57))
		{
			return false;
		}
	});
');
?>
<script type="text/javascript">
function verifyPhone(url, buttonObject)
{
	$("#otp-restaurantid").val($("#restaurantID").val());
	var formObject = document.getElementById('verifyPhoneForm');
	var formData = new FormData(formObject);
	
	$.ajax({
		type: "POST",
		url: url,
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function(data)
		{
			if(data.result=='success')
			{
				window.location.href = data.redirectUrl;
			}
			else
			{
				$(buttonObject).removeClass('disabled').removeAttr('disabled').html('Continue');
			   	$("#msg").html('<div class="error-summary">'+data.msg+'</div>');
			}
		},
		beforeSend:function()
		{
			$("#msg").html('');
			$(buttonObject).addClass('disabled').attr('disabled', 'disabled').html('<span class="fa fa-refresh fa-spin"></span>');
		},
	});
}
</script>