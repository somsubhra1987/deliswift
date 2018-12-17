<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'orderID') ?>

    <?= $form->field($model, 'customerID') ?>

    <?= $form->field($model, 'assignedDeliveryBoyID') ?>

    <?= $form->field($model, 'orderStatus') ?>

    <?= $form->field($model, 'orderDate') ?>

    <?php // echo $form->field($model, 'deliveredAt') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'promoCode') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'totalAmount') ?>

    <?php // echo $form->field($model, 'orderDetails') ?>

    <?php // echo $form->field($model, 'ratingPoint') ?>

    <?php // echo $form->field($model, 'ratingFor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
