<?php
use yii\helpers\Html;
use app\lib\Core;
?>
 
<!-- Header start -->
  <section id="menu-area">      
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>          
            </button>
          <!-- LOGO -->              
          <!-- TEXT BASED LOGO -->
          <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>"><?= Html::img(Yii::$app->getUrlManager()->getBaseUrl()."/themes/frontend/vivahBandhan/images/logo.png", ['alt' => '', 'width'=>200])?></a>                                  
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
            <?php
            if(Core::getLoggedUserID())
            {
            ?>           
            <li class="dropdown" onmouseover="showHideMenu(this, 1);" onmouseout="showHideMenu(this, 0);">
                <a href="#" id="myHomeDropdown" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" style="border-right:none;" onmouseover=""> My Home   <span class="fa fa-angle-down"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?=Yii::$app->homeUrl?>member">My Profile</a></li>    
                    <!--<li><a href="#">Who View My Profile</a></li>-->
                    <li><a href="<?=Yii::$app->urlManager->createUrl(['member/shortlistme'])?>">Who Shortlist Me  </a></li>  
                    <!--<li><a href="#">Profile I have ignore <strong class="red-text"> (8)</strong>  </a></li> -->
                </ul>
            </li> 
            <?php
            }
            else
            {
              ?>
              <li><a href="<?=Yii::$app->homeUrl?>">Home</a></li>
              <?php  
            }
            ?>       
            <!--<li><a href="#">Search</a></li>-->
            <li><a href="<?=Yii::$app->urlManager->createUrl(['member/usersearch'])?>">Matches</a></li>
            <!--<li><a href="#">Message</a></li>
            <li><a href="#"> Services</a></li>
            <li><a href="#">Help </a></li>-->
            <?php
            if(Core::getLoggedUserID())
            {
            ?>
            <li class="dropdown" onmouseover="showHideMenu(this, 1);" onmouseout="showHideMenu(this, 0);">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="border-right:none;"> My Account   <span class="fa fa-angle-down"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?=Yii::$app->homeUrl?>member"><?php echo Core::getLoggedUser()->name;?></a></li>
                    <!--<li><a href="#">Notifications </a></li>-->
                    <li><a href="<?=Yii::$app->urlManager->createUrl(['member/default/changepassword', 'id' => Core::getLoggedUser()->id])?>">Change Password </a></li>
                    <li><a href="<?=Yii::$app->homeUrl?>member">Edit Profile </a></li>
                    <!--<li><a href="<?=Yii::$app->homeUrl?>member">Setting </a></li>-->
                    <li><a href="<?=Yii::$app->urlManager->createUrl(['site/logout'])?>" data-method = "post">Logout</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
          </ul>                   
        </div><!--/.nav-collapse -->
      </div>     
    </nav>
  </section>
  <!-- END header -->
<script type="text/javascript">
function showHideMenu(obj, flg)
{
	if(!$(obj).hasClass('open'))
	{
		$(obj).addClass('open');
	}
	if(flg == 0)
	{
	 	$(obj).removeClass('open');
	}
}
</script>