<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
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
                         <?php echo DetailView::widget([
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
                                [
                                    'attribute'=>'isFeatured',
                                    'value' =>$model->isFeatured?'Yes':'No',
                                ],
                                //'isClosed',
                                'createdDatetime',
                                //'createdByUserID',
                                'modifiedDatetime',
                                //'modifiedByUserID',

                            ],
                        ]) ?>
                </div>  

                <div class="table-responsive"> 
                	<ul class="nav nav-tabs">
                    	<li class="active">
                        	<a href="#res-timming" data-toggle="tab" aria-expanded="true">Restaurant Timings</a>
                        </li>
                        <li>
                        	<a href="#res-menu" data-toggle="tab" aria-expanded="false">Restaurant Menu</a>
                        </li>
                        <li>
                        	<a href="#res-photo" data-toggle="tab" aria-expanded="false">Photos</a>
                       	</li>
                    </ul>
                    
                    <div class="tab-content">
                    	<div id="res-timming" class="tab-pane active">
                        	<?php
								echo $this->render(
									'/restauranttiming/index', 
									['searchModel'  => $restauranttimingSearchModel, 
									'dataProvider'  => $restauranttimingDataProvider,
									'restaurantID'  => $model->restaurantID
								]);
							?>
                        </div>
                        
                        <div id="res-menu" class="tab-pane">
                        	<?php
								echo $this->render(
									'/menu/index', 
									['searchModel'  => $menuSearchModel, 
									'dataProvider'  => $menuDataProvider,
									'restaurantID'  => $model->restaurantID
								]);
							?>
                        </div>
                        
                        <div id="res-photo" class="tab-pane">
                        	<div id="renderDataDivRestaurantPhoto">
								<?php
                                    echo $this->render(
                                        '/restaurantphoto/index', 
                                        ['searchModel'  => $restaurantPhotoSearchModel, 
                                        'dataProvider'  => $restaurantPhotoDataProvider,
                                        'restaurantID'  => $model->restaurantID
                                    ]);
                                ?>
                        	</div>
                        </div>
                    </div>
                </div>          
            </div>            
        </div>        
    </div>
</section>