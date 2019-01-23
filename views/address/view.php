<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerAddress */

$this->title = $model->customerAddressID;
$this->params['breadcrumbs'][] = ['label' => 'Customer Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->customerAddressID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customerAddressID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customerAddressID',
            'customerID',
            'deliveryLocationID',
            'address',
            'deliveryInstruction:ntext',
            'addressType',
            'otherAddressType',
            'isDefault',
        ],
    ]) ?>

</div>
