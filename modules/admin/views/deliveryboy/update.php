<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DeliveryBoy */

$this->title = 'Update Delivery Boy: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Boys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->deliveryBoyID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content-header">
  <h1> <?php echo Html::encode($this->title) ?> </h1>
</section>

<section class="content">
  	<div class="box box-primary">
        <div class="delivery-boy-update box-body">
            <?php echo $this->render('_form', [
                'model' => $model,
            ]) ?>
        
        </div>
	</div>
</section>