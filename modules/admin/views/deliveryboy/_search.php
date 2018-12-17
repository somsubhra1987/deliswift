<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DeliveryBoySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-boy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'deliveryBoyID') ?>

    <?= $form->field($model, 'userID') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'emailAddress') ?>

    <?= $form->field($model, 'phoneNumber') ?>

    <?php // echo $form->field($model, 'permanentAddress') ?>

    <?php // echo $form->field($model, 'presentAddress') ?>

    <?php // echo $form->field($model, 'aadharNo') ?>

    <?php // echo $form->field($model, 'isEngaged') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <?php // echo $form->field($model, 'todayOrderCount') ?>

    <?php // echo $form->field($model, 'profileImagePath') ?>

    <?php // echo $form->field($model, 'isOnDuty') ?>

    <?php // echo $form->field($model, 'createdDatetime') ?>

    <?php // echo $form->field($model, 'createdByUserID') ?>

    <?php // echo $form->field($model, 'modifiedDatetime') ?>

    <?php // echo $form->field($model, 'modifiedByUserID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
