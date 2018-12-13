<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuItem */

$this->title = 'Create Menu Item';
$this->params['breadcrumbs'][] = ['label' => 'Menu Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <h1> <?php echo Html::encode($this->title) ?> </h1>
</section>

<section class="content">
  	<div class="box box-primary">
	    <div class="menu-item-create box-body">
		    <?php echo $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</section>
