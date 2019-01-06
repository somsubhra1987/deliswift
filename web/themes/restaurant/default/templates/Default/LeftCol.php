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
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/restaurant/dashboard']) ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php echo Core::getActiveClass('restaurant', 'order', 'viewrecentorder'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/restaurant/order/viewrecentorder']) ?>">
                    <i class="fa fa-truck"></i> <span>Recent Order</span>
                </a>
            </li>
	 	</ul>
	</section>
</aside>