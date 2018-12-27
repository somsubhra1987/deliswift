<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RestaurantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'restaurantID') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'imagePath') ?>

    <?= $form->field($model, 'contactName') ?>

    <?php // echo $form->field($model, 'contactPhone') ?>

    <?php // echo $form->field($model, 'contactMobile') ?>

    <?php // echo $form->field($model, 'avgCostAmount') ?>

    <?php // echo $form->field($model, 'avgCostHeadCount') ?>

    <?php // echo $form->field($model, 'avgCostInfo') ?>

    <?php // echo $form->field($model, 'isCardAccept') ?>

    <?php // echo $form->field($model, 'isHomeDelivery') ?>

    <?php // echo $form->field($model, 'bestKnownFor') ?>

    <?php // echo $form->field($model, 'countryCode') ?>

    <?php // echo $form->field($model, 'provinceID') ?>

    <?php // echo $form->field($model, 'cityID') ?>

    <?php // echo $form->field($model, 'deliveryLocationID') ?>

    <?php // echo $form->field($model, 'contactAddress') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <?php // echo $form->field($model, 'isClosed') ?>

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
