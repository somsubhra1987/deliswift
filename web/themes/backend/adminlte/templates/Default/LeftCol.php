<?php
use app\lib\Core;
use app\lib\App;
use yii\bootstrap\ActiveForm;

$loginUserDetail = Core::getLoggedUser();
?>
<aside class="main-sidebar">
	<section class="sidebar">
	  	<ul class="sidebar-menu">
            <li class="<?php echo Core::getActiveClass(false, 'dashboard'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/dashboard']) ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo Core::getActiveClass(false, 'menu', 'index'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/menuitem']) ?>">
                    <i class="fa fa-list"></i> <span>Menu Items</span>
                </a>
            </li>
            
            <li class="<?php echo Core::getActiveClass(false, 'order', 'index'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/order']) ?>">
                    <i class="fa fa-shopping-cart"></i> <span>Orders</span>
                </a>
            </li>
            
            <li class="<?php echo Core::getActiveClass(false, 'deliveryboy', 'index'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/deliveryboy']) ?>">
                    <i class="fa fa-users"></i> <span>Delivery Boy</span>
                </a>
            </li>
            
            <li class="<?php echo Core::getActiveClass(false, 'city', 'index'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/city','countryCode'=>'IN','provinceID'=>'1']) ?>">
                    <i class="fa fa-list"></i> <span>City</span>
                </a>
            </li>
            <li class="<?php echo Core::getActiveClass(false, 'restaurant', 'index'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/admin/restaurant']) ?>">
                    <i class="fa fa-list"></i> <span>Restaurant</span>
                </a>
            </li>
	 	</ul>
	</section>
</aside>