<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Deliverylocation */

$this->title = 'Update Deliverylocation: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Deliverylocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->deliveryLocationID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deliverylocation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
