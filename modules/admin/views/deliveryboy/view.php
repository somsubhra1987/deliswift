<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\DeliveryBoy */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Boys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <h1> <?php echo Html::encode($this->title) ?> </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="delivery-boy-view">
                <p>
                    <?php echo Html::a('Update', ['update', 'id' => $model->deliveryBoyID], ['class' => 'btn btn-primary']) ?>
                    <?php echo Html::a('Deactivate', ['delete', 'id' => $model->deliveryBoyID], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to deactivate this delivery boy?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            
                <?php echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'deliveryBoyID',
                        'userID',
                        'name',
                        'emailAddress:email',
                        'phoneNumber',
                        'permanentAddress',
                        'presentAddress',
                        'aadharNo',
                        'isEngaged',
                        'isActive',
                        'todayOrderCount',
                        'profileImagePath',
                        'isOnDuty',
                        'createdDatetime',
                        'createdByUserID',
                        'modifiedDatetime',
                        'modifiedByUserID',
                    ],
                ]) ?>
            
            </div>
		</div>
	</div>
</section>