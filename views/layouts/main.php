<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
    <div class="modal fade" id="login-registration-modal" tabindex="-1" role="dialog">
        <div class="popupArea">
            <div class="popupArea-in">
            	<h2>Sign up or log in to Compant Name</h2>
            	<div id="login-div">
                    <a href="#" class="fbBTN"><span><i class="fa fa-facebook" aria-hidden="true"></i></span>Continue with Facebook</a>
                    <a href="#" class="googleBTN"><span><i class="fa fa-google" aria-hidden="true"></i></span>Continue with Google</a>
                    <div class="clear"></div>
                    <div class="orDiv">Or</div>
                    <div class="clear"></div>
                    <h3>Or use your email address</h3>
                    <a href="javascript:void(0);" class="logStyle">Log In</a>
                    <a href="javascript:void(0);" id="sign-up-btn" class="signStyle">Sign Up</a>
                    
                    <p>By logging in, you agree to <?php echo Yii::$app->name."'s"; ?> <a href="#">Terms of Service</a>, Cookie Policy, <a href="#">Privacy Policy</a> and <a href="#">Content Policies</a>.</p>
            	</div>
            
                <div id="registration-div" class="hidden">
                    <div class="fullwd clear-fix">
                        <label>Full Name</label>
                        <input type="text" class="locFd02">
                    </div>
                    <div class="fullwd clear-fix">
                        <label>Email Address</label>
                        <input type="email" class="locFd02">
                    </div>
                    <div class="fullwd clear-fix">
                        <label>Password</label>
                        <input type="password" class="locFd02">
                    </div>
                    <div class="clear"></div>
                    
                    <div class="ck-dv">
                        <input type="checkbox">	I agree to <?php echo Yii::$app->name."'s"; ?> Terms of Service, Privacy Policy and Content Policies.
                    </div>
                    
                    <a href="#" class="logStyle2">Register</a>
                </div>
                
                <a href="#" data-dismiss="modal" class="crsDiv"><i class="fa fa-times" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <!--popup-end-->
    <!--header-->
    <header class="clear-fix">
        <!--header-top-->
        <div class="header-top clear-fix">
            <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="rightAlignD">
                        <ul class="loginMenu">
                            <li><a href="#" data-toggle="modal" data-target="#login-registration-modal">Login</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#login-registration-modal">Create an account</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!--header-top-end--> 
        
        <!--header-bottom-->
        <div class="header-bottom clear-fix"> 
            <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!--logo--> 
                    <div class="logo">
                        <a href="#"><img src="images/logo.png" alt=""></a>
                    </div>
                    <!--logo-end-->
                    <div class="bannerText">
                        <h1>Find the best restaurants, cafes, and bars in Kolkata</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="search-fild-area">
                        <div class="loc-sec">
                            <div class="icon01"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                            <input class="txt-fd1" placeholder="Location" type="text">
                        </div>
                        <div class="Restaurants-src">
                            <div class="icon01"><i class="fa fa-search" aria-hidden="true"></i></div>
                            <input class="txt-fd1" placeholder="Start typing to search..." type="text" id="type-box">
                            
                            <div class="Restaurants-src-menu" id="restaurants-src-menu">
                                <ul>
                                    <li><a href="#"><span><img src="images/category_1.png" alt=""></span>Delivery</a></li>
                                    <li><a href="#"><span><img src="images/category_2.png" alt=""></span>Breakfast</a></li>
                                    <li><a href="#"><span><img src="images/category_3.png" alt=""></span>Lunch</a></li>
                                    <li><a href="#"><span><img src="images/category_4.png" alt=""></span>Dinner</a></li>
                                    <li><a href="#"><span><img src="images/category_5.png" alt=""></span>Drinks & Nightlife</a></li>
                                    <li><a href="#"><span><img src="images/category_6.png" alt=""></span>Cafes</a></li>
                                    <li><a href="#"><span><img src="images/category_7.png" alt=""></span>Pocket-Friendly Delivery</a></li>
                                    <li><a href="#"><span><img src="images/category_8.png" alt=""></span>Chinese</a></li>
                                    <li><a href="#"><span><img src="images/category_9.png" alt=""></span>North Indian</a></li>
                                    <li><a href="#"><span><img src="images/category_10.png" alt=""></span>Buffet Places</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="bnr-sec-btn"><button type="submit" class="srcBTN09">Search</button></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
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
           	<div class="col-md-3 col-sm-3 col-xs-12">
            	<h2>Quick Links</h2>
                <ul class="foot-menu">
                	<li><a href="#">About Us</a></li>
                    <li><a href="#">Culture</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div> 
            <div class="col-md-3 col-sm-3 col-xs-12 mob-none">
            	<h2>About Restaurants</h2>
                <ul class="foot-menu">
                	<li><a href="#">About Us</a></li>
                    <li><a href="#">Culture</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div> 
            <div class="col-md-3 col-sm-3 col-xs-12 mob-none">
            	<h2>For Foodies</h2>
                <ul class="foot-menu">
                	<li><a href="#">Code of Conduct</a></li>
                    <li><a href="#">Community</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div> 
            <div class="col-md-3 col-sm-3 col-xs-12 mob-none">
            	<h2>For Restaurants</h2>
                <ul class="foot-menu">
                	<li><a href="#">About Us</a></li>
                    <li><a href="#">Culture</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
