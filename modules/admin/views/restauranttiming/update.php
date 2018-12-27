<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restauranttiming */

$this->title = 'Update Restauranttiming: ' . $model->restaurantTimingID;
$this->params['breadcrumbs'][] = ['label' => 'Restauranttimings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->restaurantTimingID, 'url' => ['view', 'id' => $model->restaurantTimingID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="restauranttiming-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
