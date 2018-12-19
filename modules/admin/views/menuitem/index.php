<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MenuItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h1 class="pull-left mbt-0"><?php echo Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php echo Html::a('Create Menu Item', ['create'], ['class' => 'btn btn-success pull-right', 'style' => 'margin-right:10px;']) ?>
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
            <div class="menu-item-index">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
            
                        AppHtml::getViewLinkCol('menuItemName'),
                        //'courseType',
                        [
                            'attribute' => 'courseType',
                            'filter' => App::getMenuCourseTypeAssoc(),
                            'value' => function ($data) {
                                return App::getCourseTypeName($data->courseType);
                            }
                        ],
                        [
							'attribute' => 'isVeg',
							'filter' => array(0 => 'No', 1 => 'Yes'),
							'value' => function ($data) {
								return ($data->isVeg == 1) ? 'Yes' : 'No';
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