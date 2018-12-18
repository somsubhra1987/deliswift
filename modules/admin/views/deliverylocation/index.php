<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\DeliverylocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$deliverylocationCreateUrl =  Yii::$app->urlManager->createUrl(['deliverylocation/ajaxcreate','cityID' => $cityID,'provinceID' => $provinceID,'countryCode' => $countryCode]);
?>

<div id="renderDataDivDeliverylocation">
    <section class="content-header">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div id="messageDeliverylocation" class=""></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php echo Html::buttonInput('Clear Filters', ['class' => 'btn btn-info pull-right', 'id' => 'searchResetButton', 'onclick' => "resetSearchFields('deliverylocationGridView');"]); ?>
                
                <div class="pull-right" style="margin-right: 10px;">
                    <?php echo AppHtml::getAddNewModalButton($deliverylocationCreateUrl,'Create delivery location') ?>
                </div>
            </div>
        </div>            
    </section>
    
    <div class="clearfix"></div>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="deliverylocation-index">
                    <?php Pjax::begin(['id' => 'deliverylocationPajax', 'enablePushState' => false, 'timeout' => false, 'linkSelector' => 'a:not(.linksWithoutPjax)']) ?> 
                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'id' => 'deliverylocationGridView',
                        'columns' => [
                           // 'regionName',
                             [
                                'attribute' => 'title',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Html::a($model->title,['/city/', 'countryCode'=>$model->countryCode,'provinceID'=>$model->provinceID], ['class' => 'linksWithoutPjax']);
                                }
                            ],
                           // 'provinceID',
                           /* [
                                'attribute'=>'provinceID',
                                'filter'=>false,
                                'value'=>function($data){
                                    return App::getProvinceName($data->provinceID);
                                }
                            ],
                            [
                                'attribute'=>'countryCode',
                                'filter'=>false,
                                'value'=>function($data){
                                    return App::getCountryName($data->countryCode);
                                }
                            ],*/
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{edit}&nbsp;&nbsp;&nbsp;{delete}',
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
                                        $url = Yii::$app->urlManager->createUrl(['deliverylocation/ajaxupdate', 'countryCode' => $model->countryCode, 'provinceID' => $model->provinceID]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url = Yii::$app->urlManager->createUrl(['deliverylocation/ajaxdelete', 'provinceID' => $model->provinceID]);
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


<!-- 
<div class="deliverylocation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Deliverylocation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'deliveryLocationID',
            'countryCode',
            'provinceID',
            'cityID',
            'title',
            // 'isActive',
            // 'createdDatetime',
            // 'createdByUserID',
            // 'modifiedDatetime',
            // 'modifiedByUserID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div> -->
