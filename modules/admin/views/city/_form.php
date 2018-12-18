<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\AppHtml;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\City */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];


?>
<div class="city-form">

     <?php $form = ActiveForm::begin(); ?>
     
    <div class="form-group">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">Country</div>
            <div class="col-lg-10 col-md-10 col-sm-10"><?php echo App::getCountryName($model->countryCode); ?></div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">Province</div>
            <div class="col-lg-10 col-md-10 col-sm-10"><?php echo App::getProvinceName($model->provinceID); ?></div>
        </div>
    </div>

    <?php echo Html::activeHiddenInput($model, 'countryCode', array('value'=>$model->isNewRecord ? $model->countryCode : $model->countryCode)); ?>

    <?php echo Html::activeHiddenInput($model, 'provinceID', array('value'=>$model->isNewRecord ? $model->provinceID : $model->provinceID)); ?>

    <?php echo $form->field($model, 'title',$fieldOptions1)->textInput(['maxlength' => true, 'spellcheck' => 'true']); ?> 

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