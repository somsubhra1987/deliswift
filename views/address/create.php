<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CustomerAddress */

$this->title = 'Add Customer Address';
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" style="clear:none;"><?php echo Html::encode($this->title) ?> </h4>
		</div>
        
        <div class="customer-address-create">
        
            <?php echo $this->render('_form', [
                'model' => $model,
				'addressCreateUrl' => $addressCreateUrl,
            ]) ?>
        
        </div>
	</div>
</div>