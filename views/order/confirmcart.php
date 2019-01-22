<?php
use app\lib\App;

$cartItemCount = $totalOrderQty = 0;
$subTotal = 0;
?>
<div class="delivery-location-pnl dvBx089 mb-hide">
	<?php if(count($cartDetailArr) > 0){ ?>
        <h3>Your Order</h3>
        
        <ul class="sel-menu">
            <?php
                foreach($cartDetailArr as $cartDetail)
                {
					$cartItemCount++;
                    $menuDetail = App::getMenuDetail($restaurantID, $cartDetail['menuItemID']);
                    $amount = round(($cartDetail['qty'] * $menuDetail['price']), 2);
                    $subTotal += $amount;
					$totalOrderQty += $cartDetail['qty'];
            ?>
            <li>
                <div class="<?php echo ($menuDetail['isVeg'] == 1) ? 'vgDiv' : 'nonvgDiv'; ?>"></div>
                <div class="mnname">
                    <h4><?php echo App::getMenuitemName($cartDetail['menuItemID']); ?></h4>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6"><div class="description"><span class="rate"><?php echo $cartDetail['qty'].'&nbsp;&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp;<span class="fa fa-rupee"></span> '.number_format($menuDetail['price'], 2); ?></span></div></div>
                    <div class="col-md-6 col-sm-6 col-xs-6"><div class="description tR-algn"><span class="fa fa-rupee"></span> <span class="price"><?php echo number_format($amount, 2); ?></span></div></div>
                </div>
            </li>
            <?php } ?>
        </ul>
        
        <div class="side-bar-bottom cart-summary">
            <ul class="totals clear">
                <li class="subtotal2 clear" style="border-top: 0px;">
                	<span class="name">Subtotal</span>
                	<span class="price"><span class="fa fa-rupee"></span> <span class="price"><?php echo number_format($subTotal, 2); ?></span></span>
                </li>
            </ul>
            <div class="additional-charges mbot0">
                Delivery Charge
            </div>
            <button class="foodBtn" onclick="getModalData('<?php echo Yii::$app->urlManager->createUrl('order/confirmphone'); ?>', this);">Continue</button>
        </div>
	<?php } ?>
</div>