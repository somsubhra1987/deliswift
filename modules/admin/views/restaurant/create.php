<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restaurant */

$this->title = 'Create Restaurant';
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <h1> <?php echo Html::encode($this->title) ?> </h1>
</section>

<section class="content">
  	<div class="box box-primary">
	    <div class="restaurant-create box-body">
		    <?php echo $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</section>