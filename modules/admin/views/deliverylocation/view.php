<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Deliverylocation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Deliverylocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverylocation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->deliveryLocationID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->deliveryLocationID], [
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
            'deliveryLocationID',
            'countryCode',
            'provinceID',
            'cityID',
            'title',
            'isActive',
            'createdDatetime',
            'createdByUserID',
            'modifiedDatetime',
            'modifiedByUserID',
        ],
    ]) ?>

</div>
