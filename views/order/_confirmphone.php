<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Personal Details';

$fieldOptions1 = [
  'template' => "<div class=\"fullwd clear-fix\">{label}{input}</div>"
];

$verifyPhoneNumberUrl = Yii::$app->urlManager->createUrl('order/verifyphone');
?>

<div class="modal-dialog modal-sm confirm-phone-modal" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
			
		<div class="confirm-phone">
			<div class="theme-form">
				<div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'confirmPhoneForm', 'options' => ['onSubmit'=> 'return false']]); ?>
                
                <?php echo $form->field($model, 'customerName', $fieldOptions1)->textInput(['maxlength' => true, 'class' => 'form-control locFd02', 'autofocus' => 'autofocus']) ?>
                
                <?php echo $form->field($model, 'phoneNumber', $fieldOptions1)->textInput(['maxlength' => true, 'class' => 'form-control locFd02 only_integer']) ?>
                
                <?php ActiveForm::end(); ?>
                
                <div id="msg"></div>
                </div>
				
				<div class="modal-footer">
				    <?php echo Html::button('Verify Phone', ['class' => 'foodBtn', 'onClick' => 'confirmPersonalDetail("'.$confirmPhoneUrl.'",this, "'.$verifyPhoneNumberUrl.'")']) ?>
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
function confirmPersonalDetail(url, buttonObject, verifyPhoneNumberUrl)
{
	var btnHtml = $(buttonObject).html();
	var formObject = document.getElementById('confirmPhoneForm');
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
			$(buttonObject).removeClass('disabled').removeAttr('disabled').html(btnHtml);
			if(data.result=='success')
			{
				verifyPhoneNumberUrl = verifyPhoneNumberUrl+'?phoneNumber='+data.msg;
				refreshModalConent(verifyPhoneNumberUrl);
			}
			else
			{
			   $("#msg").html('<div class="error-summary">'+data.msg+'</div>');
			}
		},
		beforeSend:function()
		{
			$(buttonObject).addClass('disabled').attr('disabled', 'disabled').html('<span class="fa fa-circle-o-notch fa-spin"></span>');
		},
	});
}
</script>