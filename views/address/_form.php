<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerAddress */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-3 col-md-3 col-sm-3\">{label}</div><div class=\"col-lg-9 col-md-9 col-sm-9\">{input}{error}</div></div>"
];
?>

<div class="customer-address-form">
	<div class="modal-body"> 
		<?php $form = ActiveForm::begin(); ?>
    
        <?php echo $form->field($model, 'deliveryLocationID')->textInput(['maxlength' => true]) ?>
    
        <?php echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    
        <?php echo $form->field($model, 'deliveryInstruction')->textarea(['rows' => 6]) ?>
    
        <?php echo $form->field($model, 'addressType')->textInput() ?>
    
        <?php ActiveForm::end(); ?>
	</div>
    
    <div id="msg"></div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</button>

        <?php echo Html::button($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success  btn-lg' : 'btn btn-primary  btn-lg', 'onClick' => $model->isNewRecord ? 'recordCreateOrUpdate("'.$addressCreateUrl.'", this)' : 'recordCreateOrUpdate("'.$addressUpdateUrl.'", this)']) ?>
    </div>
</div>
