<?php

use yii\helpers\Html;
use app\lib\AppHtml;
use app\lib\App;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */


$this->title = 'Update Menu: ' .  App::getRestaurantName($model->restaurantID);
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
		
		<div class="menu-update">
		    <?php echo $this->render('_form', [
		        'model' => $model,
		        'menuUpdateUrl' => $menuUpdateUrl,
		    ]) ?>
		
		</div>
	</div>
</div>