<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\lib\App;
use app\lib\AppHtml;

$this->title = 'View Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
	<div class="row" style="padding:5px 0 0 0;">
        <div class="col-md-12"><?php echo AppHtml::getFlash(); ?></div>
    </div>
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order Detail</h3>
        </div>
        
        <div class="box-body">
        	
        </div>
    </div>
</section>