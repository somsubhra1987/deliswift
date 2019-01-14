<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];


$fieldMenuCoursetypeLoaderOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' id='restaurant_menu_coursetype_loader' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$checkBoxOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2\">{input}{label}{error}</div></div>"
];


$menuCourseTypeList = App::getMenuCourseTypeAssoc();

$this->title = 'Create Special Menu - '. App::getRestaurantName($model->restaurantID);
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo Html::encode($this->title) ?> </h4>
		</div>
		
		<div class="menu-create menuInfo">		    

			<div class="theme-form specialmenu-form">
			    <div class="modal-body">
			        <div class="form-group">
			            <div class="row">
			                <div class="col-lg-2 col-md-2 col-sm-12">Restaurant</div>
			                <div class="col-lg-10 col-md-10 col-sm-12"><?php echo App::getRestaurantName($model->restaurantID); ?></div>
			            </div>
			        </div>

				     <?php $form = ActiveForm::begin([
				        'id' => 'menu-form',
				        'options' => ['onSubmit'=> 'return false','enctype'=>'multipart/form-data']
				    ]); ?>

			        <?php echo Html::activeHiddenInput($model,'restaurantID',array('value'=>$model->isNewRecord?$model->restaurantID:$model->restaurantID)); ?>

			        <?php echo $form->field($model, 'courseType',$fieldMenuCoursetypeLoaderOptions)->dropDownList($menuCourseTypeList,['prompt'=>'--select--', 'class' => 'form-control req_input', 'style' => 'width:75%;']) ?>

			        <?php echo $form->field($model, 'specialmenuItemName',$fieldOptions1)->textInput(['maxlength' => true]) ?>
			        <?php echo $form->field($model, 'price',$fieldOptions1)->textInput(['maxlength' => true]) ?>

			        <?php echo $form->field($model, 'imagePath',$fieldOptions1)->fileInput(['class' => 'form-control file_input', 'accept' => 'image/*']); ?>

			        <?php echo $form->field($model, 'isOutofstock',$checkBoxOptions)->checkbox() ?>


			        <?php ActiveForm::end(); ?>

			        <div id="msg"></div>
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
			        <?php echo Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-lg btn-success', 'onClick' =>  'recordCreateOrUpdate("'.$specialmenuCreateUrl.'",this)']) ?>
			    </div>
			</div>
		
		</div>
	</div>
</div>

