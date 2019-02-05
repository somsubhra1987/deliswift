<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RestaurantPhoto */

$this->title = 'Add New Photo';
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
        
        <div class="restaurant-photo-create">
            <?php echo $this->render('_form', [
                'model' => $model,
				'photoUploadUrl' => $photoUploadUrl,
            ]) ?>
        
        </div>
	</div>
</div>