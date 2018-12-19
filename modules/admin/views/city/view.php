<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use app\lib\App;
use app\lib\AppHtml;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\City */

$this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index','countryCode'=>$model->countryCode,'provinceID'=>$model->provinceID]];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-header">
  <div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12"><h1 class="pull-left mbt-0"> <?php echo Html::encode($model->title) ?> </h1></div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <p class="pull-right">
    <?php echo Html::a('Update', ['update', 'id' => $model->cityID], ['class' => 'btn btn-primary','title'=>'Update']) ?>
    <!-- <?= Html::a('Delete', ['delete', 'id' => $model->cityID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure want to delete this city ?',
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
            <div class="city-view">
               <div class="table-responsive"> 
                    <div class="clearfix"></div> 
                        <?php echo AppHtml::getFlash(); ?> 
                         <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'cityID',
                                'title',
                                [
                                    'attribute' => 'provinceID', 
                                    'value' => App::getProvinceName($model->provinceID),
                                ],
                                [
                                    'attribute' => 'countryCode', 
                                    'value' => App::getCountryName($model->countryCode),
                                ],                                
                                [
                                    'attribute'=>'isActive',
                                    'value' =>$model->isActive?'Yes':'No',
                                ],
                                'createdDatetime',
                                //'createdByUserID',
                                'modifiedDatetime',
                                //'modifiedByUserID',
                            ],
                        ]) ?>
                </div> 
                <div class="table-responsive"> 
                    <?php 
                        echo Tabs::widget([
                            'items' => [
                                    [
                                        'label' => 'Delivery Location',
                                        'content' => $this->render(
                                            '/deliverylocation/index', 
                                            ['searchModel'  => $deliverylocationSearchModel, 
                                            'dataProvider'  => $deliverylocationDataProvider, 
                                            'cityID'        => $model->cityID, 
                                            'provinceID'    => $model->provinceID, 
                                            'countryCode'   => $model->countryCode
                                            ]) ,
                                        'active' => true
                                    ],
                                ],
                            ]); 
                    ?>
                </div>           
            </div>            
        </div>        
    </div>
</section>