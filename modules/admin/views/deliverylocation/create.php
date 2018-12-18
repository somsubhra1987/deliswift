<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Deliverylocation */

$this->title = 'Create Deliverylocation';
$this->params['breadcrumbs'][] = ['label' => 'Deliverylocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverylocation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
