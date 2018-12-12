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
	 	</ul>
	</section>
</aside>