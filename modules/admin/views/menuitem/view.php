<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\lib\App;
use app\lib\AppHtml;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuItem */

$this->title = $model->menuItemName;
$this->params['breadcrumbs'][] = ['label' => 'Menu Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12"><h1 class="pull-left mbt-0"> <?php echo Html::encode($model->menuItemName) ?> </h1></div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <p class="pull-right">
    <?php echo Html::a('Update', ['update', 'id' => $model->menuItemID], ['class' => 'btn btn-primary','title'=>'Update']) ?>
    <!-- <?= Html::a('Delete', ['delete', 'id' => $model->menuItemID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure want to delete this menu item ?',
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
            <div class="seller-view">
               <div class="table-responsive"> 
                    <div class="clearfix"></div>  
                    <div class="menu-item-view"> 
                    <?php echo AppHtml::getFlash(); ?> 
                         <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'menuItemID',
                                'menuItemName',
                             //   'courseType',
                                [
                                    'attribute' => 'courseType', 
                                    'value' => App::getCourseTypeName($model->courseType),
                                ],
                                //'isVeg',
                                [
                                    'attribute'=>'isVeg',
                                    'value' =>$model->isVeg?'Yes':'No',
                                ],
                               // 'isActive',                                
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
                </div>            
            </div>            
        </div>        
    </div>
</section>