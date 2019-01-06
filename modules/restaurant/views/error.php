<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Error '.$error['statusCode'];
?>
<section class="content-header">
  <h1> <?php echo Html::encode($this->title).' '.$error['name']; ?> </h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
		  	<div class="error-page">
		    	<h2 class="headline text-yellow"> <?php echo $error['statusCode']; ?></h2>
		
		    	<div class="error-content">
		      		<h3><i class="fa fa-warning text-yellow"></i> <?php echo 'Oops! '.$error['message']; ?></h3>
		
		      		<p>
		        		We could not find the page you were looking for.
		        		Meanwhile, you may <a href="<?php echo Yii::$app->urlManager->createUrl(['/dashboard']) ?>">return to dashboard</a>
		      		</p>
		    	</div>
		    	<!-- /.error-content -->
		  	</div>
		  	<!-- /.error-page -->
		</div>
	</div>
</section>
<!-- /.content -->