<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MenuItem */
/* @var $form yii\widgets\ActiveForm */
$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];

$checkBoxOptions = [
  'template' => "<span class=\"chkBox\">{input}{label}{error}</span>"
];
$menuCourseType = App::getMenuCourseTypeAssoc();

?>

<div class="city-form">

     <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'menuItemName',$fieldOptions1)->textInput(['maxlength' => true, 'spellcheck' => 'true', 'autofocus' => 'autofocus']); ?> 
    <?php echo $form->field($model, 'courseType',$fieldOptions1)->dropdownList($menuCourseType) ?>

    <?php echo $form->field($model, 'isVeg',$fieldOptions1)->checkbox();?>

    <div class="form-group">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-lg-10 col-md-10 col-sm-10">
                <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>