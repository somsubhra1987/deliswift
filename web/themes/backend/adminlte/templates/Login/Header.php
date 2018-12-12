<?php
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
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
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']); ?>
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/assets/dist/css/skins/_all-skins.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/css/custom.css" />
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>