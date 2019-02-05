<?php

use app\lib\Core;
use app\lib\App;

$this->title = $model->name;

?>
<section class="inner-section1 clear-fix">
    <div class="container">
    
    <div class="row">
    	<div class="col-md-8 col-sm-12 col-xs-12">
        <div class="lftPnl">
        	<div class="pro-dtl-big">
            	<div class="pro-dtl-big-img"><img src="<?php echo Core::getRootUrl().$model->imagePath; ?>" alt="<?php echo $model->name; ?>"></div>
            </div>
            <div class="box01-inner">
            	<div class="menu01 mnu025">
					<!--<div class="rt01">3.5</div>-->
					<h6>ORDER FOOD ONLINE FROM</h6>
					<h1><a href="<?php echo Yii::$app->urlManager->createUrl(['/order/orderonline', 'restaurantID' => $model->restaurantID]); ?>"><?php echo $model->name; ?></a></h1>
					<!--<h6>Kankurgachi  &raquo;  Quick Bites</h6>-->
				</div>
                <hr>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/order/orderonline', 'restaurantID' => $model->restaurantID]); ?>" class="btnOrder">Online Order</a>
            </div>
            
            <div class="box05-inner">
            	<div class="row">
                	<div class="col-md-4 col-sm-4 col-xs-12">
                    	<?php /*?><h3>Phone number</h3>
                        <?php if(!empty($model->contactPhone)){ ?>
                        	<h3><a href="tel: <?php echo $model->contactPhone; ?>"><?php echo $model->contactPhone; ?></a></h3>
                        <?php }if(!empty($model->contactMobile)){ ?>
                        	<h3><a href="tel: <?php echo $model->contactMobile; ?>"><?php echo $model->contactMobile; ?></a></h3>
                        <?php } ?><?php */?>
                        <!--<h4 class="mgtop10">Cuisines</h4>
                        <div><a href="#">Bengali</a>, <a href="#">North Indian</a>, <a href="#">Chinese</a></div>-->
                        <?php if($model->avgCostAmount > 0){ ?>
                            <h4 class="">Average Cost</h4>
                            <p><span class="fa fa-rupee"></span> <?php echo $model->avgCostAmount; ?> for <?php echo App::getInWords($model->avgCostHeadCount); ?> people (approx.) </p>
                            <p>Exclusive of applicable taxes and charges, if any
                            Cash and Wallet accepted</p>
                        <?php } ?>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    	<h4>Opening hours - <span>Open now</span></h4>
                        <p>Today  12noon - 12midnight</p>
                        <h4 class="mgtop10">Address</h4>
                        <p><?php echo $model->contactAddress.', '.App::getDeliveryLocationName($model->deliveryLocationID).', '.App::getCityName($model->cityID); ?></p>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    	<h4>More Info</h4>
                        <ul class="ck-crs">
                        	<li><span><i class="fa fa-check" aria-hidden="true"></i></span> Breakfast</li>
                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> Home Delivery</li>
                            <li><span class="rdcolor"><i class="fa fa-times" aria-hidden="true"></i></span> Seating Not Available</li>
                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span> Catering Available</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="gallery">
            <div class="box05-inner">
            	<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                	<h3>Menu</h3>
                    <div class="clear"></div>
                    
                    	<div class="galleryImg">
                        	<a href="<?php echo Core::getRootUrl().'/web/uploads/restaurant/memu-1.jpg'; ?>" rel="prettyPhoto[gallery1]">
                            <img src="<?php echo Core::getRootUrl().'/web/uploads/restaurant/memu-1.jpg'; ?>" alt="">
                            </a>
                        </div>
                        <div class="galleryImg">
                        	<a href="<?php echo Core::getRootUrl().'/web/uploads/restaurant/memu-2.jpg'; ?>" rel="prettyPhoto[gallery1]">
                            <img src="<?php echo Core::getRootUrl().'/web/uploads/restaurant/memu-2.jpg'; ?>" alt="">
                            </a>
                        </div>
                    
                </div>
                </div>
            </div>
            
            <div class="box05-inner">
            	<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                	<h3>Photos</h3>
                    <div class="clear"></div>
                    
                    	<div class="galleryImg">
                        	<a href="images/img5-b1.jpg" rel="prettyPhoto[gallery2]">
                            <img src="images/img5-b1.jpg" alt="">
                            </a>
                        </div>
                        <div class="galleryImg">
                        	<a href="images/img6-b1.jpg" rel="prettyPhoto[gallery2]">
                            <img src="images/img6-b1.jpg" alt="">
                            </a>
                        </div>
                        <div class="galleryImg">
                        	<a href="images/img7-b1.jpg" rel="prettyPhoto[gallery2]">
                            <img src="images/img7-b1.jpg" alt="">
                            </a>
                        </div>
                        <div class="galleryImg">
                        	<a href="images/img8-b1.jpg" rel="prettyPhoto[gallery2]">
                            <img src="images/img8-b1.jpg" alt="">
                            </a>
                        </div>
                        <div class="galleryImg">
                        	<a href="images/img9-b1.jpg" rel="prettyPhoto[gallery2]">
                            <img src="images/img9-b1.jpg" alt="">
                            </a>
                        </div>
                   
                </div>
                </div>
            </div>
            </div>
            
        </div>
        </div>
        
        <div class="col-md-4 col-sm-12 col-xs-12 mob-hide">
            <div class="ttl-058">Showing a selection of featured listings</div>
            	<div class="row flex-row">
				<?php
                    foreach($featuredRestaurantArr as $featuredRestaurant)
                    {
						if($featuredRestaurant['restaurantID'] != $model->restaurantID)
						{
                ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 marginB20">
                        <div class="related-menu">
                            <div class="related-menu-img">
                                <!--<div class="rt-str">4.2</div>-->
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['/order/viewrestaurant', 'restaurantID' => $featuredRestaurant['restaurantID']]); ?>"><img src="<?php echo Core::getRootUrl().$featuredRestaurant['imagePath']; ?>" alt="<?php echo $featuredRestaurant['name']; ?>"></a>
                            </div>
                            <div class="related-menu-cnt">
                                <h4><a href="<?php echo Yii::$app->urlManager->createUrl(['/order/viewrestaurant', 'restaurantID' => $featuredRestaurant['restaurantID']]); ?>"><?php echo $featuredRestaurant['name']; ?></a></h4>
                                <p><?php echo $featuredRestaurant['contactAddress'].', '.App::getDeliveryLocationName($featuredRestaurant['deliveryLocationID']).', '.App::getCityName($featuredRestaurant['cityID']); ?></p>
                            </div>
                        </div>
                    </div>
				<?php
						}
                    }
                ?>
            	</div>
        	</div>
        
    	</div>
    </div>
</section>