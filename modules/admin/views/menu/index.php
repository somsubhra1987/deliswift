<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\lib\AppHtml;
use app\lib\App;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$menuCreateUrl =  Yii::$app->urlManager->createUrl(['admin/menu/ajaxcreate','restaurantID' => $restaurantID]);
$menuspecialCreateUrl =  Yii::$app->urlManager->createUrl(['admin/menu/ajaxcreatespecial','restaurantID' => $restaurantID]);
?>
<div id="renderDataDivMenu">
    <section class="content-header">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div id="messageMenu" class=""></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php //echo Html::buttonInput('Clear Filters', ['class' => 'btn btn-info pull-right', 'id' => 'searchResetButton', 'onclick' => "resetSearchFields('menuGridView');"]); ?>
                
                <div class="pull-right" style="margin-right: 10px;">
                    <?php echo AppHtml::getAddNewModalButton($menuspecialCreateUrl,'Create special menu') ?>
                </div>
                <div class="pull-right" style="margin-right: 10px;">
                    <?php echo AppHtml::getAddNewModalButton($menuCreateUrl,'Create menu') ?>
                </div>
            </div>
        </div>            
    </section>
    
    <div class="clearfix"></div>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="menu-index">
                    <?php Pjax::begin(['id' => 'menuPajax', 'enablePushState' => false, 'timeout' => false, 'linkSelector' => 'a:not(.linksWithoutPjax)']) ?> 
                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'id' => 'menuGridView',
                        'columns' => [
                             [
                                'attribute' => 'menuItemID',
                                'format' => 'raw',
                                'filter' => App::getMenuItemAssoc(),
                                'value' => function($model) {
                                    return App::getMenuitemName($model->menuItemID);
                                }
                            ],
                           // 'imagePath',                            
                            [
                                'attribute' => 'imagePath',
                                'format'=>'raw',
                                'filter' => false,
                                'value' => function ($data) {
                                    $imagePath = $data->imagePath?$data->imagePath:'/web/images/no-image.jpg';
                                    return '<img src="../../'.$imagePath.'" width=32 alt="">';
                                }
                            ],
                            'price',
                            [
                                'attribute' => 'isOutofstock',
                                'filter' => array(0 => 'No', 1 => 'Yes'),
                                'value' => function ($data) {
                                    return ($data->isOutofstock == 1) ? 'Yes' : 'No';
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
                                                    'onclick' => 'deleteAjax(this,"GET","Are you sure want to delete this menu?"); return false;',
                                        ]);
                                    }
                                  ],
                                  'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'edit') {
                                        $url = Yii::$app->urlManager->createUrl(['admin/menu/ajaxupdate', 'restaurantID' => $model->restaurantID,'menuID' => $model->menuID]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url = Yii::$app->urlManager->createUrl(['admin/menu/ajaxdelete','menuID' => $model->menuID]);
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
