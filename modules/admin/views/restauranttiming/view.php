<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restauranttiming */

$this->title = $model->restaurantTimingID;
$this->params['breadcrumbs'][] = ['label' => 'Restauranttimings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restauranttiming-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->restaurantTimingID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->restaurantTimingID], [
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
            'restaurantTimingID',
            'restaurantID',
            'dayID',
            'openingTime',
            'closingTime',
            'isActive',
            'createdDatetime',
            'createdByUserID',
            'modifiedDatetime',
            'modifiedByUserID',
        ],
    ]) ?>

</div>
