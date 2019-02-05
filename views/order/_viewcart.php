<?php
use app\lib\App;

$cartItemCount = $totalOrderQty = 0;
$subTotal = 0;

if($showCartInMobile == 1)
{
	$this->title = 'View Cart';
}
?>
<input type="hidden" name="restaurantIDCart" id="restaurantIDCart" value="<?php echo $restaurantID; ?>" />
<div class="delivery-location-pnl dvBx089 <?php if($showCartInMobile == 0){ echo 'mb-hide'; } ?>">
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
            <input type="hidden" name="cartID[]" class="form-control input-number" value="<?php echo $cartDetail['cartID']; ?>" />
            <?php
				if($showCartInMobile == 1)
				{
			?>
            <input type="hidden" id="quantity_<?php echo $cartDetail['menuItemID']; ?>" name="quantity_<?php echo $cartDetail['menuItemID']; ?>" class="form-control input-number" value="<?php echo $cartDetail['qty']; ?>" />
            <?php
				}
			?>
            <li>
                <div class="<?php echo ($menuDetail['isVeg'] == 1) ? 'vgDiv' : 'nonvgDiv'; ?>"></div>
                <div class="mnname">
                    <h4><?php echo App::getMenuitemName($cartDetail['menuItemID']); ?></h4>
                </div>
                <div class="add01D-2">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-success btn-number"  data-type="minus" data-field="" onClick="updateCartQty(this, '<?php echo Yii::$app->urlManager->createUrl(['order/addtocart']); ?>', <?php echo $restaurantID; ?>,<?php echo $cartDetail['menuItemID']; ?>, 'decrease', <?php echo $showCartInMobile; ?>);">
                          <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </span>
                    <input type="text" id="cart_quantity_<?php echo $cartDetail['menuItemID']; ?>" name="cart_quantity_<?php echo $cartDetail['menuItemID']; ?>" class="form-control input-number" value="<?php echo $cartDetail['qty']; ?>" min="1" max="100" />
                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" onClick="updateCartQty(this, '<?php echo Yii::$app->urlManager->createUrl(['order/addtocart']); ?>', <?php echo $restaurantID; ?>,<?php echo $cartDetail['menuItemID']; ?>, 'increase', <?php echo $showCartInMobile; ?>);">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </span>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6"><div class="description"><span class="fa fa-rupee"></span> <span class="rate"><?php echo number_format($menuDetail['price'], 2); ?></span></div></div>
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
                plus taxes
            </div>
            <!--<div class="special-instructions">
            <textarea placeholder="Enter any additional information" class="areafd0265" name="orderAdditionalInformation"></textarea></div>-->
            <?php if(Yii::$app->session->has('loggedCustomerID')){ ?>
            	<a href="<?php echo Yii::$app->urlManager->createUrl(['user/checkout', 'restaurantID' => $restaurantID]); ?>"><button class="foodBtn">Continue</button></a>
            <?php }else{ ?>
            	<button class="foodBtn" onClick="getModalData('<?php echo Yii::$app->urlManager->createUrl('order/confirmphone'); ?>', this);">Continue</button>
            <?php } ?>
        </div>
	<?php } ?>
</div>

<div class="mb-crtF <?php if($cartItemCount == 0 || $showCartInMobile == 1){ echo 'hidden'; } ?>">
    <div class="cart">
        <div class="cart__items"><?php echo $totalOrderQty; ?> items in cart</div>
        <div class="cart__subtotal"><span class="fa fa-rupee"></span> <?php echo number_format($subTotal, 2); ?></div>
        <div class="cart__taxes">plus taxes</div>
    </div>
    <a href="<?php echo Yii::$app->urlManager->createUrl(['order/viewcart', 'restaurantID' => $restaurantID]); ?>" class="cvbtn">View Cart <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
</div>