<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menuItemName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'courseType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isVeg')->textInput() ?>

    <?= $form->field($model, 'isActive')->textInput() ?>

    <?= $form->field($model, 'createdDatetime')->textInput() ?>

    <?= $form->field($model, 'createdByUserID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modifiedDatetime')->textInput() ?>

    <?= $form->field($model, 'modifiedByUserID')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
