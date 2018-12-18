<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppcitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appcity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cityID') ?>

    <?= $form->field($model, 'countryCode') ?>

    <?= $form->field($model, 'provinceID') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'isActive') ?>

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
