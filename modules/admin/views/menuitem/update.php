<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuItem */

$this->title = 'Update Menu Item: ' . $model->menuItemID;
$this->params['breadcrumbs'][] = ['label' => 'Menu Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menuItemID, 'url' => ['view', 'id' => $model->menuItemID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
