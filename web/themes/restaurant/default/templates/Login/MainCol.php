<?php

use app\lib\Core;
?>
<div class="login-box">
	<div class="login-logo">
	  <!--<span style="color:#FFF;">User Login</span> -->
	  <span><img src="<?php echo Core::getRootUrl().'/images/logo.png'; ?>" alt="<?php echo Yii::$app->name; ?>"/></span>
	</div><!-- /.login-logo -->
	 <?php echo $content; ?>
	<p>&nbsp;</p>
    <p class="text-center text-muted">&copy; <?php echo Yii::$app->name ?> <?= date('Y') ?></p>
</div>