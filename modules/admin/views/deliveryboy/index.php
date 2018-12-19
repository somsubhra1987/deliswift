<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\DeliveryBoySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Delivery Boys';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h1 class="pull-left mbt-0"><?php echo Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php echo Html::a('Create Delivery Boy', ['create'], ['class' => 'btn btn-success pull-right']) ?>
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
            <div class="delivery-boy-index">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
            
                        AppHtml::getViewLinkCol('userID'),
                        'name',
                        'emailAddress:email',
                        'phoneNumber',
						[
							'attribute' => 'floatingCash',
							'value' => function($data) {
								return number_format($data->floatingCash, 2);
							}
						],
                        [
							'attribute' => 'isActive',
							'filter' => array('1'=>'Yes', '0'=>'No'),
							'value' => function($data) {
								return ($data->isActive == 1) ? 'Yes' : 'No';
							}
						],
						[
							'attribute' => 'isOnDuty',
							'filter' => array('1'=>'Yes', '0'=>'No'),
							'value' => function($data) {
								return ($data->isOnDuty == 1) ? 'Yes' : 'No';
							}
						],
                    ],
                ]); ?>
            </div>
		</div>
	</div>
</section>