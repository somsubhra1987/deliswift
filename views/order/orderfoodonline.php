<?php
use app\lib\Core;
use app\lib\App;

/* @var $this yii\web\View */

$this->title = 'Order food online';

?>
<!--inner-section1-->
<section class="inner-section1 clear-fix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1><?php echo 'Order food online in '.$deliveryLocationDetailArr['name']; ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12 mov-hdn-767">
            <div class="box01-lft02 clear-fix">
                <h3>Sort by</h3>
                <ul class="lst-stl98">
                    <li><a href="#">Popularity - <label>high to low</label></a></li>
                    <li><a href="#">Delivery Rating - <label>high to low</label></a></li>
                    <li><a href="#">Rating - <label>high to low</label></a></li>
                    <li class="active"><a href="#">Recently Added - <label>new to old</label></a></li>
                </ul>
                <h3>Cuisine</h3>
                <ul class="lst-stl98">
                    <li><a href="#">Chinese <span>19</span></a></li>
                    <li><a href="#">North Indian <span>5</span></a></li>
                    <li><a href="#">Fast Food <span>4</span></a></li>
                    <li><a href="#">Mughlai <span>13</span></a></li>
                    <li><a href="#">Rolls <span>2</span></a></li>
                    <li><a href="#">Biryani <span>5</span></a></li>
                    <li><a href="#">South Indian <span>16</span></a></li>
                    <li><a href="#">Pizza <span>5</span></a></li>
                    <li><a href="#">Desserts <span>8</span></a></li>
                </ul>
                <h3>Delivery Time</h3>
                <ul class="lst-stl98">
                    <li><a href="#">Up to 30 minutes <span>5</span></a></li>
                    <li><a href="#">Up to 45 minutes <span>18</span></a></li>
                    <li><a href="#">Up to 60 minutes <span>30</span></a></li>
                </ul>
                <h3>Cost for two</h3>
                <ul class="lst-stl98">
                    <li><a href="#">Less than &pound;250 <span>3</span></a></li>
                    <li><a href="#">&pound;250 to &pound;500 <span>19</span></a></li>
                    <li><a href="#">&pound;1,000 to &pound;1,500 <span>0</span></a></li>
                    <li><a href="#">&pound;2,500 + <span>0</span></a></li>
                </ul>
                <h3>Minimum Order</h3>
                <ul class="lst-stl98">
                    <li><a href="#">No minimum order <span>8</span></a></li>
                    <li><a href="#">Up to &pound;150 <span>30</span></a></li>
                    <li><a href="#">Up to &pound;250 <span>30</span></a></li>
                    <li><a href="#">Up to &pound;500 <span>30</span></a></li>
                </ul>
            </div>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-12">
            
                <div class="box01-lft02">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <h5 class="tl02">Searching in...</h5>
                            <div class="loc-sec">
                                <div class="icon01"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                                <input class="txt-fd1 read-only" placeholder="Location" type="text" readonly="readonly" value="<?php echo $deliveryLocationDetailArr['name']; ?>" />
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <h5 class="tl02">Searching for...</h5>
                            <div class="Restaurants-src">
                                <div class="icon01"><i class="fa fa-search" aria-hidden="true"></i></div>
                                <input class="txt-fd1" placeholder="Search Menu..." type="text">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box01-lft04">
                    <div class="row">
                    	<?php foreach($restaurantArr as $restaurant){ ?>
                            <div class="col-md-6 col-sm-12 col-xs-12 marginB20">
                                <div class="menu-bx04">
                                    <div class="menu-bx04-img">
                                        <a href="<?php echo Yii::$app->urlManager->createUrl(['/order/viewrestaurant', 'restaurantID' => $restaurant['restaurantID']]); ?>"><img src="<?php echo Core::getRootUrl().$restaurant['imagePath']; ?>" alt="<?php echo $restaurant['name']; ?>"></a>
                                    </div>
                                    <div class="menu-bx04-cnt">
                                        <!--<div class="ps-ab-rt">
                                            <div class="rt02">3.5</div>
                                            <span>80 votes</span>
                                        </div>-->
                                        <h3><a href="<?php echo Yii::$app->urlManager->createUrl(['/order/viewrestaurant', 'restaurantID' => $restaurant['restaurantID']]); ?>"><?php echo $restaurant['name']; ?></a></h3>
                                        <!--<h4>Chinese, Momos</h4>-->
                                        <h4><?php if($restaurant['avgCostAmount'] > 0){ echo 'Cost <span class="fa fa-rupee"></span> '.$restaurant['avgCostAmount'].' for '.App::getInWords($restaurant['avgCostHeadCount']); } ?></h4>
                                        <!--<h5>Min  0 - Up to 45 min </h5>-->
                                        <h5> <?php echo ($restaurant['isCardAccept']) ? 'Accepts cash &amp; online payments' : 'Accepts cash only'; ?></h5>
                                    </div>
                                    <div class="menu-bx04-btn">
                                        <div class="ofr-d"></div>
                                        <a href="<?php echo Yii::$app->urlManager->createUrl(['/order/orderonline', 'restaurantID' => $restaurant['restaurantID']]); ?>" class="cvbtn-2">Order Online 
                                            <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    	<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--inner-section1-end-->