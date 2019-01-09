<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */ 

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];


$fieldMenuCoursetypeLoaderOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' id='restaurant_menu_coursetype_loader' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$fieldMenuItemLoaderOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' id='restaurant_menuitem_loader' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$checkBoxOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2\">{input}{label}{error}</div></div>"
];


$menuCourseTypeList = App::getMenuCourseTypeAssoc();

if($model->isNewRecord)
{
    $typeFieldName = 'courseType';
    $typeFieldValue = $model->courseType;
}
else
{    
    $typeFieldName = 'menuItemID';
    $typeFieldValue = $model->menuItemID;
}

$existsMenuItemList         = $menuItemList = [];
$menuItemList               = App::getMenuItemAssoc($typeFieldName,$typeFieldValue);
if($model->isNewRecord)
{    
    $existsMenuItemList         = App::getRestaurantMenuItems($model->restaurantID);
    $menuItemList               = array_diff_assoc($menuItemList, $existsMenuItemList);
}

$menuItemUrl = Yii::$app->urlManager->createUrl('admin/menuitem/getmenuitemagainstcoursetype');

?>
<style type="text/css">
label.upload_image_label {
   cursor: pointer;
   /* Style as you please, it will become the visible UI component. */
}
.menu_image {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
.field-menu-imageDisplay .imageWrap{text-align: center;}
.field-menu-imageDisplay .imageWrap img{display: inline;}
</style>

<div class="theme-form menu-form">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">Restaurant</div>
                <div class="col-lg-9 col-md-9 col-sm-9"><?php echo App::getRestaurantName($model->restaurantID); ?></div>
            </div>
        </div>


     <?php $form = ActiveForm::begin([
        'id' => 'menu-form',
        'options' => ['onSubmit'=> 'return false','enctype'=>'multipart/form-data']
    ]); ?>

        <?php echo Html::activeHiddenInput($model,'restaurantID',array('value'=>$model->isNewRecord?$model->restaurantID:$model->restaurantID)); ?>

        <?php echo $form->field($model, 'courseType',$fieldMenuCoursetypeLoaderOptions)->dropDownList($menuCourseTypeList,['prompt'=>'--select--', 'class' => 'form-control req_input', 'style' => 'width:75%;', 'onchange' => 'getRestaurantMenuItem(this.value, "menu-menuitemid", "restaurant_menuitem_loader"," '.$model->restaurantID.' ");','disabled'=>$model->isNewRecord?false:true]) ?>

        <?php echo $form->field($model, 'menuItemID',$fieldMenuItemLoaderOptions)->dropDownList($menuItemList,['prompt'=>'--select--', 'class' => 'form-control', 'style' => 'width:75%;','disabled'=>$model->isNewRecord?false:true]) ?>


        <?php echo $form->field($model, 'price',$fieldOptions1)->textInput(['maxlength' => true]) ?>

        <?php if(!$model->isNewRecord) {?>
            <div class="form-group field-menu-imageDisplay">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 imageWrap">
                        <img src="<?php echo Yii::$app->request->baseUrl . $model->imagePath ?>" class="menu-img img-responsive" > 
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>
        <?php }?>

        <?php echo $form->field($model, 'imagePath',$fieldOptions1)->fileInput(['class' => 'form-control file_input', 'accept' => 'image/*']); ?>

        <?php echo $form->field($model, 'isOutofstock',$checkBoxOptions)->checkbox() ?>


        <?php ActiveForm::end(); ?>

        <div id="msg"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
        <?php echo Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-lg btn-success' : 'btn btn-lg btn-primary', 'onClick' =>  $model->isNewRecord ? 'recordCreateOrUpdate("'.$menuCreateUrl.'",this)' : 'recordCreateOrUpdate("'.$menuUpdateUrl.'",this)']) ?>
    </div>
</div>


<script type="text/javascript">

    function getRestaurantMenuItem( courseType, targetInput, loaderConatiner,restaurantID)
    {
        $.ajax({
            type:"POST",
            dataType:'json',
            url:"<?php echo $menuItemUrl; ?>",
            data:{courseType:courseType,restaurantID:restaurantID},
            beforeSend:function() {
                $("#"+targetInput).attr('disabled','disabled');
                $("#"+loaderConatiner).addClass('fa fa-refresh fa-spin');
                $("#"+targetInput).html("<option value=''>--select--</option>");
            },
            success:function(response) {
                console.log(response);
                var items = "<option value=''>--select--</option>";
                $.each( response, function( key, val ) {
                    items = items + "<option value='" + val + "'>" + key + "</option>" ;
                });
                 
                $("#"+targetInput).html(items);
                $("#"+targetInput).removeAttr('disabled');
                $("#"+loaderConatiner).removeClass('fa fa-refresh fa-spin');
            },
            error: function (jqXHR, exception) {
                $("#"+targetInput).html("<option value=''>--select--</option>");
                $("#"+targetInput).removeAttr('disabled');
                $("#"+loaderConatiner).removeClass('fa fa-refresh fa-spin');
            }
        });
        return false;
    }
</script>