<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\lib\AppHtml;
use app\lib\App;
use yii\widgets\ActiveForm;

$this->title = 'Checkout';

$addressCreateUrl = Yii::$app->urlManager->createUrl(['address/create']);
$customerAddressDetailArr = App::getDefaultAddress($customerDetail->customerID);
?>
<!--inner-section1-->
<?php $form = ActiveForm::begin(); ?>
<section class="inner-section1 clear-fix">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="lftPnl">
                    
                    <div class="box01-inner">
                    	<h1>Select a Payment Method</h1>
                        <div id="payment-option">
                        	<?php
								echo $this->render('/payment/showpaymentoptions', [
									'model' => $paymentMethodModel
								]);
							?>
                        </div>
                        
                        <div style="margin-top:10px;">
                        	<?php echo $form->errorSummary($model); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                
                <div class="delivery-location-pnl dvBx089 mb-hide">
                    <h3>Personal Details</h3>
                    <div class="Restaurants-src loc058">
                        <h5><?php echo $customerDetail->name; ?></h5>
                        <h5><?php echo $customerDetail->phoneNumber; ?></h5>
                    </div>
                    
                    <h3 style="margin-top:20px;">
                    	Delivery Address
                        <div class="pull-right">
                        	<?php echo AppHtml::getAddNewModalButton($addressCreateUrl, 'Add New Address', 'btn btn-xs btn-success'); ?>
                         </div>
                    </h3>
                    <div class="Restaurants-src loc058">
                    	<div id="delivery-address">
                        	<input type="hidden" name="Order[deliveryAddressID]" value="<?php echo ($customerAddressDetailArr['customerAddressID'] > 0) ? $customerAddressDetailArr['customerAddressID'] : ''; ?>" />
                        	<h6><?php echo isset($customerAddressDetailArr['address']) ? $customerAddressDetailArr['address'] : ''; ?></h6>
                        </div>
                    </div>
                </div>
                
                
                <div class="" id="cartDiv">
                    <?php echo $this->render('/order/confirmcart', ['restaurantID' => $restaurantID, 'cartDetailArr' => $cartDetailArr]); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>