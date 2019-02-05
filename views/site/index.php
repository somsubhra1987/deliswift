<?php

use app\lib\Core;
use app\lib\App;
/* @var $this yii\web\View */

$this->title = 'Home';

if(Yii::$app->session->has('loggedCustomerID'))
{
	$customerDetail = Core::getLoggedCustomer();
	$lastSelectedCityID = $customerDetail->lastSelectedCityID;
}
else
{
	$lastSelectedCityID = App::getLastSelectedCityIDAgainstIP();
	$cityName = App::getCityName($lastSelectedCityID);
}
?>
<!--banner-->
<div class="banner-main clear-fix">
	<div class="blkBg"></div>
    <img src="images/slide-1.jpg" alt="">
</div>
<!--banner-end-->
<!--section-1-->
<section class="section-1 clear-fix">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12 rt-to-ltf">
                <h2>Order Food Online</h2>
                <p>Best restaurants delivering to your doorstep</p>
                
                <div class="delivery-location-pnl">
                    <h3>Enter your delivery location</h3>
                    <div class="positionR-Div">
                        <div class="icon01"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                        <input type="hidden" name="deliveryLocationID" id="deliveryLocationID" value="0" />
                        <input type="text" class="locFd01" name="deliveryLocation" id="deliveryLocation" placeholder="Type delivery location here..." data-selected-city="<?php echo $lastSelectedCityID; ?>" data-url="<?php echo Yii::$app->urlManager->createUrl('site/getdeliverylocationlist'); ?>" />
                        <!--<div class="detectBtn"><button type="submit" class="foodBtn2">Detect</button></div>-->
                        <!---->
                        <div class="src-rglt-D hidden" id="deliveryLocationSuggestion">
                            <ul>
                                
                            </ul>
                        </div>
                        <!---->
                    </div>
                    <button type="button" class="foodBtn" id="orderFoodOnlineBtn"  data-url="<?php echo Yii::$app->urlManager->createUrl('order/orderfoodonline'); ?>">Order Food Online!</button>
                    
                    <!--<h6>Use code FIRST50 to get 50% OFF (up to 150) on your first order. T&amp;Cs apply.</h6>-->
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="app-bnr-023">
                    <div class="ph-img01"><img src="images/app-img02.png"></div>
                    <div class="app-cnt-02">
                        <h2>Get the deliswift App</h2>
                        <p>See menus and photos for nearby restaurants and bookmark your favorite places on the go..</p>
                        <a href="#" class="appBtn02"><img src="images/app-mg3.png" alt=""></a>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</section>
<!--section-1-end-->
<!--section-2-->
<?php if(count($featuredRestaurantArr) > 0){ ?>
    <section class="section-2 clear-fix">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>Featured Restaurants <!--<span><img src="images/category_1.png" alt=""></span>--></h2>
                    <!--<p>Get food delivered</p>-->
                </div>
            </div>
            <div class="row flex-row">
                <?php
                	$featuredRestaurantCount = 0;
					foreach($featuredRestaurantArr as $featuredRestaurant)
					{
						$featuredRestaurantCount++;
				?>
                    <div class="col-md-4 col-sm-4 col-xs-4 marginB20">
                    	<a href="<?php echo Yii::$app->urlManager->createUrl(['/order/viewrestaurant', 'restaurantID' => $featuredRestaurant['restaurantID']]); ?>" class="restaurant-summary">
                        <div class="foodImgBox">
                            <img src="<?php echo Core::getRootUrl().$featuredRestaurant['imagePath']; ?>" alt="<?php echo $featuredRestaurant['name']; ?>">
                            <!--<div class="ret-Div g-5">4.3</div>-->
                        </div>
                        <div class="foodCntBox">
                            <h3><?php echo $featuredRestaurant['name']; ?></h3>
                            <h4><?php echo $featuredRestaurant['contactAddress'].', '.App::getDeliveryLocationName($featuredRestaurant['deliveryLocationID']).', '.App::getCityName($featuredRestaurant['cityID']); ?></h4>
                            <!--<p>Mouthwatering chinese delicacies to try ! Order</p>-->
                        </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php if($featuredRestaurantCount == 10){ ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 centerD">
                    <a href="#" class="viewBtn">View All</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
<!--section-2-end-->
<!--section-3-->
<?php /*?><section class="section-4 clear-fix">
	<div class="container">
    <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="app-box-main">
        	<h2>Get the <?php echo Yii::$app->name; ?> App</h2>
            <!--<p>See menus and photos for nearby restaurants and bookmark your favorite places on the go..</p>-->
            <div class="app-img1"><img src="images/app-img.png" alt=""></div>
            <a href="#" class="appBtn"><img src="images/app-mg2.png" alt=""></a>
        </div>
        </div>
    </div>
    </div>
</section><?php */?>
<!--section-3-end-->