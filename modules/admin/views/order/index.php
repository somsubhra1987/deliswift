<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h1 class="pull-left mbt-0"><?php echo Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            
        </div>
    </div>
</section>

<div class="row" style="padding:5px 15px 0 15px;">
	<div class="col-md-12"><?php echo AppHtml::getFlash(); ?></div>
</div>

<div class="clearfix"></div>
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="order-index">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [

						[
							'attribute' => 'orderDate',
							'value' => function($data) {
								return App::getFormatedDate($data->orderDate);
							}
						],
						AppHtml::getViewLinkCol('orderID'),
                        'customerID',
                        'assignedDeliveryBoyID',
                        [
							'attribute' => 'orderStatus',
							'filter' => App::getOrderStatusAssoc(),
							'value' => function($data) {
								return App::getOrderStatusAssoc()[$data->orderStatus];
							}
						],
                        [
							'attribute' => 'deliveredAt',
							'value' => function($data) {
								return empty($data->deliveredAt) ? '---' : App::getFormatedDate($data->deliveredAt);
							}
						],
                        [
							'attribute' => 'totalAmount',
							'value' => function($data) {
								return number_format($data->totalAmount, 2);
							}
						],
                    ],
                ]); ?>
            </div>
		</div>
	</div>
</section>