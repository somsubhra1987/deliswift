<?php
use yii\helpers\Html;
use app\assets\AdminAsset;
use app\lib\core\App;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
    <?php $this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => '/apple-touch-icon.png']); ?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '32x32', 'href' => '/favicon-32x32.png']); ?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'sizes' => '16x16', 'href' => '/favicon-16x16.png']); ?>
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/assets/dist/css/skins/_all-skins.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/restaurant/default/css/custom.css" />
</head>
<body class="hold-transition skin-green sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
	<div class="confirm-order-wrapper">
    	<div class="confirm-order">
        	
        </div>
    </div>