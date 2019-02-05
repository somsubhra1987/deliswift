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
        	<?php
				$deliveryAddress = $deliveryAddressDetail['customerName'];
				$deliveryAddress .= '<br />'.$deliveryAddressDetail['address'];
				$deliveryAddress .= '<br />'.$deliveryAddressDetail['deliveryLocation'].', '.$deliveryAddressDetail['cityName'];
				$deliveryAddress .= '<br />Phone - '.$deliveryAddressDetail['phoneNumber'];
				
				echo '<h4>'.$deliveryAddress.'</h4>';
			?>
        </div>
    </div>
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order Detail</h3>
        </div>
        
        <div class="box-body">
        	<div class="product-display-container">
				<?php
                    foreach($orderItemDetailArr as $orderItemDetail)
                    {
                ?>
                	<h4><?php echo $orderItemDetail['qty'].' - '.App::getMenuitemName($orderItemDetail['menuItemID']); ?></h4>
				<?php
                    }
                ?>
            </div>
            <h4 class="text-bold">Total Amount:&nbsp;&nbsp;<?php echo '<span class="fa fa-rupee"></span> '.number_format($model->totalAmount, 2); ?></h4>
            <h4 class="text-bold">Payment Status:&nbsp;&nbsp;<?php echo '<span class="text-red">Not Paid</span>'; ?></h4>
        </div>
    </div>
    
    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'deliveryBoyID')->hiddenInput()->label(false); ?>
    <div class="form-group">
        <?php echo ($model->orderStatus == 4) ? Html::submitButton('Delivered', ['class' => 'btn btn-success btn-block']) : ''; ?>
    </div>
    <?php ActiveForm::end(); ?>
</section>