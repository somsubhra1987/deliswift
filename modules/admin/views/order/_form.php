<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customerID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assignedDeliveryBoyID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orderStatus')->textInput() ?>

    <?= $form->field($model, 'orderDate')->textInput() ?>

    <?= $form->field($model, 'deliveredAt')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'promoCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'totalAmount')->textInput() ?>

    <?= $form->field($model, 'orderDetails')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ratingPoint')->textInput() ?>

    <?= $form->field($model, 'ratingFor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
