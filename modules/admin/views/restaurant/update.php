<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restaurant */

$this->title = 'Update Restaurant: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->restaurantID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content-header">
  <h1> <?php echo Html::encode($this->title) ?> </h1>
</section>

<section class="content">
  	<div class="box box-primary">
	    <div class="restaurant-update box-body">
		    <?php echo $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</section>
