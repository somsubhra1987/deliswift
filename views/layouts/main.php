<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use app\lib\Core;
use app\lib\App;

AppAsset::register($this);
if(Yii::$app->session->has('loggedCustomerID'))
{
	$customerDetail = Core::getLoggedCustomer();
	$lastSelectedCityID = $customerDetail->lastSelectedCityID;
	$cityName = App::getCityName($lastSelectedCityID);
}
else
{
	$lastSelectedCityID = App::getLastSelectedCityIDAgainstIP();
	$cityName = App::getCityName($lastSelectedCityID);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico"/>
	<link rel="icon" type="image/png" href="favicon.png"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="loader-div">
	<div><?php echo Yii::$app->name; ?></div>
</div>
<div class="wrapper">
    <!--popup-->
    <?php if(!Yii::$app->session->has('loggedCustomerID')){ ?>
    <div class="modal fade" id="login-registration-modal" tabindex="-1" role="dialog">
        <div class="popupArea">
            <div class="popupArea-in">
            	<h2>Sign up or log in to <?php echo Yii::$app->name; ?></h2>
            	<div id="login-register-div">
                    <a href="#" class="fbBTN"><span><i class="fa fa-facebook" aria-hidden="true"></i></span>Continue with Facebook</a>
                    <a href="#" class="googleBTN"><span><i class="fa fa-google" aria-hidden="true"></i></span>Continue with Google</a>
                    <div class="clear"></div>
                    <div class="orDiv">Or</div>
                    <div class="clear"></div>
                    <h3>Or use your email address</h3>
                    <a href="javascript:void(0);" id="login-btn" class="logStyle">Log In</a>
                    <a href="javascript:void(0);" id="sign-up-btn" class="signStyle">Sign Up</a>
                    
                    <p>By logging in, you agree to <?php echo Yii::$app->name."'s"; ?> <a href="#">Terms of Service</a>, Cookie Policy, <a href="#">Privacy Policy</a> and <a href="#">Content Policies</a>.</p>
            	</div>
                
                <div id="login-div" class="hidden">
                	<div id="loginResponse" style="margin-bottom:10px;">
                    
                    </div>
                	<form name="loginForm" id="loginForm" action="<?php echo Yii::$app->urlManager->createUrl('/login'); ?>">
                        <div class="fullwd clear-fix">
                            <label>Email Address</label>
                            <input type="email" class="locFd02" name="loginFullName" id="loginFullName" required="required" />
                        </div>
                        <div class="fullwd clear-fix">
                            <label>Password</label>
                            <input type="password" class="locFd02" name="loginPassword" id="loginPassword" required="required" />
                        </div>
                        <div class="clear"></div>
                        
                        <input type="submit" class="logStyleBtn" value="Login" />
                	</form>
                </div>
            
                <div id="registration-div" class="hidden">
                	<div id="registrationResponse" style="margin-bottom:10px;">
                    
                    </div>
                    
                	<form name="registerForm" id="registerForm" action="<?php echo Yii::$app->urlManager->createUrl('/register'); ?>">
                        <div class="fullwd clear-fix">
                            <label class="required">Full Name</label>
                            <input type="text" class="locFd02" name="registrationFullName" id="registrationFullName" required="required" />
                        </div>
                        <div class="fullwd clear-fix">
                            <label class="required">Email Address</label>
                            <input type="email" class="locFd02" name="registrationEmailAddress" id="registrationEmailAddress" required="required" />
                        </div>
                        <div class="fullwd clear-fix">
                            <label class="required">Password</label>
                            <input type="password" class="locFd02" name="registrationPassword" id="registrationPassword" required="required" />
                        </div>
                        <div class="fullwd clear-fix">
                            <label class="required">Confirm Password</label>
                            <input type="password" class="locFd02" name="registrationConfirmPassword" id="registrationConfirmPassword" required="required" />
                        </div>
                        <div class="clear"></div>
                        
                        <div class="ck-dv">
                            <input type="checkbox" name="registerTermsAccepted" id="registerTermsAccepted" required="required" />	I agree to <?php echo Yii::$app->name."'s"; ?> Terms of Service, Privacy Policy and Content Policies.
                        </div>
                        
                        <input type="submit" class="logStyleBtn" value="Register" />
                    </form>
                </div>
                
                <a href="#" data-dismiss="modal" class="crsDiv"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <?php } ?>
    <!--popup-end-->
    <!--header-->
    <header class="<?php if($this->title != 'Home'){ echo 'innerHead '; } ?> clear-fix">
        <!--header-top-->
        <div class="<?php if($this->title == 'Home'){ echo 'header-top'; }else{ echo 'inner-header';} ?> clear-fix">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<?php if($this->title != 'Home'){ ?>
                        	<div class="logo-inner">
                            	<a href="<?php echo Yii::$app->homeUrl; ?>"><img src="<?php echo Core::getRootUrl().'/images/logo-inner.png'; ?>"></a>
                            </div>
                            <?php if(!isset($this->params['headerSearchBoxStatus']) || $this->params['headerSearchBoxStatus'] > 0){ ?>
                            <div class="search-fild-area search-fild-areaInner">
                            	<div class="loc-sec">
                                    <div class="icon01"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                                    <input class="txt-fd1" name="locationCity" id="locationCity" placeholder="Location" type="text" data-url="<?php echo Yii::$app->urlManager->createUrl('site/getcitylist'); ?>" value="<?php echo $cityName; ?>" />
                                    <!---->
                                    <div class="src-rglt-D hidden" id="locationCitySuggestion">
                                        <ul>
                                            <?php if($cityName != ''){ ?>
                                                <li>
                                                    <a href="javascript:void(0);"><?php echo $cityName; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!---->
                                </div>
                                <div class="Restaurants-src">
                                    <div class="icon01"><i class="fa fa-search" aria-hidden="true"></i></div>
                                    <input class="txt-fd1" placeholder="Start typing to search..." type="text" id="type-box" />
                                    
                                    <div class="Restaurants-src-menu" id="restaurants-src-menu">
                                        <ul>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_1.png'; ?>" alt=""></span>Delivery</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_2.png'; ?>" alt=""></span>Breakfast</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_3.png'; ?>" alt=""></span>Lunch</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_4.png'; ?>" alt=""></span>Dinner</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_5.png'; ?>" alt=""></span>Drinks & Nightlife</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_6.png'; ?>" alt=""></span>Cafes</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_7.png'; ?>" alt=""></span>Pocket-Friendly Delivery</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_8.png'; ?>" alt=""></span>Chinese</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_9.png'; ?>" alt=""></span>North Indian</a></li>
                                            <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_10.png'; ?>" alt=""></span>Buffet Places</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bnr-sec-btn"><button type="submit" class="srcBTN09" id="search-banner-btn">Search</button></div>
                            </div>
                            <?php } ?>
						<?php } ?>
                        <?php if(Yii::$app->session->has('loggedCustomerID')){ ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li id="fat-menu" class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="drop" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <img src="<?php echo $customerDetail->photo; ?>"> <?php echo $customerDetail->firstName; ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu" aria-labelledby="drop">
                                        <li><a href="#">Settings</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo Yii::$app->urlManager->createUrl('logout'); ?>">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        <?php }else{ ?>
                            <div class="rightAlignD">
                                <ul class="loginMenu dxkon">
                                    <li><a href="#" data-toggle="modal" data-target="#login-registration-modal">Login</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#login-registration-modal">Create an account</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--header-top-end--> 
        
        <?php if($this->title == 'Home'){ ?>
        <!--header-bottom-->
        <div class="header-bottom clear-fix"> 
            <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!--logo--> 
                    <div class="logo">
                        <a href="<?php echo Yii::$app->homeUrl; ?>"><img src="<?php echo Core::getRootUrl().'/images/logo.png'; ?>" alt=""></a>
                    </div>
                    <!--logo-end-->
                    <div class="bannerText">
                        <h1>Find the best restaurants, cafes, and bars in Kolkata</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="search-fild-area">
                        <div class="loc-sec">
                            <div class="icon01"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                            <input class="txt-fd1" name="locationCity" id="locationCity" placeholder="Location" type="text" data-url="<?php echo Yii::$app->urlManager->createUrl('site/getcitylist'); ?>" value="<?php echo $cityName; ?>" />
                            <!---->
                            <div class="src-rglt-D hidden" id="locationCitySuggestion">
                                <ul>
                                	<?php if($cityName != ''){ ?>
                                        <li>
                                            <a href="javascript:void(0);"><?php echo $cityName; ?></a>
                                        </li>
                                	<?php } ?>
                                </ul>
                            </div>
                            <!---->
                        </div>
                        <div class="Restaurants-src">
                            <div class="icon01"><i class="fa fa-search" aria-hidden="true"></i></div>
                            <input class="txt-fd1" placeholder="Start typing to search..." type="text" id="type-box" />
                            
                            <div class="Restaurants-src-menu" id="restaurants-src-menu">
                                <ul>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_1.png'; ?>" alt=""></span>Delivery</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_2.png'; ?>" alt=""></span>Breakfast</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_3.png'; ?>" alt=""></span>Lunch</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_4.png'; ?>" alt=""></span>Dinner</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_5.png'; ?>" alt=""></span>Drinks & Nightlife</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_6.png'; ?>" alt=""></span>Cafes</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_7.png'; ?>" alt=""></span>Pocket-Friendly Delivery</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_8.png'; ?>" alt=""></span>Chinese</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_9.png'; ?>" alt=""></span>North Indian</a></li>
                                    <li><a href="#"><span><img src="<?php echo Core::getRootUrl().'/images/category_10.png'; ?>" alt=""></span>Buffet Places</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="bnr-sec-btn"><button type="submit" class="srcBTN09" id="search-banner-btn">Search</button></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!--header-bottom-end-->  
    </header>
    <!--header-end-->

    <?= $content ?>
</div>

<!--footer-->
<footer class="clear-fix">
    <!--footer-top-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ul class="foot-menu">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--footer-top-end-->
    <!--footer-bottom-->
    <div class="footer-bottom clear-fix">
    <div class="container">
    	<div class="row">
        	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="copyD">&copy; <?php echo Yii::$app->name.' ('.date('Y').')'; ?> </div>
            </div>
        </div>
    </div>
    </div>
    <!--footer-bottom-end-->
</footer>
<!--footer-end-->
<div class="modal fade" id="commonModal" tabindex="-1" role="dialog"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
