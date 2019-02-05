<?php
use app\lib\Core;
use app\lib\App;

/* @var $this yii\web\View */

$this->title = isset($restaurant['name']) ? $restaurant['name'] : 'Order Online';
?>
<input type="hidden" name="restaurantID" id="restaurantID" value="<?php echo $restaurant['restaurantID']; ?>" />
<!--inner-section1-->
<section class="inner-section1 clear-fix">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="lftPnl">
                    
                    <div class="box01-inner">
                        <div class="menu01">
                            <!--<div class="rt01">3.5</div>-->
                            <div class="promig01"><img src="<?php echo Core::getRootUrl().$restaurant['imagePath']; ?>"></div>
                            <h6>ORDER FOOD ONLINE FROM</h6>
                            <h1><a href="<?php echo Yii::$app->urlManager->createUrl(['/order/viewrestaurant', 'restaurantID' => $restaurant['restaurantID']]); ?>"><?php echo $restaurant['name']; ?></a></h1>
                            <h6><?php echo App::getDeliveryLocationName($restaurant['deliveryLocationID']).', '.App::getCityName($restaurant['cityID']); ?> <?php if($restaurant['avgCostAmount'] > 0){ echo '&sdot; Costs '.$restaurant['avgCostAmount'].' for '.App::getInWords($restaurant['avgCostHeadCount']); } ?></h6>
                        </div>
                        <div class="bd4">
                            <!--<div class="bd4BX">
                                Delivery Time
                                <strong>30 mins</strong>
                            </div>
                            <div class="bd4BX">
                                Minimum Order
                                <strong>$0.00</strong>
                            </div>-->
                            <div class="bd4BX">
                                Payment Methods
                                <strong><?php echo ($restaurant['isCardAccept']) ? 'Cash &amp; Online' : 'Cash'; ?></strong>
                            </div>
                            <div class="bd4BX">
                                Recent Order Rating Streak
                                <ul class=rt-ing>
                                    <li class="G-clr">5</li>
                                    <li class="LG-clr">4</li>
                                    <li class="LG-clr">4</li>
                                    <li class="G-clr">5</li>
                                    <li class="G-clr">5</li>
                                    <li class="G-clr">5</li>
                                    <li class="LG-clr">4</li>
                                    <li class="L-clr">2</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="box02-inner">
                        <div class="row">
                            <div class="col-md-5 col-sm-6 col-xs-12 m-margin15">
                                <div class="list-select2-capt">
                                    <select id="menu-type">
                                        <?php foreach($menuItemTypeWiseDetailArr as $courseTypeID => $menuArr){ ?>
                                            <option value="<?php echo $courseTypeID; ?>"><?php echo App::getCourseTypeName($courseTypeID); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <div class="Restaurants-src">
                                    <div class="icon01"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <input class="txt-fd1" placeholder="Search Menu..." type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $cartItemCount = $cartTotalAmount = 0;
                        foreach($menuItemTypeWiseDetailArr as $courseTypeID => $menuArr)
                        {
                    ?>
                        <div class="box03-inner" id="menu-container-<?php echo $courseTypeID; ?>">
                            <h2><?php echo App::getCourseTypeName($courseTypeID); ?></h2>
                            <ul class="menuList01">
                                <?php
                                    foreach($menuArr as $menu)
                                    {
                                        $isCartStatus = 0;
                                        $qty = 1;
                                        foreach($cartDetailArr as $cartDetail)
                                        {
                                            if($cartDetail['menuItemID'] == $menu['menuItemID'])
                                            {
                                                $cartItemCount++;
                                                $isCartStatus = 1;
                                                $qty = $cartDetail['qty'];
                                                $cartTotalAmount += round(($cartDetail['qty'] * $menu['price']), 2);
                                            }
                                        }
                                ?>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="<?php echo ($menu['isVeg'] == 1) ? 'vgDiv' : 'nonvgDiv'; ?>"></div>
                                            <div class="mnname">
                                                <h4><?php echo $menu['menuItemName']; ?></h4>
                                                <div class="description"><?php echo '<span class="fa fa-rupee"></span> '.number_format($menu['price'], 2); ?></div>
                                            </div>
                                            <div class="add01D order-qty-add <?php if($isCartStatus == 1) { echo 'hidden'; } ?>" data-value="<?php echo $menu['menuItemID']; ?>" data-action="<?php echo Yii::$app->urlManager->createUrl(['order/addtocart']); ?>" id="qty-add-<?php echo $menu['menuItemID']; ?>">Add</div>
                                            
                                            <div class="add01D-2 <?php if($isCartStatus == 0) { echo 'hidden'; } ?>" id="qty-update-<?php echo $menu['menuItemID']; ?>">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus btn btn-success btn-number"  data-type="minus" data-field="" onclick="updateCartQty(this, '<?php echo Yii::$app->urlManager->createUrl(['order/addtocart']); ?>', <?php echo $restaurant['restaurantID']; ?>,<?php echo $menu['menuItemID']; ?>, 'decrease', 0);">
                                                          <span class="glyphicon glyphicon-minus"></span>
                                                        </button>
                                                    </span>
                                                    <input type="text" id="quantity_<?php echo $menu['menuItemID']; ?>" name="quantity_<?php echo $menu['menuItemID']; ?>" class="form-control input-number" value="<?php echo $qty; ?>" min="1" max="100">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" onclick="updateCartQty(this, '<?php echo Yii::$app->urlManager->createUrl(['order/addtocart']); ?>', <?php echo $restaurant['restaurantID']; ?>,<?php echo $menu['menuItemID']; ?>, 'increase', 0);">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                
                <div class="delivery-location-pnl dvBx089 mb-hide">
                    <h3>Delivery Location</h3>
                    <div class="Restaurants-src loc058">
                        <div class="icon01"><i class="fa fa-search" aria-hidden="true"></i></div>
                        <input class="txt-fd1 read-only" placeholder="Search Location..." type="text" value="<?php echo App::getDeliveryLocationName($restaurant['deliveryLocationID']); ?>" readonly="readonly" />
                    </div>
                    <!--<button type="submit" class="foodBtn">Detect Location</button>-->
                    
                </div>
                
                
                <div class="" id="cartDiv">
                    <?php echo $this->render('_viewcart', ['restaurantID' => $restaurant['restaurantID'], 'cartDetailArr' => $cartDetailArr, 'showCartInMobile' => 0]); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--inner-section1-end-->
<?php
$this->registerJs('
	fixCartDiv();
');
?>

<script type="text/javascript">
function fixCartDiv()
{
	$(document).scroll(function(){
		var scrollTop = $(this).scrollTop();
		if(scrollTop > 200)
		{
			$("#cartDiv .delivery-location-pnl").addClass('position-fixed');
		}
		else
		{
			$("#cartDiv .delivery-location-pnl").removeClass('position-fixed');
		}
	});
}
</script>