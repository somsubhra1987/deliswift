<?php

use yii\helpers\Html;
use app\lib\Core;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RestaurantPhoto */

$this->title = ($model->photoType == 1) ? 'Gallery Photo' : 'Menu Photo';
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
        
        <div class="restaurant-photo-view">
        	<div class="modal-body" align="center">
            	<img src="<?php echo Core::getUploadedUrl().'/restaurant/'.$model->photoName; ?>" alt="<?php echo $model->photoName; ?>" />
            </div>
        </div>
	</div>
</div>