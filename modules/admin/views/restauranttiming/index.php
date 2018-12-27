<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RestauranttimingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$restauranttimingCreateUrl =  Yii::$app->urlManager->createUrl(['admin/restauranttiming/ajaxcreate','restaurantID' => $restaurantID]);
?>
<!-- 
<div class="restauranttiming-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Restauranttiming', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'restaurantTimingID',
            //'restaurantID',
            'dayID',
            'openingTime',
            'closingTime',
             'isActive',
             'createdDatetime',
            // 'createdByUserID',
             'modifiedDatetime',
            // 'modifiedByUserID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div> -->


<div id="renderDataDivRestauranttiming">
    <section class="content-header">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div id="messageRestauranttiming" class=""></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php echo Html::buttonInput('Clear Filters', ['class' => 'btn btn-info pull-right', 'id' => 'searchResetButton', 'onclick' => "resetSearchFields('restauranttimingGridView');"]); ?>
                
                <div class="pull-right" style="margin-right: 10px;">
                    <?php echo AppHtml::getAddNewModalButton($restauranttimingCreateUrl,'Create timing') ?>
                </div>
            </div>
        </div>            
    </section>
    
    <div class="clearfix"></div>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="restauranttiming-index">
                    <?php Pjax::begin(['id' => 'restauranttimingPajax', 'enablePushState' => false, 'timeout' => false, 'linkSelector' => 'a:not(.linksWithoutPjax)']) ?> 
                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'id' => 'restauranttimingGridView',
                        'columns' => [
                             [
                                'attribute' => 'dayID',
                                'format' => 'raw',
                                'filter' => App::getWeekAssoc(),
                                'value' => function($model) {
                                    return App::getWeekAssoc()[$model->dayID];
                                }
                            ],
                            'openingTime',
                            'closingTime',
                            [
                                'attribute' => 'isActive',
                                'filter' => array(0 => 'No', 1 => 'Yes'),
                                'value' => function ($data) {
                                    return ($data->isActive == 1) ? 'Yes' : 'No';
                                }
                            ],
                            'createdDatetime',
                            // 'createdByUserID',
                            'modifiedDatetime',
                            // 'modifiedByUserID',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{edit}&nbsp;&nbsp;&nbsp;',
                                  'buttons' => [
                                    'edit' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', ['onclick' => 'getModalData("'.$url.'")'], [
                                                    'title' => Yii::t('app', 'Edit'),
                                                    'data-method' => 'post',
                                        ]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                    'title' => Yii::t('app', 'Delete'),
                                                    'onclick' => 'deleteAjax(this,"GET","Are you sure want to delete this delivery location?"); return false;',
                                        ]);
                                    }
                                  ],
                                  'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'edit') {
                                        $url = Yii::$app->urlManager->createUrl(['admin/restauranttiming/ajaxupdate', 'restaurantTimingID' => $model->restaurantTimingID]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url = Yii::$app->urlManager->createUrl(['admin/restauranttiming/ajaxdelete','restaurantTimingID' => $model->restaurantTimingID]);
                                        return $url;
                                    }
                                  }
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
    </section>
</div>
