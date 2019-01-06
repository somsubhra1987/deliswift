<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\lib\App;
use app\lib\AppHtml;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->orderID;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$assignToDeliveryBoyUrl =  Yii::$app->urlManager->createUrl(['admin/order/assigntodeliveryboy','id' => $model->orderID]);
?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h1 class="pull-left mbt-0"><?php echo Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
        	<div id="messageOrderView" class="small_alert_message_container"></div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12" align="right">
            <?php echo ($model->orderStatus == 2) ? AppHtml::getAddNewModalButton($assignToDeliveryBoyUrl,'Assign to Delivery Boy') : '' ?>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="order-view">
                
                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'orderID',
                        'customerID',
						'restaurantID',
                        'assignedDeliveryBoyID',
                        [
							'attribute' => 'orderStatus',
							'value' => App::getOrderStatusAssoc()[$model->orderStatus],
						],
                        [
							'attribute' => 'orderDate',
							'value' => App::getFormatedDate($model->orderDate),
						],
                        [
							'attribute' => 'deliveredAt',
							'value' => empty($model->deliveredAt) ? '---' : App::getFormatedDate($model->deliveredAt),
						],
                        [
							'attribute' => 'price',
							'value' => number_format($model->price, 2),
						],
                        'promoCode',
                        [
							'attribute' => 'discount',
							'value' => number_format($model->discount, 2),
						],
                        [
							'attribute' => 'totalAmount',
							'value' => number_format($model->totalAmount, 2),
						],
                        [
							'attribute' => 'ratingPoint',
							'value' => $model->ratingPoint.'/10',
						],
                        'ratingFor',
						[
							'attribute' => 'isCancelled',
							'value' => ($model->isCancelled == 1) ? 'Yes' : 'No',
						],
                    ],
                ]) ?>
            
            </div>
		</div>
	</div>
</section>