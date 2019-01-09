<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\lib\App;
use app\lib\AppHtml;
use yii\widgets\ActiveForm;

$this->title = 'View Order Detail';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
	<div class="row" style="padding:5px 0 0 0;">
        <div class="col-md-12"><?php echo AppHtml::getFlash(); ?></div>
    </div>

	<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Delivery Location</h3>
        </div>
        
        <div class="box-body">
        	
        </div>
    </div>
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order Detail</h3>
        </div>
        
        <div class="box-body">
        	
        </div>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'deliveryBoyID')->hiddenInput()->label(false); ?>
    <div class="form-group">
        <?php echo Html::submitButton('Delivered', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</section>