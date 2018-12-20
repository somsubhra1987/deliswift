<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->restaurantID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->restaurantID], [
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
            'restaurantID',
            'name',
            'description:ntext',
            'imagePath',
            'contactName',
            'contactPhone',
            'contactMobile',
            'avgCostAmount',
            'avgCostHeadCount',
            'avgCostInfo:ntext',
            'isCartAccept',
            'isHomeDelivery',
            'bestKnownFor',
            'countryCode',
            'provinceID',
            'cityID',
            'deliveryLocationID',
            'contactAddress',
            'isActive',
            'isClosed',
            'createdDatetime',
            'createdByUserID',
            'modifiedDatetime',
            'modifiedByUserID',
        ],
    ]) ?>

</div>
