<?php
use yii\helpers\Html;
use app\lib\Core;
?>
<!--footer-->
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?php echo Yii::$app->name; ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<div class="clear"></div>
</div>
<!-- Start: Modal -->
<div id="commonModal" class="modal fade" tabindex="-1" role="dialog"></div>
<!--End: Modal -->
<?php 
  $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/default/js/modal.js', ['depends' => [yii\web\JqueryAsset::className()]]);
  $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/frontend/default/js/bootstrap.js', ['depends' => [yii\web\JqueryAsset::className()]]);
  ?>
<?php $this->endBody() ?>
<script type="text/javascript">
$(".only_integer").keypress(function(event){
	if(event.keyCode != 9 && event.keyCode != 46 && event.which != 8 && (event.which < 48 || event.which > 57))
	{
		return false;
	}
});

function fadeOutMessage(containerID, timeInterval)
{
	setTimeout(function(){
		$("#"+containerID+" .alert").fadeOut(300, function(){
			$("#"+containerID).html('&nbsp;');
		});
	}, timeInterval);
}
</script>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/plugins/select2/select2.full.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>