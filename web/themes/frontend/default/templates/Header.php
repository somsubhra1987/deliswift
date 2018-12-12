<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
use app\lib\core\Cms;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<title><?= Yii::$app->name.'::'.$this->title ?></title>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>    

<?php $this->head() ?>
<?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']); ?>
<link rel="stylesheet" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/css/font-awesome.min.css" />
<?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/default/css/style.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>  
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
