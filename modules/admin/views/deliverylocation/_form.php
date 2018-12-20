<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Deliverylocation */
/* @var $form yii\widgets\ActiveForm */
$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-3 col-md-3 col-sm-3\">{label}</div><div class=\"col-lg-9 col-md-9 col-sm-9\">{input}{error}</div></div>"
];

?>

<div class="theme-form deliverylocation-form">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">Country</div>
                <div class="col-lg-9 col-md-9 col-sm-9"><?php echo App::getCountryName($model->countryCode); ?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">Province</div>
                <div class="col-lg-9 col-md-9 col-sm-9"><?php echo App::getProvinceName($model->provinceID); ?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">City</div>
                <div class="col-lg-9 col-md-9 col-sm-9"><?php echo App::getCityName($model->cityID); ?></div>
            </div>
        </div>

        <?php $form = ActiveForm::begin(['options' => ['onSubmit'=> 'return false']]); ?>

        <?php echo Html::activeHiddenInput($model,'countryCode',array('value'=>$model->isNewRecord?$model->countryCode:$model->countryCode)); ?>

        <?php echo Html::activeHiddenInput($model,'provinceID',array('value'=>$model->isNewRecord?$model->provinceID:$model->provinceID)); ?>

        <?php echo Html::activeHiddenInput($model,'cityID',array('value'=>$model->isNewRecord?$model->cityID:$model->cityID)); ?>

        <?php echo  $form->field($model, 'title',$fieldOptions1)->textInput(['maxlength' => true, 'spellcheck' => 'true', 'autofocus' => 'autofocus']) ?>

        <?php ActiveForm::end(); ?>

        <div id="msg"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
        <?php echo Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary', 'onClick' =>  $model->isNewRecord ? 'recordCreateOrUpdate("'.$deliverylocationCreateUrl.'",this)' : 'recordCreateOrUpdate("'.$deliverylocationUpdateUrl.'",this)']) ?>
    </div>
</div>