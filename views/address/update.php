<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerAddress */

$this->title = 'Update Customer Address: ' . $model->customerAddressID;
$this->params['breadcrumbs'][] = ['label' => 'Customer Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customerAddressID, 'url' => ['view', 'id' => $model->customerAddressID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
