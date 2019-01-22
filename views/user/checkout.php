<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\lib\App;

$this->title = 'Checkout';

$customerAddressDetailArr = App::getDefaultAddress($customerDetail->customerID);
?>
<!--inner-section1-->
<section class="inner-section1 clear-fix">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="lftPnl">
                    
                    <div class="box03-inner">
                    	<h1>Select a Payment Method</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                
                <div class="delivery-location-pnl dvBx089 mb-hide">
                    <h3>Personal Details</h3>
                    <div class="Restaurants-src loc058">
                        <h6><?php echo $customerDetail->name; ?></h6>
                        <h6><?php echo $customerDetail->phoneNumber; ?></h6>
                    </div>
                    
                    <h3>Delivery Address</h3>
                    <div class="Restaurants-src loc058">
                        <h6><?php echo isset($customerAddressDetailArr['address']) ? $customerAddressDetailArr['address'] : ''; ?></h6>
                    </div>
                </div>
                
                
                <div class="" id="cartDiv">
                    <?php echo $this->render('/order/confirmcart', ['restaurantID' => $restaurantID, 'cartDetailArr' => $cartDetailArr]); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>