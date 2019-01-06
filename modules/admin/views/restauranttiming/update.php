<?php

use yii\helpers\Html;
use app\lib\AppHtml;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restauranttiming */
;
$this->title = 'Update Timing: ' . App::getWeekAssoc()[$model->dayID];;
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
		
		<div class="restauranttiming-update">
		    <?php echo $this->render('_form', [
		        'model' => $model,
		        'restauranttimingUpdateUrl' => $restauranttimingUpdateUrl,
		    ]) ?>
		
		</div>
	</div>
</div>