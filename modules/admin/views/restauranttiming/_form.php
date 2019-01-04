<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restauranttiming */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];


$fielddropdownOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$daysList = App::getWeekAssoc();
?>


<div class="theme-form deliverylocation-form">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">Restaurant</div>
                <div class="col-lg-9 col-md-9 col-sm-9"><?php echo App::getRestaurantName($model->restaurantID); ?></div>
            </div>
        </div>

        <?php $form = ActiveForm::begin(['options' => ['onSubmit'=> 'return false']]); ?>

        <?php echo Html::activeHiddenInput($model,'restaurantID',array('value'=>$model->isNewRecord?$model->restaurantID:$model->restaurantID)); ?>

        <?php echo $form->field($model, 'dayID',$fielddropdownOptions)->dropDownList($daysList,['prompt'=>'--select--', 'class' => 'form-control', 'style' => 'width:75%;' , 'disabled'=>$model->isNewRecord?false:true]) ?>
    
         <?php echo $form->field($model, 'openingTime',$fieldOptions1)->textInput(['maxlength' => true,'placeholder' => date("H:i:s")]) ?>
         <?php echo $form->field($model, 'closingTime',$fieldOptions1)->textInput(['maxlength' => true,'placeholder' => date("H:i:s")]) ?>

        <?php ActiveForm::end(); ?>

        <div id="msg"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
        <?php echo Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary', 'onClick' =>  $model->isNewRecord ? 'recordCreateOrUpdate("'.$restauranttimingCreateUrl.'",this)' : 'recordCreateOrUpdate("'.$restauranttimingUpdateUrl.'",this)']) ?>
    </div>
</div>