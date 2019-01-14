<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\lib\App;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */

$fieldOptions1 = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}{error}</div></div>"
];
$checkBoxOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2\">{input}{label}{error}</div></div>"
];

$fieldProvinceLoaderOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' id='restaurant_province_loader' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$fieldCityLoaderOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' id='restaurant_city_loader' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$fieldLocationLoaderOptions = [
  'template' => "<div class=\"row\"><div class=\"col-lg-2 col-md-2 col-sm-2\">{label}</div><div class=\"col-lg-10 col-md-10 col-sm-10\">{input}<span class='pull-left' id='restaurant_deliverylocation_loader' style='margin: -24px 0 0 80px;'></span>{error}</div></div>"
];

$countryListData            = App::getCountryAssoc();
$provinceListData           = App::getProvinceAssoc($model->countryCode);
$cityListData               = App::getCityAssoc($model->provinceID);
$deliveryLocationListData   = App::getDeliverylocationAssoc($model->cityID);

if($model->password)
    $model->password = '';

$provinceUrl = Yii::$app->urlManager->createUrl('admin/province/getprovinceagainstcountry');
$cityUrl = Yii::$app->urlManager->createUrl('admin/province/getcityagainstprovince');
$deliveryUrl = Yii::$app->urlManager->createUrl('admin/province/getlocationagainstcity');
$headCountArr = array(1=>1,2=>2,3=>3,4=>4,5=>5);

?>
<div class="restaurant-form">

     <?php $form = ActiveForm::begin([
        'id' => 'restaurant-form',
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?php echo $form->field($model, 'name',$fieldOptions1)->textInput(['maxlength' => true, 'spellcheck' => 'true', 'autofocus' => 'autofocus']); ?> 

    <?php echo $form->field($model, 'description',$fieldOptions1)->textarea(['rows' => 6, 'spellcheck' => 'true']) ?>

<?php if(!$model->isNewRecord) {?>
    <div class="form-group field-restaurant-imageDisplay">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <img src="<?php echo Yii::$app->request->baseUrl . $model->imagePath ?>" class="restaurant-img img-responsive" > 
                <div class="help-block"></div>
            </div>
        </div>
    </div>
<?php }?>

    <?php echo $form->field($model, 'imagePath',$fieldOptions1)->fileInput(['class' => 'form-control file_input', 'accept' => 'image/*']); ?>

    <?php echo $form->field($model, 'contactName',$fieldOptions1)->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'contactPhone',$fieldOptions1)->textInput(['maxlength' => true, 'class' => 'form-control only_integer']) ?>

    <?php echo $form->field($model, 'contactMobile',$fieldOptions1)->textInput(['maxlength' => true, 'class' => 'form-control only_integer']) ?>

    <?php echo $form->field($model, 'avgCostAmount',$fieldOptions1)->textInput(['class' => 'form-control only_integer']) ?>

    <?php echo $form->field($model, 'avgCostHeadCount',$fieldOptions1)->dropDownList($headCountArr, ['prompt' => '-Select-']) ?>

    <?php echo $form->field($model, 'avgCostInfo',$fieldOptions1)->textarea(['rows' => 6, 'spellcheck' => 'true']) ?>

    <?php echo $form->field($model, 'bestKnownFor',$fieldOptions1)->textInput(['maxlength' => true]) ?>



    <?php echo $form->field($model, 'countryCode',$fieldOptions1)->dropDownList($countryListData,['prompt'=>'--select--', 'class' => 'form-control req_input', 'style' => 'width:75%;', 'onchange' => 'getProvince(this.value, "restaurant-provinceid", "restaurant_province_loader", "restaurant-cityid", "restaurant-deliverylocationid");']) ?>

    <?php echo $form->field($model, 'provinceID',$fieldProvinceLoaderOptions)->dropDownList($provinceListData,['prompt'=>'--select--', 'class' => 'form-control req_input', 'style' => 'width:75%;', 'onchange' => 'getCity(this.value, "restaurant-cityid", "restaurant_city_loader","restaurant-deliverylocationid");']) ?>

    <?php echo $form->field($model, 'cityID',$fieldCityLoaderOptions)->dropDownList($cityListData,['prompt'=>'--select--', 'class' => 'form-control req_input', 'style' => 'width:75%;', 'onchange' => 'getDeliverylocation(this.value, "restaurant-deliverylocationid", "restaurant_deliverylocation_loader");']) ?>

    <?php echo $form->field($model, 'deliveryLocationID',$fieldLocationLoaderOptions)->dropDownList($deliveryLocationListData,['prompt'=>'--select--', 'class' => 'form-control', 'style' => 'width:75%;']) ?>
    
    <?php echo $form->field($model, 'contactAddress',$fieldOptions1)->textInput(['maxlength' => true]) ?>



    <?php echo $form->field($model, 'password',$fieldOptions1)->passwordInput(['maxlength' => true,'placeholder' => $model->isNewRecord ?"":"Enter new password (if you want to update)"]) ?>

    <?php echo $form->field($model, 'isCardAccept',$checkBoxOptions)->checkbox() ?>

    <?php echo $form->field($model, 'isHomeDelivery',$checkBoxOptions)->checkbox() ?>

    <?php echo $form->field($model, 'isFeatured',$checkBoxOptions)->checkbox() ?>


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



<script type="text/javascript">

    function getProvince(countryCode, targetInput, loaderConatiner, cityInput, deliverylocationInput)
    {
        $.ajax({
            type:"POST",
            dataType:'json',
            url:"<?php echo $provinceUrl; ?>",
            data:{countryCode:countryCode},
            beforeSend:function() {
                $("#"+targetInput).attr('disabled','disabled');
                $("#"+loaderConatiner).addClass('fa fa-refresh fa-spin');
                $("#"+deliverylocationInput).html("<option value=''>--select--</option>");
                $("#"+cityInput).html("<option value=''>--select--</option>");
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

    function getCity(provinceID, targetInput, loaderConatiner,deliverylocationInput)
    {
        if(provinceID)
        {
         //   alert("OK")
            $.ajax({
                type:"POST",
                dataType:'json',
                url:"<?php echo $cityUrl; ?>",
                data:{provinceID:provinceID},
                beforeSend:function() {
                    $("#"+targetInput).attr('disabled','disabled');
                    $("#"+loaderConatiner).addClass('fa fa-refresh fa-spin');
                    $("#"+deliverylocationInput).html("<option value=''>--select--</option>");
                },
                success:function(response) {
                    // console.log(response);
                    // alert("OK123")
                    var items = "<option value=''>--select--</option>";
                    $.each( response, function( key, val ) {
                        items = items+  "<option value='" + val + "'>" + key + "</option>";
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
        }
        else
        {
            var items = ["<option value=''>--select--</option>"];
            $("#"+targetInput).html(items.join(""));
        }
        return false;
    }

    function getDeliverylocation(cityID,targetInput, loaderConatiner)
    {
        if(cityID)
        {
            $.ajax({
                type:"POST",
                dataType:'json',
                url:"<?php echo $deliveryUrl; ?>",
                data:{cityID:cityID},
                beforeSend:function() {
                    $("#"+targetInput).attr('disabled','disabled');
                    $("#"+loaderConatiner).addClass('fa fa-refresh fa-spin');
                },
                success:function(response) {
                   // console.log(response);
                    var items = "<option value=''>--select--</option>";
                    $.each( response, function( key, val ) {
                        items = items +  "<option value='" + val + "'>" + key + "</option>";
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
        }
        else
        {
           var items = ["<option value=''>--select--</option>"];
            $("#"+targetInput).html(items.join(""));
        }
        return false;
    }
</script>