<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imagePath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contactName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contactPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contactMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avgCostAmount')->textInput() ?>

    <?= $form->field($model, 'avgCostHeadCount')->textInput() ?>

    <?= $form->field($model, 'avgCostInfo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isCartAccept')->textInput() ?>

    <?= $form->field($model, 'isHomeDelivery')->textInput() ?>

    <?= $form->field($model, 'bestKnownFor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'countryCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provinceID')->textInput() ?>

    <?= $form->field($model, 'cityID')->textInput() ?>

    <?= $form->field($model, 'deliveryLocationID')->textInput() ?>

    <?= $form->field($model, 'contactAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isActive')->textInput() ?>

    <?= $form->field($model, 'isClosed')->textInput() ?>

    <?= $form->field($model, 'createdDatetime')->textInput() ?>

    <?= $form->field($model, 'createdByUserID')->textInput() ?>

    <?= $form->field($model, 'modifiedDatetime')->textInput() ?>

    <?= $form->field($model, 'modifiedByUserID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
