<?php
/* @var $this yii\web\View */

use app\lib\App;
use app\lib\Core;
?>
<audio id="myAudio">
  	<source src="<?php echo Core::getRootUrl().'/web/sounds/restaurent_alert.mp3'; ?>" type="audio/mpeg">
</audio>
<div class="padding10">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Order Detail</h3>
        </div>
        
        <div class="box-body no-padding">
        	<ul class="sel-menu">
				<?php
                    foreach($orderDetailArr as $orderDetail)
                    {
						$menuDetail = App::getMenuDetail($model->restaurantID, $orderDetail['menuItemID']);
                ?>
                <li><?php echo App::getMenuitemName($orderDetail['menuItemID']); ?></li>
                <?php
                    }
                ?>
        	</ul>
        </div>
    </div>
    
    <div class="btn-container">
    	<a href="javascript:void(0);" name="confirmOrderBtn" id="confirmorderbtn" class="btn btn-lg btn-success" onclick="processOrderConfirm(<?php echo $model->orderID; ?>);">CONFIRM</a>
    </div>
</div>
<?php
$this->registerJs(
	'playAlertSound();'
);
?>
<script type="text/javascript">
var myAudio = document.getElementById("myAudio");
function playAlertSound()
{
	myAudio.play();
}

function processOrderConfirm(orderID)
{
	myAudio.pause();
	confirmOrder(orderID);
}
</script>