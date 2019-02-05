<?php
use app\lib\App;

$cartItemCount = $totalOrderQty = 0;
$subTotal = 0;
?>
<div class="delivery-location-pnl dvBx089">
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
            <input type="hidden" name="Order[cartID][]" value="<?php echo $cartDetail['cartID']; ?>" />
            <input type="hidden" name="Order[itemPrice][]" value="<?php echo $menuDetail['price']; ?>" />
            <input type="hidden" name="Order[itemAmount][]" value="<?php echo $amount; ?>" />
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
        
        <?php
			$deliveryCharge = 10;
			$taxAmount = 0;
			$totalAmount = $subTotal + $deliveryCharge + $taxAmount;
		?>
        <input type="hidden" name="Order[price]" value="<?php echo $subTotal; ?>" />
        <input type="hidden" name="Order[discount]" value="0" />
        <input type="hidden" name="Order[deliveryCharge]" value="<?php echo $deliveryCharge; ?>" />
        <input type="hidden" name="Order[taxAmount]" value="<?php echo $taxAmount; ?>" />
        <input type="hidden" name="Order[totalAmount]" value="<?php echo $totalAmount; ?>" />
        <div class="side-bar-bottom cart-summary confirm-cart">
            <ul class="totals clear">
                <li class="subtotal2 clear" style="border-top: 0px;">
                	<span class="name">Subtotal</span>
                	<span class="price"><span class="fa fa-rupee"></span> <span class="price"><?php echo number_format($subTotal, 2); ?></span></span>
                </li>
                <li class="clear" style="border-top: 0px;">
                	<span class="name">Delivery Charge</span>
                	<span class="price"><span class="fa fa-rupee"></span> <span class="price"><?php echo number_format($deliveryCharge, 2); ?></span></span>
                </li>
                <li class="clear" style="border-top: 0px;">
                	<span class="name">Tax</span>
                	<span class="price"><span class="fa fa-rupee"></span> <span class="price"><?php echo number_format($taxAmount, 2); ?></span></span>
                </li>
                <li class="subtotal2 clear" style="border-top: 0px;">
                	<span class="name">Total</span>
                	<span class="price"><span class="fa fa-rupee"></span> <span class="price"><?php echo number_format($totalAmount, 2); ?></span></span>
                </li>
            </ul>
            <button class="foodBtn" type="submit">Place Order</button>
        </div>
	<?php } ?>
</div>