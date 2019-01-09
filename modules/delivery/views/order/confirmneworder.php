<?php
/* @var $this yii\web\View */

use app\lib\App;
?>
<div class="padding10">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Pickup Location</h3>
        </div>
        
        <div class="box-body">
        	<?php
				$pickUpLocationDetail = '<strong>'.$restaurentDetail['name'].'</strong>';
				if($restaurentDetail['contactAddress'] != '')
				{
					$pickUpLocationDetail .= '<br />'.$restaurentDetail['contactAddress'];
				}
				
				$pickUpLocationDetail .= '<br />'.App::getCityName($restaurentDetail['cityID']);
				$pickUpLocationDetail .= '<br />'.App::getProvinceName($restaurentDetail['provinceID']).', '.App::getCountryName($restaurentDetail['countryCode']);
				
				echo $pickUpLocationDetail;
			?>
        </div>
    </div>
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Delivery Location</h3>
        </div>
        
        <div class="box-body no-padding">
        	
        </div>
    </div>
    
    <div align="center">
    	<input class="knob" data-readonly="true" value="100" data-width="100" data-thickness=".2" data-height="100" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px none; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; font: normal normal bold normal 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px;" type="text">
    </div>
    
    <div class="btn-container">
    	<a href="javascript:void(0);" name="confirmOrderBtn" id="confirmorderbtn" class="btn btn-lg btn-success" onclick="confirmOrder(<?php echo $model->orderID; ?>);">CONFIRM</a>
    </div>
</div>