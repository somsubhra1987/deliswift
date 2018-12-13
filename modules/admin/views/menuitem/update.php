<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuItem */

$this->title = 'Update Menu Item: ' . $model->menuItemID;
$this->params['breadcrumbs'][] = ['label' => 'Menu Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->menuItemName, 'url' => ['view', 'id' => $model->menuItemID]];
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
