<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = 'Assign Order';
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
		
		<div class="assign-delivery-boy accountBasicInfo">
        	<div class="modal-body">
				<?php
                    $slNo = 0;
                    foreach($availableDeliveryBoyArr as $availableDeliveryBoy)
                    {
                        $slNo++;
                        $assignToDeliveryBoyUrl =  Yii::$app->urlManager->createUrl(['admin/order/assigntodeliveryboy','id' => $model->orderID, 'deliveryBoyID' => $availableDeliveryBoy['deliveryBoyID']]);
                ?>
                    <div class="row">
                        <div class="hidden-sm hidden-xs col-md-1 col-sm-12 col-xs-12" align="center">
                            <?php echo $slNo; ?>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <?php echo $availableDeliveryBoy['name']; ?>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <div><span class="fa fa-phone">&nbsp;&nbsp;</span> <a href="tel:<?php echo $availableDeliveryBoy['phoneNumber']; ?>"><?php echo $availableDeliveryBoy['phoneNumber']; ?></a></div>
                            <div><span class="fa fa-envelope">&nbsp;&nbsp;</span> <?php echo $availableDeliveryBoy['emailAddress']; ?></div>
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            <?php echo ($availableDeliveryBoy['todayOrderCount'] == 0) ? '<span class="text-red">Get no order today</span>' : 'Get <strong>'.$availableDeliveryBoy['todayOrderCount'].'</strong> orders today'; ?>
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12" align="right">
                            <a href="<?php echo $assignToDeliveryBoyUrl; ?>" class="btn btn-success">Assign</a>
                        </div>
                    </div>
                <?php } ?>
        	</div>
            <div id="msg"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
            </div>
		</div>
	</div>
</div>