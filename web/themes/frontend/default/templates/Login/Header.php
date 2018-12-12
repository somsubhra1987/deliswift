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
	<title>Vivah Bandhan</title>
	 
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>    

  <?php $this->head() ?>  
    <?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/bootstrap.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?> 
      <?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/slick.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?> 
  <?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/login_style.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>
  <?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/font-awesome.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>


  <?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/animate.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>
  <?php echo $this->registerCssFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/css/default-theme.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);?>

  <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />  
  <?php $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/js/bootstrap.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
  <?php $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/vivahBandhan/js/slick.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

 <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
