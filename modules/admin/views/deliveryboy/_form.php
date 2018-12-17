<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DeliveryBoy */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];
?>

<div class="delivery-boy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'name', $fieldOptions1)->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'emailAddress', $fieldOptions1)->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'phoneNumber', $fieldOptions1)->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'permanentAddress', $fieldOptions1)->textArea(['maxlength' => true]) ?>
    
    <?php echo $form->field($model, 'sameAsPermanentAddress', $fieldOptions1)->checkbox(['onclick' => 'copyPermanentAddress(this);']);?>

    <?php echo $form->field($model, 'presentAddress', $fieldOptions1)->textArea(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'aadharNo', $fieldOptions1)->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-lg-10 col-md-10 col-sm-10">
        		<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
function copyPermanentAddress(obj)
{
	if(obj.checked)
	{
		$("#deliveryboy-presentaddress").val($("#deliveryboy-permanentaddress").val()).attr('disabled', 'disabled');
	}
	else
	{
		$("#deliveryboy-presentaddress").removeAttr('disabled');
	}
}
</script>