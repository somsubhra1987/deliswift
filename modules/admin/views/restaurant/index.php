<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Restaurants';
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content-header">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <h1 class="pull-left mbt-0"><?php echo Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <?php echo Html::a('Create Restaurant', ['create'], ['class' => 'btn btn-success pull-right', 'style' => 'margin-right:10px;']) ?>
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
            <div class="restaurant-index">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [  
                        AppHtml::getViewLinkCol('name'),
                        //'description:ntext',
                        'imagePath',
                        'contactName',
                        'contactPhone',
                        'contactMobile',
                        'avgCostAmount',
                        'avgCostHeadCount',
                        'avgCostInfo:ntext',
                        //'isCartAccept',
                        [
                            'attribute' => 'isCartAccept',
                            'filter' => array(0 => 'No', 1 => 'Yes'),
                            'value' => function ($data) {
                                return ($data->isCartAccept == 1) ? 'Yes' : 'No';
                            }
                        ],
                        //'isHomeDelivery',
                        [
                            'attribute' => 'isHomeDelivery',
                            'filter' => array(0 => 'No', 1 => 'Yes'),
                            'value' => function ($data) {
                                return ($data->isHomeDelivery == 1) ? 'Yes' : 'No';
                            }
                        ],
                        'bestKnownFor',
            // 'deliveryLocationID',
            // 'contactAddress',
            // 'createdDatetime',
            // 'createdByUserID',
            // 'modifiedDatetime',
            // 'modifiedByUserID',
                        [
                            'attribute' => 'cityID',
                            'label' =>'City',
                            'filter' =>false,
                            'value' => function ($data) {
                                return App::getCityName($data->cityID);
                            }
                        ],
                        [
                            'attribute' => 'deliveryLocationID',
                            'label' =>'Location',
                            'filter' =>false,
                            'value' => function ($data) {
                                return App::getDeliveryLocationName($data->deliveryLocationID);
                            }
                        ],
                        [
                            'attribute' => 'isClosed',
                            'filter' => array(0 => 'No', 1 => 'Yes'),
                            'value' => function ($data) {
                                return ($data->isClosed == 1) ? 'Yes' : 'No';
                            }
                        ],
                        [
                            'attribute' => 'isActive',
                            'filter' => array(0 => 'No', 1 => 'Yes'),
                            'value' => function ($data) {
                                return ($data->isActive == 1) ? 'Yes' : 'No';
                            }
                        ],            
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update}&nbsp;&nbsp;',
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</section>



<!-- 
<div class="restaurant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Restaurant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'restaurantID',
            'name',
            'description:ntext',
            'imagePath',
            'contactName',
            // 'contactPhone',
            // 'contactMobile',
            // 'avgCostAmount',
            // 'avgCostHeadCount',
            // 'avgCostInfo:ntext',
            // 'isCartAccept',
            // 'isHomeDelivery',
            // 'bestKnownFor',
            // 'countryCode',
            // 'provinceID',
            // 'cityID',
            // 'deliveryLocationID',
            // 'contactAddress',
            // 'isActive',
            // 'isClosed',
            // 'createdDatetime',
            // 'createdByUserID',
            // 'modifiedDatetime',
            // 'modifiedByUserID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
 -->