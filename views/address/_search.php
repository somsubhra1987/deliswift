<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerAddressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'customerAddressID') ?>

    <?= $form->field($model, 'customerID') ?>

    <?= $form->field($model, 'deliveryLocationID') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'deliveryInstruction') ?>

    <?php // echo $form->field($model, 'addressType') ?>

    <?php // echo $form->field($model, 'otherAddressType') ?>

    <?php // echo $form->field($model, 'isDefault') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
