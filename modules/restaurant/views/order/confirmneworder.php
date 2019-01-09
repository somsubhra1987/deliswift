<?php
/* @var $this yii\web\View */

use app\lib\App;
?>
<div class="padding10">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order Detail</h3>
        </div>
        
        <div class="box-body no-padding">
        	
        </div>
    </div>
    
    <div class="btn-container">
    	<a href="javascript:void(0);" name="confirmOrderBtn" id="confirmorderbtn" class="btn btn-lg btn-success" onclick="confirmOrder(<?php echo $model->orderID; ?>);">CONFIRM</a>
    </div>
</div>