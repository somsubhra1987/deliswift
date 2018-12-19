<?php $this->endBody() ?>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/js/jquery-ui-1.11.4.min.js"></script>
<script><!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/themes/backend/adminlte/assets/dist/js/app.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
