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
  <h1> <?php echo Html::encode($model->menuItemName) ?> </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="seller-view">
               <div class="table-responsive"> 
                    <div class="clearfix"></div>  
                    <div class="menu-item-view"> 
                    <?php echo AppHtml::getFlash(); ?>  
                        <p class="pull-right">
                            <?php echo Html::a('Update', ['update', 'id' => $model->menuItemID], ['class' => 'btn btn-primary','title'=>'Update']) ?>  
                        </p> 
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
                        <p class="pull-right"> 
                        <?= Html::a('Delete', ['delete', 'id' => $model->menuItemID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure want to delete this menu item ?',
                            'method' => 'post',
                        ],
                        ]) ?> 
                    </p>
                    </div>
                </div>            
            </div>            
        </div>        
    </div>
</section>


<!-- <div class="menu-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->menuItemID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->menuItemID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'menuItemID',
            'menuItemName',
            'courseType',
            'isVeg',
            'isActive',
            'createdDatetime',
            'createdByUserID',
            'modifiedDatetime',
            'modifiedByUserID',
        ],
    ]) ?>

</div> -->
