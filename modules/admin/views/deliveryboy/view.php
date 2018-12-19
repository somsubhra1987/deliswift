<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DeliveryBoy */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Boys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
	<div class="row">
    	<div class="col-md-9 col-sm-12 col-xs-12">
  			<h1 class="pull-left mbt-0"> <?php echo Html::encode($this->title) ?> </h1>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
        	<p class="pull-right">
				<?php echo Html::a('Update', ['update', 'id' => $model->deliveryBoyID], ['class' => 'btn btn-primary']) ?>
                <?php echo Html::a('Deactivate', ['delete', 'id' => $model->deliveryBoyID], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to deactivate this delivery boy?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="delivery-boy-view">
            
                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'userID',
                        'name',
                        'emailAddress:email',
                        'phoneNumber',
                        'permanentAddress',
                        'presentAddress',
                        'aadharNo',
                        'isEngaged',
                        [
							'attribute' => 'isActive',
							'value' => ($model->isActive == 1) ? 'Yes' : 'No',
						],
						[
							'attribute' => 'isOnDuty',
							'value' => ($model->isOnDuty == 1) ? 'Yes' : 'No',
						],
                        'todayOrderCount',
						[
							'attribute' => 'floatingCash',
							'value' => number_format($model->floatingCash, 2),
						]
                    ],
                ]) ?>
            
            </div>
		</div>
	</div>
</section>