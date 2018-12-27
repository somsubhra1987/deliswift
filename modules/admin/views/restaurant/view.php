<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\lib\App;
use app\lib\AppHtml;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12"><h1 class="pull-left mbt-0"> <?php echo Html::encode($this->title) ?> </h1></div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <p class="pull-right">
    <?php echo Html::a('Update', ['update', 'id' => $model->restaurantID], ['class' => 'btn btn-primary','title'=>'Update']) ?>
    <!-- <?= Html::a('Delete', ['delete', 'id' => $model->restaurantID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure want to delete this restaurant ?',
                            'method' => 'post',
                        ],
                        ]) ?>  -->
                    </p>
    </div>
  </div>
</section>



<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="restaurant-view">
               <div class="table-responsive"> 
                    <div class="clearfix"></div> 
                        <?php echo AppHtml::getFlash(); ?> 
                         <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // 'cityID',
                                // 'title',
                                // [
                                //     'attribute' => 'provinceID', 
                                //     'value' => App::getProvinceName($model->provinceID),
                                // ],
                                // [
                                //     'attribute' => 'countryCode', 
                                //     'value' => App::getCountryName($model->countryCode),
                                // ],                                
                                // [
                                //     'attribute'=>'isActive',
                                //     'value' =>$model->isActive?'Yes':'No',
                                // ],

                                //'restaurantID',
                                'name',
                                'code',
                                'description:ntext',
                                [
                                    'attribute'=>'imagePath',
                                    'value'=>"../../".$model->imagePath,
                                    'format' => ['image',['width'=>'100','height'=>'100']],
                                ],
                                //'imagePath',Yii::$app->basePath
                                'contactName',
                                'contactPhone',
                                'contactMobile',
                                'avgCostAmount',
                                'avgCostHeadCount',
                                'avgCostInfo:ntext',
                                [
                                    'attribute'=>'isCardAccept',
                                    'value' =>$model->isCardAccept?'Yes':'No',
                                ],
                                [
                                    'attribute'=>'isHomeDelivery',
                                    'value' =>$model->isHomeDelivery?'Yes':'No',
                                ],
                                'bestKnownFor',
                                [
                                    'attribute' => 'provinceID', 
                                    'value' => App::getProvinceName($model->provinceID),
                                ],
                                [
                                    'attribute' => 'countryCode', 
                                    'value' => App::getCountryName($model->countryCode),
                                ], 
                                [
                                    'attribute' => 'cityID', 
                                    'value' => App::getCityName($model->cityID),
                                ],  
                                [
                                    'attribute' => 'deliveryLocationID', 
                                    'value' => App::getDeliveryLocationName($model->deliveryLocationID),
                                ], 
                                'contactAddress',
                                [
                                    'attribute'=>'isActive',
                                    'value' =>$model->isActive?'Yes':'No',
                                ],
                                [
                                    'attribute'=>'isClosed',
                                    'value' =>$model->isClosed?'Yes':'No',
                                ],
                                //'isClosed',
                                'createdDatetime',
                                //'createdByUserID',
                                'modifiedDatetime',
                                //'modifiedByUserID',

                            ],
                        ]) ?>
                </div>           
            </div>            
        </div>        
    </div>
</section>