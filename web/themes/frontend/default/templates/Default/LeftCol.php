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
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/delivery/dashboard']) ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php echo Core::getActiveClass('delivery', 'order', 'viewcurrentorder'); ?> treeview">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/delivery/order/viewcurrentorder']) ?>">
                    <i class="fa fa-truck"></i> <span>Current Order</span>
                </a>
            </li>
	 	</ul>
	</section>
</aside>