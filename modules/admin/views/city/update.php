<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appcity */

$this->title = 'Update Appcity: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index','countryCode'=>$model->countryCode,'provinceID'=>$model->provinceID]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->cityID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content-header">
  <h1> <?= Html::encode($this->title) ?> </h1>
</section>

<section class="content">
  	<div class="box box-primary">
	    <div class="box-body">
			<div class="menu-item-update">
			<?php //echo RpHtml::getFlash();?>
			    <?php echo $this->render('_form', [
			        'model' => $model,
			    ]) ?>
			</div>
		</div>
	</div>
</section>
