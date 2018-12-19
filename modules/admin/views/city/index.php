<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-header">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <h1 class="pull-left mbt-0"><?php echo Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <?php echo Html::a('Create city', ['create','countryCode'=>$searchModel->countryCode,'provinceID'=>$searchModel->provinceID], ['class' => 'btn btn-success pull-right', 'style' => 'margin-right:10px;']) ?>
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
            <div class="appcity-index">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [                        
                       // 'cityID',
                        AppHtml::getViewLinkCol('title'),
                        //'countryCode',
                        //'provinceID',

                        [
                            'attribute' => 'countryCode',
                            'label' =>'Country',
                            'filter' =>false,
                            'value' => function ($data) {
                                return App::getCountryName($data->countryCode);
                            }
                        ],

                        [
                            'attribute' => 'provinceID',
                            'label' =>'Province',
                            'filter' =>false,
                            'value' => function ($data) {
                                return App::getProvinceName($data->provinceID);
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