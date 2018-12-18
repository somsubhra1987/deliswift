<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\City */

$this->title = 'Create City';
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index','countryCode'=>$model->countryCode,'provinceID'=>$model->provinceID]];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-header">
  <h1> <?php echo Html::encode($this->title) ?> </h1>
</section>

<section class="content">
  	<div class="box box-primary">
	    <div class="city-create box-body">
		    <?php echo $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</section>