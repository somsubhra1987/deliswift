<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;
use app\lib\Core;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RestaurantPhoto */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];
?>

<div class="restaurant-photo-form">
	<div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12">Restaurant</div>
                <div class="col-lg-10 col-md-10 col-sm-12"><?php echo App::getRestaurantName($model->restaurantID); ?></div>
            </div>
        </div>
        
		<?php $form = ActiveForm::begin(); ?>
    	
        <?php if(!$model->isNewRecord){ ?>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-10 col-md-10 col-sm-12"><img src="<?php echo Core::getUploadedUrl().'/restaurant/'.$model->photoName; ?>" class="menu-img img-responsive" width="100" /></div>
            </div>
        </div>
        <?php } ?>
        <?php echo $form->field($model, 'photoName', $fieldOptions1)->fileInput(['accept' => 'image/*']) ?>
        <?php echo $form->field($model, 'photoType', $fieldOptions1)->dropDownList(array(1=>'Gallery', 2=>'Menu')) ?>
        <div id="msg"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
        <?php echo Html::button($model->isNewRecord ? 'Add New' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary', 'onClick' =>  'recordCreateOrUpdate("'.$photoUploadUrl.'",this)']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
