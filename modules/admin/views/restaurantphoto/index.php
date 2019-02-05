<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;
use app\lib\Core;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RestaurantPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Restaurant Photos';
$this->params['breadcrumbs'][] = $this->title;

$photoUploadUrl =  Yii::$app->urlManager->createUrl(['admin/restaurantphoto/create', 'restaurantID' => $restaurantID]);
?>
<section class="content-header">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div id="messageRestaurantPhoto" class=""></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="pull-right">
                <?php echo AppHtml::getAddNewModalButton($photoUploadUrl, 'Add New Photo', 'btn btn-success') ?>
            </div>
        </div>
    </div>            
</section>

<div class="clearfix"></div>
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="restaurant-photo-index">
            	<?php Pjax::begin(['id' => 'restaurantPhotoPajax', 'enablePushState' => false, 'timeout' => false, 'linkSelector' => 'a:not(.linksWithoutPjax)']) ?>
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        [
							'attribute' => 'photoName',
							'filter' => false,
							'format' => 'raw',
							'value' => function($data){
								$viewUrl = Yii::$app->urlManager->createUrl(['admin/restaurantphoto/view', 'restaurantPhotoID' => $data->restaurantPhotoID]);
								return '<a href="javascript:void(0);" onclick="getModalData('."'".$viewUrl."'".')"><img src="'.Core::getUploadedUrl().'/restaurant/'.$data->photoName.'" width="32" height="32" alt="" /></a>';
							},
						],
                        [
							'attribute' => 'photoType',
							'filter' => array(1=>'Gallery', 2=>'Menu'),
							'value' => function($data) {
								return ($data->photoType == 1) ? 'Gallery' : 'Menu';
							}
						],
            			
                        [
							'class' => 'yii\grid\ActionColumn',
							'template' => '{edit}',
							'buttons' => [
								'edit' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0);', ['onclick' => 'getModalData("'.$url.'")'], [
										'title' => Yii::t('app', 'Edit'),
									]);
								}
							],
							'urlCreator' => function ($action, $model, $key, $index) {
								if ($action === 'edit') {
									$url = Yii::$app->urlManager->createUrl(['admin/restaurantphoto/update', 'restaurantID' => $model->restaurantID, 'restaurantPhotoID' => $model->restaurantPhotoID]);
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