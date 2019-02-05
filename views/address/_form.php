<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\Core;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerAddress */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-3 col-md-3 col-sm-3\">{label}</div><div class=\"col-lg-9 col-md-9 col-sm-9\">{input}{error}</div></div>"
];

$customerDetail = Core::getLoggedCustomer();
$locationUrl = Yii::$app->urlManager->createUrl('site/getdeliverylocationlist');
$addressTypeArr = array(1=>'Home', 2=>'Work');
if($model->isNewRecord)
{
	$model->addressType = 1;
	$model->isDefault = 1;
	
	if($restaurantID > 0)
	{
		$deliveryLocationID = Core::getData("SELECT deliveryLocationID FROM res_restaurants WHERE restaurantID = '$restaurantID'");
		$model->deliveryLocationID = $deliveryLocationID;
		$model->deliveryLocation = App::getDeliveryLocationName($deliveryLocationID);
	}
}
?>

<div class="customer-address-form">
	<div class="modal-body"> 
		<?php $form = ActiveForm::begin(['id' => 'address-form']); ?>
    
        <?php echo $form->field($model, 'deliveryLocationID')->hiddenInput()->label(false) ?>
        
        <div class="positionR-Div">
			<?php echo $form->field($model, 'deliveryLocation')->textInput(['data-selected-city' => $customerDetail->lastSelectedCityID, 'data-url' => $locationUrl, 'placeholder' => 'Delivery Location', 'readonly' => 'readonly']) ?>
            
            <div class="src-rglt-D hidden" id="deliveryLocationSuggestion">
                <ul>
                    
                </ul>
            </div>
        </div>
    
        <?php echo $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Complete Address e.g. house number, street name, landmark']) ?>
    
        <?php echo $form->field($model, 'deliveryInstruction')->textarea(['rows' => 6, 'placeholder' => 'Delivery Instructions e.g. Opposite State Bank of India']) ?>
    
        <?php echo $form->field($model, 'addressType')->radioList($addressTypeArr)->label(false) ?>
    
        <?php ActiveForm::end(); ?>
    
    	<div id="msg"></div>
	</div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</button>

        <?php echo Html::button($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success  btn-lg' : 'btn btn-primary  btn-lg', 'onClick' => $model->isNewRecord ? 'addOrUpdateAddress("'.$addressCreateUrl.'", this)' : 'addOrUpdateAddress("'.$addressUpdateUrl.'", this)']) ?>
    </div>
</div>

<?php
/*$this->registerJs('
	var typingTimer;
	$("#customeraddress-deliverylocation").on("keyup", function(){
		clearTimeout(typingTimer);
  		typingTimer = setTimeout(getDeliveryLocation, 300);
	});
	
	$("#customeraddress-deliverylocation").on("keydown", function () {
		clearTimeout(typingTimer);
	});
	
	$("#customeraddress-deliverylocation").on("click", function(){
		if($("#deliveryLocationSuggestion > ul > li").length() > 0)
		{
			$("#deliveryLocationSuggestion").removeClass("hidden");
		}
	});
');*/
?>
<script type="text/javascript">
function getDeliveryLocation()
{
	var searchText = $("#customeraddress-deliverylocation").val();
	var cityID = $("#customeraddress-deliverylocation").attr('data-selected-city');
	if(searchText == '')
	{
		$("#customeraddress-deliverylocationid").val(0);
		$("#deliveryLocationSuggestion > ul").html('');
		$("#deliveryLocationSuggestion").addClass('hidden');
		return false;
	}
	
	$.ajax({
		type:"GET",
		url:$("#customeraddress-deliverylocation").attr('data-url'),
		dataType: "json",
		data:{searchText:searchText, cityID:cityID},
		success: function(response) {
			var items = [];
			if(Object.keys(response).length > 0)
			{
				$.each( response, function( key, data ) {
					items.push( "<li value='" + data.deliveryLocationID + "'><a href='javascript:void(0);' onclick='setDeliveryLocationID(this, "+data.deliveryLocationID+");'>" + data.deliveryLocationName + "</a></li>" );
				});
			}
			else
			{
				items.push( "<li><h6>No Results</h6><p>Your search returned no results</p></li>" );
			}
			$("#search-delivery-location-btn").html('Search').removeAttr('disabled').removeClass('disabled');
			$("#deliveryLocationSuggestion > ul").html(items.join(""));
			$("#deliveryLocationSuggestion").removeClass('hidden');
		}
	});
}

function setDeliveryLocationID(obj, deliveryLocationID)
{
	$("#customeraddress-deliverylocationid").val(deliveryLocationID);
	$("#customeraddress-deliverylocation").val($(obj).html());
	$("#deliveryLocationSuggestion").addClass('hidden');
}
</script>