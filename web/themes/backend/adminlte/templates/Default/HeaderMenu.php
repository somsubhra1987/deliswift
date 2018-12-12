<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\lib\Core;

$loggedUserID = Yii::$app->session['loggedUserID'];
$user = Core::getUser($loggedUserID);
$logoutUrl =  Yii::$app->urlManager->createAbsoluteUrl("admin/logout");
$dashboardUrl =  Yii::$app->urlManager->createAbsoluteUrl("dashboard");
?>
<header class="main-header">
	<a href="<?=$dashboardUrl?>" class="logo">
	  <span class="logo-mini"><?php echo Html::img('/themes/backend/adminlte/images/logo.png', ['style' => 'height: 30px;']); ?></span>
	  <span class="logo-lg"><div style="height: 15px; line-height: 38px;"><?php echo strtoupper(Yii::$app->name); ?></div></span>
	</a>
	
	<nav class="navbar navbar-static-top" role="navigation">
	  	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	    	<span class="sr-only">Toggle navigation</span>
	  	</a>
	  	<div class="navbar-custom-menu">
		    <ul class="nav navbar-nav">           
		      <li class="dropdown user user-menu">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		          <span class="hidden-xs"><?php echo $user->name;?><i style="margin-left:10px" class="fa fa-angle-down"></i></span>
		        </a>
		        <ul class="dropdown-menu">
		          <li class="user-header">
		           <img src="<?php echo $user->photo;?>" class="img-circle" alt="User Image">
		            <p>
		              <?php echo $user->name;?>
		            </p>
		          </li>
		          <li class="user-footer">
		            <div class="pull-left">
		              <a href="#" class="btn btn-default btn-flat">Profile</a>
		            </div>
		            <div class="pull-right">
		              <a href="<?php echo $logoutUrl; ?>" class="btn btn-default btn-flat">Sign out</a>
		            </div>
		          </li>
		        </ul>
		      </li>
		    </ul>
	  	</div>
	</nav>
</header>