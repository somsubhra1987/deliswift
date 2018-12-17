<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DeliveryBoy */

$this->title = 'Update Delivery Boy: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Boys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->deliveryBoyID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="delivery-boy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
